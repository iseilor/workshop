<?php

namespace app\modules\jk\models;

use app\models\Model;
use app\modules\jk\Module;
use app\modules\user\models\Child;
use app\modules\user\models\User;
use Yii;

/**
 * This is the model class for table "jk_rf".
 *
 * @property int      $id
 * @property int      $created_at
 * @property int      $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $deleted_at
 * @property int|null $deleted_by
 * @property string   $title
 * @property string   $description
 * @property int      $user_id
 * @property string   $email
 * @property string   $phone
 * @property string   $address
 * @property float    $coefficient
 * @property float    $percent_max
 * @property float    $loan_max
 * @property string   $header
 *
 */
class Rf extends Model
{

    public $user;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jk_rf';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'user', 'email', 'phone', 'address', 'coefficient', 'percent_max', 'loan_max', 'header'], 'required'],
            [['created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by', 'user_id'], 'integer'],
            [['description'], 'string'],
            [['coefficient', 'percent_max', 'loan_max'], 'number'],
            [['title', 'email', 'phone', 'address'], 'string', 'max' => 255],
            [['email'], 'email'],

            ['coefficient', 'compare', 'compareValue' => 0, 'operator' => '>', 'type' => 'number'],
            ['percent_max', 'compare', 'compareValue' => 0, 'operator' => '>', 'type' => 'number'],
            ['loan_max', 'compare', 'compareValue' => 0, 'operator' => '>', 'type' => 'number'],

            [
                ['user', 'user_id'],
                function () {
                    if (!isset($this->user_id) || $this->user_id == '') {
                        $this->addError('user', "Сотрудник обязательно должен быть выбран из выпадающего списка");
                    }
                },
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('rf', 'ID'),
            'created_at' => Module::t('rf', 'Created At'),
            'created_by' => Module::t('rf', 'Created By'),
            'updated_at' => Module::t('rf', 'Updated At'),
            'updated_by' => Module::t('rf', 'Updated By'),
            'deleted_at' => Module::t('rf', 'Deleted At'),
            'deleted_by' => Module::t('rf', 'Deleted By'),
            'title' => Module::t('rf', 'Title'),
            'description' => Module::t('rf', 'Description'),
            'user_id' => Module::t('rf', 'User ID'),
            'user' => Module::t('rf', 'User ID'),
            'email' => Module::t('rf', 'Email'),
            'phone' => Module::t('rf', 'Phone'),
            'address' => Module::t('rf', 'Address'),
            'coefficient' => Module::t('rf', 'Coefficient'),
            'percent_max' => Module::t('rf', 'Percent Max'),
            'loan_max' => Module::t('rf', 'Loan Max'),
            'header' => Module::t('rf', 'Header'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return RfQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RfQuery(get_called_class());
    }

    public function getUserCurator()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    // Меняем данные в таблице с ролями
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                //TODO: Пока сделано только для обновления существующих записей
            } else {

                // Смена роли в RBAC
                $userOld = $this->getOldAttribute('user_id');
                $userNew = $this->getAttribute('user_id');

                $auth = Yii::$app->authManager;
                if ($this->id == 13) {
                    $role = $auth->getRole('curator_mrf');
                } else {
                    $role = $auth->getRole('curator_rf');
                }
                $auth->revokeAll($userOld);
                $auth->assign($role, $userNew);

                // Отправляем письмо о смене куратора
                Yii::$app->mailer->compose(
                    '@app/modules/admin/mails/curatorChange.php',
                    [
                        'filialName' => $this->title,
                        'curatorOld' => User::findOne($userOld),
                        'curatorNew' => User::findOne($userNew),
                        'user' => User::findOne(Yii::$app->user->identity->getId()),
                    ]
                )
                    ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
                    ->setTo(Yii::$app->params['supportEmails'])
                    ->setBcc(Yii::$app->params['supportEmail'])
                    ->setSubject("HR-портал / Жилищная Программа / Смена куратора")
                    ->send();
            }
            return true;
        } else {
            return false;
        }
    }

    // Кол-во заявок в данном РФ\МРФ
    public function getOrderCount(){
        $users = User::find()->select('id')->where(['filial_id' => $this->id])->asArray()->all();
        $userIds = [];
        foreach ($users as $user) {
            $userIds[]=(int)$user['id'];
        }
        return Order::find()->where(['in','created_by',$userIds])->count();
    }
}