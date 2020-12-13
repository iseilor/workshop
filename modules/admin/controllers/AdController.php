<?php

namespace app\modules\admin\controllers;

use app\modules\user\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class AdController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],

            'access'=>[
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin']
                    ],
                ],
            ],
        ];
    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($email = '')
    {


        // Если нет почты, то ищем по текущему пользователю
        if (!$email){
            $email = User::findOne(Yii::$app->user->identity->getId())->email;
        }

        $data = Yii::$app->ad->getProvider('default')->search()->findBy('mail', $email);

        if ($data){
            $data = $data->getAttributes();

            // Убираем нумерованные элементы массива
            foreach ($data as $index => $value) {
                if (is_numeric($index)) {
                    unset($data[$index]);
                }
            }

            // Убираем ненужные элементы массива
            foreach (
                ['usercertificate', 'memberof', 'proxyaddresses', 'objectclass', 'showinaddressbook',
                    'dscorepropagationdata', 'thumbnailphoto','objectguid','objectsid',
                    'msexchsafesendershash','msexchmailboxsecuritydescriptor','msexchblockedsendershash',
                    'msexchblockedsendershash','msrtcsip-userroutinggroupid','objectguid',
                    'msexchmailboxguid','msrtcsip-userroutinggroupid'
                ]
                as $value) {
                unset($data[$value]);
            }

            foreach ($data as $index => $value) {
                $data[$index]=$value[0];
            }
        }else{
            $data=false;
        }


        return $this->render(
            'index',
            [
                'email'=>$email,
                'data' => $data
            ]
        );
    }
}
