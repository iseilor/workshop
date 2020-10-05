<?php

namespace app\modules\jk\models;

use app\models\Model;
use app\modules\jk\Module;
use app\modules\user\models\User;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use function GuzzleHttp\Psr7\str;

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
 * @property boolean|null $approval
 * @property string|null  $comment
 */
class Agreement extends Model
{

    const APPROVAL_YES = 1;

    const APPROVAL_WAIT = 0;

    const APPROVAL_NO = -1;

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
            [['approval', 'user_id', 'order_id', 'receipt_at', 'approval_at'], 'integer'],
            [['comment'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {

        return ArrayHelper::merge(
            parent::attributeLabels(),
            [
                'created_at' => Yii::t('app', 'Created At'),
                'createdUserLink' => Module::t('agreement', 'Created By'),

                'order_id' => Module::t('agreement', 'Order ID'),
                'user' => Module::t('agreement', 'User'),
                'user_id' => Module::t('agreement', 'User'),
                'receipt_at' => Module::t('agreement', 'Receipt At'),
                'approval_at' => Module::t('agreement', 'Approval At'),
                'approval' => Module::t('agreement', 'Approval'),
                'approvalLabel' => Module::t('agreement', 'Approval'),
                'approvalBadge' => Module::t('agreement', 'Approval'),
                'comment' => Yii::t('app', 'Comment'),
            ]
        );
    }

    // Цветной статус согласования
    public function getApprovalLabel()
    {
        if (isset($this->approval)) {
            if ($this->approval == 1) {
                return '<span class="badge bg-success" title="' . $this->comment . '">Согласовано</span>';
            } else {
                return '<span class="badge bg-danger" title="' . $this->comment . '">Не согласовано</span>';
            }
        }
    }

    // Типы согласований
    public static function getApprovalsArray()
    {
        return [
            self::APPROVAL_WAIT => 'На согласовании',
            self::APPROVAL_YES => 'Согласовано',
            self::APPROVAL_NO => 'Не согласовано',
        ];
    }

    // Наименование типа заявки
    public function getApprovalName()
    {
        return ArrayHelper::getValue(self::getApprovalsArray(), $this->approval);
    }

    // Цветная плашка согласования
    public function getApprovalBadge()
    {
        if (isset($this->approval)) {
            $cssCLasses = [
                Agreement::APPROVAL_WAIT => 'warning',
                Agreement::APPROVAL_YES => 'success',
                Agreement::APPROVAL_NO => 'danger',
            ];
            return Html::tag('span', $this->getApprovalName(), ['class' => 'badge bg-' . $cssCLasses[$this->approval]]);
        } else {
            return false;
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

            // Строим цепочку до Кима
            $manager = User::findOne($item);
            if ($manager->fio == 'Ким Дмитрий Матвеевич') {
                break;
            }

            $agreement = new Agreement();
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
    public function sendEmailUserManagerSuccess()
    {
        $manager = User::findOne($this->user_id);
        $user = User::findOne($this->created_by);
        $order  = Order::findOne($this->order_id);

        Yii::$app->mailer->compose(
            '@app/modules/jk/mails/manager/success',
            [
                'user' => $user,
                'manager' => $manager,
                'agreement' => $this,
            ]
        )
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setBcc(Yii::$app->params['supportEmail'])
            ->setTo($user->email)
            ->setSubject($order->getEmailSubject('Согласована ' . $manager->fio))
            ->send();
    }

    // Отправляем письмо сотруднику, что один из руководителей не согласовал его заявку
    public function sendEmailUserManagerDanger()
    {
        $manager = User::findOne($this->user_id);
        $user = User::findOne($this->created_by);
        $order  = Order::findOne($this->order_id);
        Yii::$app->mailer->compose(
            '@app/modules/jk/mails/manager/danger',
            [
                'user' => $user,
                'manager' => $manager,
                'agreement' => $this,
            ]
        )
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setBcc(Yii::$app->params['supportEmail'])
            ->setTo($user->email)
            ->setSubject($order->getEmailSubject('НЕ Согласована ' . $manager->fio))
            ->send();
    }


    // Запускаем цепочку отправки сообщение руководителям для согласования
    public static function sendEmailManager($order_id)
    {
        $order = Order::findOne($order_id);
        $user = User::findOne($order->created_by);
        $agreement = Agreement::find()->where(['order_id' => $order_id, 'approval_at' => null])->one();

        // Отправляем письмо следующему по цепочке руководителю
        if ($agreement) {
            $manager = User::findOne($agreement->user_id);
            $agreement->receipt_at = time(); // Ставим дату, когда письмо было передано руководителю
            $agreement->approval = Agreement::APPROVAL_WAIT;
            $agreement->save();
            Yii::$app->mailer->compose(
                '@app/modules/jk/mails/manager/manager_wait_manager',
                [
                    'user' => $user,
                    'manager' => $manager,
                    'agreement' => $agreement,
                    'order'=>$order
                ]
            )
                ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
                ->setBcc(Yii::$app->params['supportEmail'])
                ->setTo($manager->email) // TODO: Пока отправляем самому же сотруднику, просто в письме обращение к руководителю
                ->setSubject($order->getEmailSubject("Согласование руководителями"))
                ->send();
        } else {
            // Ставим статус, что согласование руководителями завершено
            $order = Order::findOne($order_id);
            $newStatus = Status::findOne(['code' => 'MANAGER_YES']);
            $order->status_id = $newStatus->id;
            $order->save();

            Yii::$app->mailer->compose(
                '@app/modules/jk/mails/manager/end',
                [
                    'user' => $user,
                    'order' => $order,
                ]
            )
                ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
                ->setBcc(Yii::$app->params['supportEmail'])
                ->setTo($user->email)
                ->setSubject($order->getEmailSubject("Согласование руководителями завершено"))
                ->send();

            // Сохраняем в историю движения заявки
            $orderStage = new OrderStage();
            $orderStage->order_id = $order->id;
            $orderStage->status_id = $order->status_id;
            $orderStage->comment = $newStatus->title;
            $orderStage->save();

            // Отправляем куратору
            $order->sendCurator();
        }
    }

}