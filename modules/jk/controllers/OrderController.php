<?php

namespace app\modules\jk\controllers;

use app\modules\jk\models\Agreement;
use app\modules\jk\models\Order;
use app\modules\jk\models\OrderSearch;
use app\modules\jk\models\OrderStage;
use app\modules\jk\models\OrderStageSearch;
use app\modules\jk\models\OrderStop;
use app\modules\jk\models\Status;
use app\modules\jk\Module;
use app\modules\user\models\Passport;
use app\modules\user\models\Spouse;
use app\modules\user\models\User;
use app\modules\user\models\UserChildSearch;
use PhpOffice\PhpWord\TemplateProcessor;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{

    public $icon = '';

    public $parent = '';


    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->icon = Yii::$app->params['module']['jk']['order']['icon'];
        $this->parent = [
            'label' => Yii::$app->params['module']['jk']['icon'] . ' ' . Module::t('module', 'JK'),
            'url' => ['/jk'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Order models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render(
            'index',
            [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]
        );
    }

    /**
     * Lists all Order models.
     *
     * @return mixed
     */
    public function actionAdmin()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render(
            'admin',
            [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]
        );
    }

    /**
     * Displays a single Order model.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render(
            'view/view',
            [
                'model' => $this->findModel($id),
            ]
        );
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        // Смотрим, заполнины ли все поля у пользователя в профиле
        $user = User::findOne(Yii::$app->user->identity->getId());
//        if (!$user->isPassport()) {
//            Yii::$app->session->setFlash('warning', "Чтобы приступить к оформлению заявки на участие в Жилищной Кампании,
//            вам необходимо заполнить все данные по вашему паспорту ");
//            return $this->redirect(['/user/profile/update']);
//        }


        $model = new Order();
        $model->status_id = 1;

        if ($user) {
            $spose = Spouse::findOne(['user_id' => $user->id]);
            $passport = $user->passport;
        }
        if (!$spose) {
            $spose = new Spouse();
        }

        if (!$passport) {
            $passport = new Passport();
        }


//        var_dump(Yii::$app->request->post());
//        var_dump($spose);
//        die();


        // Обновлаяем паспортные данные
        // TODO Разобраться, почему не рабоате load() и убрать "педальный" метод
        if ($user && isset(Yii::$app->request->post()['Passport']) && is_array(Yii::$app->request->post()['Passport'])) {
            foreach (Yii::$app->request->post()['Passport'] as $userKey => $userVal) {
                switch ($userKey) {
                    case 'passport_date':
                        $user->$userKey = \Yii::$app->formatter->asTimestamp($userVal, 'php:d.m.Y');
                        break;
                    case 'passport_file':
                        // Passport
                        $passport_file = UploadedFile::getInstance($passport, 'passport_file');
                        if ($passport_file){
                            $passportFileDir = Yii::$app->params['module']['user']['path'].$user->id;
                            $passportFileName = $user->id .'_passport_'.date('YmdHis'). '.' . $passport_file->extension;
                            FileHelper::createDirectory( $passportFileDir, $mode = 0777, $recursive = true);
                            $passport_file->saveAs($passportFileDir. '/'.$passportFileName);
                            $user->passport_file = $passportFileName;
                        }
                        break;
                    case 'ejd_file':
                        // Passport
                        $ejd_file = UploadedFile::getInstance($passport, 'ejd_file');
                        if ($ejd_file){
                            $ejdFileDir = Yii::$app->params['module']['user']['path'].$user->id;
                            $ejdFileName = $user->id .'_ejd_'.date('YmdHis'). '.' . $ejd_file->extension;
                            FileHelper::createDirectory( $ejdFileDir, $mode = 0777, $recursive = true);
                            $ejd_file->saveAs($ejdFileDir. '/'.$ejdFileName);
                            $user->ejd_file = $ejdFileName;
                        }
                        break;
                    case 'temporary_registration_file':
                        // Passport
                        $temporary_registration_file = UploadedFile::getInstance($passport, 'temporary_registration_file');
                        if ($temporary_registration_file){
                            $temporaryRegistrationFileDir = Yii::$app->params['module']['user']['path'].$user->id;
                            $temporaryRegistrationFileName = $user->id .'_temporary_registration_'.date('YmdHis'). '.' . $temporary_registration_file->extension;
                            FileHelper::createDirectory( $temporaryRegistrationFileDir, $mode = 0777, $recursive = true);
                            $temporary_registration_file->saveAs($temporaryRegistrationFileDir. '/'.$temporaryRegistrationFileName);
                            $user->temporary_registration_file = $temporaryRegistrationFileName;
                        }
                        break;
                    default:
                        $user->$userKey = $userVal;
                        break;
                }
            }

            $user->save();
        }

        if ($user && isset(Yii::$app->request->post()['User']) && is_array(Yii::$app->request->post()['User'])) {
            foreach (Yii::$app->request->post()['User'] as $userKey => $userVal) {
                switch ($userKey) {
                    case 'work_transferred_file':
                        // Transferred file
                        $work_transferred_file = UploadedFile::getInstance($user, 'work_transferred_file');
                        if ($work_transferred_file){
                            $fileDir = Yii::$app->params['module']['user']['path'].$user->id;
                            $fileName = $user->id .' | '.$user->fio.' | Заявление о переводе | '.date('d.m.Y H:i:s'). '.' . $work_transferred_file->extension;
                            FileHelper::createDirectory( $fileDir, $mode = 0777, $recursive = true);
                            $work_transferred_file->saveAs($fileDir. '/'.$fileName);
                            $user->work_transferred_file = $fileName;
                        }
                        break;
                    default:
                        $user->$userKey = $userVal;
                        break;
                }
            }

            $user->save();
        }

        if (isset(Yii::$app->request->post()['Spouse']) && is_array(Yii::$app->request->post()['Spouse'])) {
            if ($user) {
                $spose->user_id = $user->id;
            }

            foreach (Yii::$app->request->post()['Spouse'] as $sposeKey => $sposeVal) {
                $spose->$sposeKey = $sposeVal;
            }

            $spose->save();

        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // Строчим цепочку согласования
            Agreement::createAgreementList($model->id);

            $model->upload();

            // Сразу делаем первый этап, когда была создана заявка
            $orderStage = new OrderStage();
            $orderStage->order_id = $model->id;
            $orderStage->status_id = 1;
            $orderStage->comment = 'Автоматический комментарий: заявка создана сотрудником на портале';
            $orderStage->save();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        // Если заявка создана на основании калькулятора процентов или займа
        if (isset($_GET['percent_id'])){
            $model->loadDataPercent($_GET['percent_id']);
        }
        if (isset($_GET['zaim_id'])){
            $model->loadDataZaim($_GET['zaim_id']);
        }

        return $this->render(
            'create',
            [
                'model' => $model,
                'usermd' => $user,
                'spose' => $spose,
                'passport' => $passport,
                //'spose' => $model,
                //'model' => $user,
            ]
        );
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $user = User::findOne(Yii::$app->user->identity->getId());

        if ($user) {
            $spose = Spouse::findOne(['user_id' => $user->id]);
            $passport = $user->passport;
        }

        if (!$spose) {
            $spose = new Spouse();
        }

        if (!$passport) {
            $passport = new Passport();
        }

//       var_dump(Yii::$app->request->post());
//        var_dump($spose);
//        die();

        // Обновлаяем паспортные данные
        // TODO Разобраться, почему не рабоате load() и убрать "педальный" метод
        if ($user && isset(Yii::$app->request->post()['Passport']) && is_array(Yii::$app->request->post()['Passport'])) {
            foreach (Yii::$app->request->post()['Passport'] as $userKey => $userVal) {
                switch ($userKey) {
                    case 'passport_date':
                        $user->$userKey = \Yii::$app->formatter->asTimestamp($userVal, 'php:d.m.Y');
                        break;
                    case 'passport_file':
                        // Passport
                        $passport_file = UploadedFile::getInstance($passport, 'passport_file');
                        if ($passport_file){
                            $passportFileDir = Yii::$app->params['module']['user']['path'].$user->id;
                            $passportFileName = $user->id .'_passport_'.date('YmdHis'). '.' . $passport_file->extension;
                            FileHelper::createDirectory( $passportFileDir, $mode = 0777, $recursive = true);
                            $passport_file->saveAs($passportFileDir. '/'.$passportFileName);
                            $user->passport_file = $passportFileName;
                        }
                        break;
                    case 'ejd_file':
                        // Passport
                        $ejd_file = UploadedFile::getInstance($passport, 'ejd_file');
                        if ($ejd_file){
                            $ejdFileDir = Yii::$app->params['module']['user']['path'].$user->id;
                            $ejdFileName = $user->id .'_ejd_'.date('YmdHis'). '.' . $ejd_file->extension;
                            FileHelper::createDirectory( $ejdFileDir, $mode = 0777, $recursive = true);
                            $ejd_file->saveAs($ejdFileDir. '/'.$ejdFileName);
                            $user->ejd_file = $ejdFileName;
                        }
                        break;
                    case 'temporary_registration_file':
                        // Passport
                        $temporary_registration_file = UploadedFile::getInstance($passport, 'temporary_registration_file');
                        if ($temporary_registration_file){
                            $temporaryRegistrationFileDir = Yii::$app->params['module']['user']['path'].$user->id;
                            $temporaryRegistrationFileName = $user->id .'_temporary_registration_'.date('YmdHis'). '.' . $temporary_registration_file->extension;
                            FileHelper::createDirectory( $temporaryRegistrationFileDir, $mode = 0777, $recursive = true);
                            $temporary_registration_file->saveAs($temporaryRegistrationFileDir. '/'.$temporaryRegistrationFileName);
                            $user->temporary_registration_file = $temporaryRegistrationFileName;
                        }
                        break;
                    default:
                        $user->$userKey = $userVal;
                        break;
                }
            }

            $user->save();
        }

        if ($user && isset(Yii::$app->request->post()['User']) && is_array(Yii::$app->request->post()['User'])) {
            foreach (Yii::$app->request->post()['User'] as $userKey => $userVal) {
                switch ($userKey) {
                    case 'work_transferred_file':
                        // Transferred file
                        $work_transferred_file = UploadedFile::getInstance($user, 'work_transferred_file');
                        if ($work_transferred_file){
                            $fileDir = Yii::$app->params['module']['user']['path'].$user->id;
                            $fileName = $user->id .' | '.$user->fio.' | Заявление о переводе | '.date('d.m.Y H:i:s'). '.' . $work_transferred_file->extension;
                            FileHelper::createDirectory( $fileDir, $mode = 0777, $recursive = true);
                            $work_transferred_file->saveAs($fileDir. '/'.$fileName);
                            $user->work_transferred_file = $fileName;
                        }
                        break;
                    default:
                        $user->$userKey = $userVal;
                        break;
                }
            }

            $user->save();
        }

        if (isset(Yii::$app->request->post()['Spouse']) && is_array(Yii::$app->request->post()['Spouse'])) {
            if ($user) {
                $spose->user_id = $user->id;
            }

            foreach (Yii::$app->request->post()['Spouse'] as $sposeKey => $sposeVal) {
                $spose->$sposeKey = $sposeVal;
            }

            $spose->save();

        }




        // $user->load(Yii::$app->request->post()) && $user->save()
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->upload();

            // Отправлено на проверку куратору
            if (isset(Yii::$app->request->post()['check'])) {
                $model->status_id = 2;

                $orderStage = new OrderStage();
                $orderStage->order_id = $id;
                $orderStage->status_id = 2;
                $orderStage->comment = 'Заявка переведена для проверки куратором';
                $orderStage->save();

            }
            $model->save();

            if ($model->status_id == 1) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                // Отправляем письмо кураторам
                $this->actionSendEmailCurator($model);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }


        return $this->render(
            'update',
            [
                'model' => $model,
                'usermd' => $user,
                'spose' => $spose,
                'passport' => $passport,
                //'spose' => $model,
                //'userChildDataProvider'=>$userChildDataProvider
            ]
        );
    }

    // Остановить заявку
    public function actionStop($id)
    {
        $model = new OrderStop();
        $order = Order::findOne($id);

        $model->order_id = $id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // Присваиваем статус отмена
            $order->status_id = 15;
            $order->save();

            return $this->redirect(['view', 'id' => $id]);
        }

        return $this->render('stop', [
            'model' => $model,
            'order' => $order,
        ]);
    }

    public function actionCheck($id)
    {
        return $this->render(
            'check/check',
            [
                'model' => $this->findModel($id),
            ]
        );
    }

    // Проверка куратором
    public function actionCheck0($id)
    {
        $orderStage = new OrderStage();

        $orderStage->order_id = $id;

        if (isset(Yii::$app->request->post()['status_id'])) {
            $orderStage->status_id = Yii::$app->request->post()['status_id'];
        }

        if ($orderStage->load(Yii::$app->request->post()) && $orderStage->save()) {
            $order = $this->findModel($id);
            $order->status_id = $orderStage->status_id;
            $order->save();

            return $this->redirect(['index']);
        }

        return $this->render(
            'check0',
            [
                'order' => $this->findModel($id),
                'stage' => $orderStage,
                'user' => User::findOne($this->findModel($id)->created_by),
            ]
        );
    }


    public function actionHistory($id)
    {

        // Займы текущего пользователя
        $orderStageSearchModel = new OrderStageSearch();
        $stages = $orderStageSearchModel->search(['OrderStageSearch' => ['order_id' => $id]]);


        return $this->render(
            'history',
            [
                'model' => $this->findModel($id),
                'stages' => $stages,
            ]
        );
    }


    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    // Отправляем письма кураторам
    public function actionSendEmailCurator($order)
    {

        // Ищем всех кураторов
        $curators = User::findAll(['role_id' => 1]);

        // Автор заявки
        $user = User::findOne(Yii::$app->user->identity->getId());

        // Отправляем письма всем кураторам
        foreach ($curators as $curator) {
            Yii::$app->mailer->compose(
                '@app/modules/jk/mails/order_curator',
                [
                    'user' => $user,
                    'curator' => $curator,
                    'order' => $order,
                ]
            )
                ->setFrom('workshop@tr.ru')
                ->setTo($curator->email)
                ->setSubject('WORKSHOP / ЖК / Куратору')
                ->send();
        }
        return true;
    }

    // Передаём заявку куратору на проверку
    public function action2curator($id)
    {
        $order=Order::findOne($id);
        $order->status_id=Status::findOne(['code'=>'MANAGER_WAIT'])->id;
        $order->save();

        Yii::$app->session->setFlash('success', "Начат процесс согласования вашей заявки на оказание материальной помощи<br/>
        Вы будете получать email-уведомления, а также можете смотреть через личный кабинет, у кого из руководителей заявка в данный момент находится на согласовании");
        return $this->redirect(['/jk/order/view/','id'=>$id]);

    }

    // Запускаем процесс согласования заявки
    public function actionManager($id)
    {
        Agreement::sendEmailManager($id);
        $order=Order::findOne($id);
        $order->status_id=Status::findOne(['code'=>'MANAGER_WAIT'])->id;
        $order->save();

        Yii::$app->session->setFlash('success', "Начат процесс согласования вашей заявки на оказание материальной помощи<br/>
        Вы будете получать email-уведомления, а также можете смотреть через личный кабинет, у кого из руководителей заявка в данный момент находится на согласовании");
        return $this->redirect(['/jk/order/view/','id'=>$id]);

    }

    public function actionPdAgreement($id) {
        $order=Order::findOne($id);
        if (!$order) {
            return;
        }
        $pathDir = Yii::$app->params['module']['jk']['order']['filePath'] . $id;
        $file = $pathDir.DIRECTORY_SEPARATOR.$order->file_agree_personal_data;

        if (file_exists($file)) {
            Yii::$app->response->sendFile($file);
        }
    }
}