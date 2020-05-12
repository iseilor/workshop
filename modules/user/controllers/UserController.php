<?php

namespace app\modules\user\controllers;


use app\modules\user\models\User;
use PhpOffice\PhpWord\TemplateProcessor;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\UploadedFile;

class UserController extends Controller
{

    // Выгрузить согласие на обработку персональных данных
    public function actionPd($id)
    {
        $user =  User::findOne($id);
        $filePath = Yii::getAlias('@app').'/modules/user/files/user_personal_data.docx';
        $templateProcessor = new TemplateProcessor($filePath);
        $templateProcessor->setValue(
            ['FIO', 'PASSPORT_SERIES','PASSPORT_NUMBER','PASSPORT_DATE','PASSPORT_DEPARTMENT',
                'PASSPORT_CODE','PASSPORT_REGISTRATION','DATE'],
            [$user->fio, $user->passport_series,$user->passport_number,
                $user->passport_date,$user->passport_department,$user->passport_code,
                $user->passport_registration,date('d.m.Y')]
        );
        $fileUrl = '/files/user/'.$id.'/'.$id.'_pd_'.  date('YmdHis').'.docx';
        $templateProcessor->saveAs(Yii::getAlias('@app').'/web'.$fileUrl);
        return Yii::$app->response->sendFile(Yii::getAlias('@webroot').$fileUrl);
    }
}