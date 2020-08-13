<?php

namespace app\modules\jk\models;

use app\models\Model;
use app\modules\user\models\User;
use Yii;

/**
 * This is the model class for table "jk_message".
 *
 * @property int      $id
 * @property int      $created_at
 * @property int      $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $deleted_at
 * @property int|null $deleted_by
 * @property int      $user_id
 * @property string   $message
 * @property int|null $view_at
 */
class Message extends Model
{

    public $cnt;

    public $max;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jk_message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'message', 'is_curator'], 'required'],
            [['user_id'], 'integer'],
            [['message'], 'string'],
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
            'user_id' => Yii::t('app', 'User ID'),
            'message' => Yii::t('app', 'Message'),
            'view_at' => Yii::t('app', 'View At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return MessageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MessageQuery(get_called_class());
    }

    // Отправляем письма кураторам
    public function sendEmail2Curator()
    {
        // Ищем всех кураторов
        $curators = User::findAll(['role_id' => 1]);

        // Автор сообщения
        $user = User::findOne($this->created_by);

        // Отправляем письма всем кураторам
        foreach ($curators as $curator) {
            Yii::$app->mailer->compose(
                '@app/modules/jk/mails/curator/email2curator',
                [
                    'user' => $user,
                    'curator' => $curator,
                    'message' => $this,
                ]
            )
                ->setFrom('workshop@tr.ru')
                ->setTo($curator->email)
                ->setSubject('WORKSHOP / Жилищная Программа / Сообщение куратору')
                ->send();
        }
        return true;
    }

    // Ответ куратора и письмо сотруднику
    public function sendEmail2User()
    {
        $curator = User::findOne($this->created_by); // Куратор
        $user = User::findOne($this->user_id); // Автор сообщения
        Yii::$app->mailer->compose(
            '@app/modules/jk/mails/curator/email2user',
            [
                'user' => $user,
                'curator' => $curator,
                'message' => $this,
            ]
        )
            ->setFrom('workshop@tr.ru')
            ->setTo($curator->email)
            ->setSubject('WORKSHOP / Жилищная Программа / Ответ от куратора')
            ->send();
        return true;
    }

    // Пользователь, чья это переписка
    public function getUser(){
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}