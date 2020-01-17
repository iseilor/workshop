<?php

namespace app\modules\main\models;

use app\modules\main\Module;
use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['subject', 'body','verifyCode'], 'required'],
            ['verifyCode', 'captcha', 'captchaAction' => '/main/default/captcha/'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'subject'=>Module::t('module','Subject'),
            'body'=>Module::t('module','Body'),
            'verifyCode' => Module::t('module','Verification Code'),
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function contact($email)
    {
        if ($this->validate()) {
            Yii::$app->mailer->compose('@app/modules/main/mails/contacts', ['contactForm' => $this])
                ->setTo($email)
                ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
                ->setReplyTo([$this->email => $this->name])
                ->setSubject('Сообщение с портала WORKSHOP')
                ->send();
            return true;
        }
        return false;
    }
}
