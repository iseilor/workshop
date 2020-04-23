<?php

namespace app\modules\jk\models;

use app\models\Model;
use app\modules\jk\Module;
use app\modules\user\models\User;
use Yii;

/**
 * This is the model class for table "jk_order_agreement".
 *
 * @property int          $id
 * @property int          $created_at
 * @property int          $created_by
 * @property int|null     $updated_at
 * @property int|null     $updated_by
 * @property int|null     $deleted_at
 * @property int|null     $deleted_by
 * @property int          $order_id
 * @property string       $user_id
 * @property int|null     $receipt_at
 * @property int|null     $approval_at
 * @property boolean|null $is_approval
 * @property string|null  $comment
 */
class Agreement extends Model
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jk_order_agreement';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'user_id'], 'required'],
            [['is_approval','user_id', 'order_id', 'receipt_at', 'approval_at'], 'integer'],
            [['comment'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'deleted_by' => Yii::t('app', 'Deleted By'),

            'order_id' => Yii::t('app', 'Order ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'receipt_at' => Module::t('agreement', 'Receipt At'),
            'approval_at' => Module::t('agreement', 'Approval At'),
            'is_approval' => Module::t('agreement', 'Is Approval'),
            'approvalLabel'=>Module::t('agreement', 'Is Approval'),
            'comment' => Yii::t('app', 'Comment'),
        ];
    }

    // Цветной статус согласования
    public function getApprovalLabel()
    {
        if (isset($this->is_approval)) {
            if ($this->is_approval == 1) {
                return '<span class="badge bg-success" title="'.$this->comment.'">Согласовано</span>';
            } else {
                return '<span class="badge bg-danger" title="'.$this->comment.'">Не согласовано</span>';
            }
        }
    }

    /**
     * {@inheritdoc}
     * @return AgreementQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AgreementQuery(get_called_class());
    }

    // Создать цепочку согласования для новой заявки
    public static function createAgreementList($order_id)
    {
        $order = Order::findOne($order_id);
        $userOrder = User::findOne($order->created_by);
        $managerList = $userOrder->getManagerList(); // Получить цепочку согласования
        foreach ($managerList as $item) {
            $agreement= new Agreement();
            $agreement->user_id = $item;
            $agreement->order_id = $order_id;
            $agreement->save();
        }
    }

    // Связь с руководителем
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    // Отправляем письмо сотруднику, что один из руководителей согласовал его заявку
    public function sendEmailUserManagerSuccess(){
        $manager = User::findOne($this->user_id);
        $user = User::findOne($this->created_by);
        Yii::$app->mailer->compose(
            '@app/modules/jk/mails/manager/success',
            [
                'user' => $user,
                'manager' => $manager,
                'agreement' => $this,
            ]
        )
            ->setFrom('workshop@tr.ru')
            ->setTo($user->email)
            ->setSubject('WORKSHOP / Жилищная программа / Заявка №'.$this->order_id.' / Согласована '.$manager->fio)
            ->send();
    }

    // Отправляем письмо сотруднику, что один из руководителей не согласовал его заявку
    public function sendEmailUserManagerDanger(){
        $manager = User::findOne($this->user_id);
        $user = User::findOne($this->created_by);
        Yii::$app->mailer->compose(
            '@app/modules/jk/mails/manager/danger',
            [
                'user' => $user,
                'manager' => $manager,
                'agreement' => $this,
            ]
        )
            ->setFrom('workshop@tr.ru')
            ->setTo($user->email)
            ->setSubject('WORKSHOP / Жилищная программа / Заявка №'.$this->order_id.' / НЕ Согласована '.$manager->fio)
            ->send();
    }


    // Запускаем цепочку отравки сообщение руководителям для согласования
    public static function sendEmailManager($order_id){
        $order = Order::findOne($order_id);
        $user = User::findOne($order->created_by);
        $agreement = Agreement::find()->where(['order_id'=>$order_id,'approval_at'=>null])->one();

        // Отправляем письмо следующему по цепочке руководителю
        if ($agreement) {
            $manager = User::findOne($agreement->user_id);
            $agreement->receipt_at=time(); // Ставим дату, когда письмо было передано руководителю
            $agreement->save();
            Yii::$app->mailer->compose(
                '@app/modules/jk/mails/manager/manager',
                [
                    'user' => $user,
                    'manager' => $manager,
                    'agreement' => $agreement,
                ]
            )
                ->setFrom('workshop@tr.ru')
                ->setTo($user->email)
                ->setSubject('WORKSHOP / Жилищная программа / Заявка №'.$order_id.' / Согласование руководителем')
                ->send();
        }else{
            Yii::$app->mailer->compose(
                '@app/modules/jk/mails/manager/end',
                [
                    'user' => $user,
                    'order' => $order
                ]
            )
                ->setFrom('workshop@tr.ru')
                ->setTo($user->email)
                ->setSubject('WORKSHOP / Жилищная программа / Заявка №'.$order_id.' / Согласование руководителями завершено')
                ->send();
        }
    }
}