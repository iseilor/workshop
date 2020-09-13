<?php

namespace app\modules\jk\controllers;

use app\modules\jk\models\Agreement;
use app\modules\jk\models\Order;
use app\modules\jk\models\OrderSearch;
use app\modules\jk\models\OrderStage;
use app\modules\jk\models\OrderStageSearch;
use app\modules\jk\models\OrderStop;
use app\modules\jk\models\Rf;
use app\modules\jk\models\Status;
use app\modules\jk\Module;
use app\modules\user\models\Child;
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


        // Ищем незавершенные заявки и перенаправляем на их редактирование
        if ($user) {
            $unfilledOrder = \app\modules\jk\models\Order::find()
                ->where(['created_by' => $user->id])
                ->andWhere(['<', 'filling_step', 8])
                ->orderBy(['updated_at' => SORT_DESC])
                ->one();
            if ($unfilledOrder) {
                return $this->redirect(['order/' . $unfilledOrder->id . '/update']);
            }
        }

        $model = new Order();
        $model->status_id = Status::findOne(['code' => 'NEW'])->id;

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
                        if ($passport_file) {
                            $passportFileDir = Yii::$app->params['module']['user']['path'] . $user->id;
                            $passportFileName = $user->id . '_passport_' . date('YmdHis') . '.' . $passport_file->extension;
                            FileHelper::createDirectory($passportFileDir, $mode = 0777, $recursive = true);
                            $passport_file->saveAs($passportFileDir . '/' . $passportFileName);
                            $user->passport_file = $passportFileName;
                        }
                        break;
                    case 'ejd_file':
                        // Passport
                        $ejd_file = UploadedFile::getInstance($passport, 'ejd_file');
                        if ($ejd_file) {
                            $ejdFileDir = Yii::$app->params['module']['user']['path'] . $user->id;
                            $ejdFileName = $user->id . '_ejd_' . date('YmdHis') . '.' . $ejd_file->extension;
                            FileHelper::createDirectory($ejdFileDir, $mode = 0777, $recursive = true);
                            $ejd_file->saveAs($ejdFileDir . '/' . $ejdFileName);
                            $user->ejd_file = $ejdFileName;
                        }
                        break;
                    case 'temporary_registration_file':
                        // Passport
                        $temporary_registration_file = UploadedFile::getInstance($passport, 'temporary_registration_file');
                        if ($temporary_registration_file) {
                            $temporaryRegistrationFileDir = Yii::$app->params['module']['user']['path'] . $user->id;
                            $temporaryRegistrationFileName = $user->id . '_temporary_registration_' . date('YmdHis') . '.'
                                . $temporary_registration_file->extension;
                            FileHelper::createDirectory($temporaryRegistrationFileDir, $mode = 0777, $recursive = true);
                            $temporary_registration_file->saveAs($temporaryRegistrationFileDir . '/' . $temporaryRegistrationFileName);
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
                        if ($work_transferred_file) {
                            $fileDir = Yii::$app->params['module']['user']['path'] . $user->id;
                            $fileName = $user->id . ' | ' . $user->fio . ' | Заявление о переводе | ' . date('d.m.Y H:i:s') . '.'
                                . $work_transferred_file->extension;
                            FileHelper::createDirectory($fileDir, $mode = 0777, $recursive = true);
                            $work_transferred_file->saveAs($fileDir . '/' . $fileName);
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

            // Сразу делаем первый этап, когда была создана заявка
            $orderStage = new OrderStage();
            $orderStage->order_id = $model->id;
            $orderStage->status_id = Status::findOne(['code' => 'NEW'])->id;
            $orderStage->comment = 'Новая заявка';
            $orderStage->save();

            // Если не заполнены согласия ("0" этап) открываем редактирование модели
            // для заполнения согласий на обработку перс данных
            if (!$model->file_agree_personal_data) {
                return $this->redirect(['order/' . $model->id . '/update#tabs-agreement', 'id' => $model->id]);
            }

            $model->upload();

            return $this->redirect(['view', 'id' => $model->id]);
        } elseif ($model->filling_step > 0 && $model->getOldAttribute('filling_step') != $model->filling_step) {
            // Если не смогли сохранить заявку, откатываемся на 1 шаг
            $model->filling_step--;
        }

        // Если заявка создана на основании калькулятора процентов или займа
        if (isset($_GET['percent_id'])) {
            $model->loadDataPercent($_GET['percent_id']);
        }
        if (isset($_GET['zaim_id'])) {
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
                        if ($passport_file) {
                            $passportFileDir = Yii::$app->params['module']['user']['path'] . $user->id;
                            $passportFileName = $user->id . '_passport_' . date('YmdHis') . '.' . $passport_file->extension;
                            FileHelper::createDirectory($passportFileDir, $mode = 0777, $recursive = true);
                            $passport_file->saveAs($passportFileDir . '/' . $passportFileName);
                            $user->passport_file = $passportFileName;
                        }
                        break;
                    case 'ejd_file':
                        // Passport
                        $ejd_file = UploadedFile::getInstance($passport, 'ejd_file');
                        if ($ejd_file) {
                            $ejdFileDir = Yii::$app->params['module']['user']['path'] . $user->id;
                            $ejdFileName = $user->id . '_ejd_' . date('YmdHis') . '.' . $ejd_file->extension;
                            FileHelper::createDirectory($ejdFileDir, $mode = 0777, $recursive = true);
                            $ejd_file->saveAs($ejdFileDir . '/' . $ejdFileName);
                            $user->ejd_file = $ejdFileName;
                        }
                        break;
                    case 'temporary_registration_file':
                        // Passport
                        $temporary_registration_file = UploadedFile::getInstance($passport, 'temporary_registration_file');
                        if ($temporary_registration_file) {
                            $temporaryRegistrationFileDir = Yii::$app->params['module']['user']['path'] . $user->id;
                            $temporaryRegistrationFileName = $user->id . '_temporary_registration_' . date('YmdHis') . '.'
                                . $temporary_registration_file->extension;
                            FileHelper::createDirectory($temporaryRegistrationFileDir, $mode = 0777, $recursive = true);
                            $temporary_registration_file->saveAs($temporaryRegistrationFileDir . '/' . $temporaryRegistrationFileName);
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
                        if ($work_transferred_file) {
                            $fileDir = Yii::$app->params['module']['user']['path'] . $user->id;
                            $fileName = $user->id . ' | ' . $user->fio . ' | Заявление о переводе | ' . date('d.m.Y H:i:s') . '.'
                                . $work_transferred_file->extension;
                            FileHelper::createDirectory($fileDir, $mode = 0777, $recursive = true);
                            $work_transferred_file->saveAs($fileDir . '/' . $fileName);
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
                switch ($sposeKey) {
                    case 'personal_data_file_form':
                        $sposePdFile = UploadedFile::getInstance($spose, 'personal_data_file_form');
                        if ($sposePdFile) {
                            $sposeFileDir = Yii::$app->params['module']['spouse']['filePath'] . $spose->id;
                            $sposeFileName = 'spouse_' . $spose->id . '_personal_data_file_' . date('YmdHis') . '.' . $sposePdFile->extension;
                            FileHelper::createDirectory($sposeFileDir, $mode = 0777, $recursive = true);
                            $sposePdFile->saveAs($sposeFileDir . '/' . $sposeFileName);
                            $spose->personal_data_file = $sposeFileName;
                        }
                        break;
                    default:
                        $spose->$sposeKey = $sposeVal;
                }


            }

            $spose->save();
        }

        if ($user && isset(Yii::$app->request->post()['Child']) && is_array(Yii::$app->request->post()['Child'])) {
            foreach (Yii::$app->request->post()['Child'] as $childKey => $childVal) {
                switch ($childKey) {
                    case 'file_personal_form':
                        if (is_array($childVal)) {
                            foreach ($childVal as $childId => $childFieldVal) {
                                $child = Child::findOne($childId);
                                //var_dump($child);
                                if ($child) {
                                    // child personal file
                                    $childPdFile = UploadedFile::getInstance($child, 'file_personal_form[' . $childId . ']');
                                    if ($childPdFile) {
                                        $childFileDir = Yii::$app->params['module']['child']['filePath'] . $child->id;
                                        $childFileName = 'child_' . $child->id . '_file_personal_' . date('YmdHis') . '.' . $childPdFile->extension;
                                        FileHelper::createDirectory($childFileDir, $mode = 0777, $recursive = true);
                                        $childPdFile->saveAs($childFileDir . '/' . $childFileName);
                                        $child->file_personal = $childFileName;
                                        $child->save();
                                    }
                                }
                            }
                        }
                        break;
                }
            }
        }

        // $user->load(Yii::$app->request->post()) && $user->save()
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->upload();
            $model->save();
            // Если не заполнены согласия ("0" этап) открываем редактирование модели
            // для заполнения согласий на обработку перс данных
            if (!$model->file_agree_personal_data) {
                return $this->redirect(['order/' . $model->id . '/update#tabs-agreement', 'id' => $model->id]);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } elseif ($model->filling_step > 0 && $model->getOldAttribute('filling_step') != $model->filling_step) {
            // Если не смогли сохранить заявку, откатываемся на 1 шаг
            $model->filling_step--;
        }


        return $this->render(
            'update',
            [
                'model' => $model,
                'usermd' => $user,
                'spose' => $spose,
                'passport' => $passport,
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


    /**
     * Наработки для проверки по полям
     * //TODO: пока заглушка
     *
     * @param $id
     *
     * @return string
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionCheck0($id)
    {
        return $this->render(
            'check/check',
            [
                'model' => $this->findModel($id),
            ]
        );
    }


    /** Проверка заявки куратором
     *
     * @param $id Номер заявки
     *
     * @return string|\yii\web\Response
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionCheck($id)
    {
        $orderStage = new OrderStage();
        $orderStage->order_id = $id;

        if (isset(Yii::$app->request->post()['status_code'])) {
            $statusCode = Yii::$app->request->post()['status_code'];
            $orderStage->status_id = Status::findOne(['code' => $statusCode])->id;
        }

        if ($orderStage->load(Yii::$app->request->post()) && $orderStage->save()) {
            $order = $this->findModel($id);
            $order->status_id = $orderStage->status_id;
            $order->save();

            // В зависимости от нового статуса шлём разные письма сотруднику
            $user = User::findOne($order->created_by);
            $emailTemplate = '';
            $emailTitle = '';

            switch ($statusCode) {
                case 'CURATOR_RETURN':
                    $emailTemplate = 'userReturn';
                    $emailTitle = 'Возвращено куратором на доработку';
                    break;
                case 'CURATOR_YES':
                    $emailTemplate = 'userYes';
                    $emailTitle = 'Проверено и согласовано куратором';
                    break;
                case 'CURATOR_NO':
                    $emailTemplate = 'userNo';
                    $emailTitle = 'Отклонено куратором';
                    break;
            }
            Yii::$app->mailer->compose(
                '@app/modules/jk/mails/check/' . $emailTemplate,
                [
                    'user' => $user,
                    'order' => $order,
                    'stage' => $orderStage,
                ]
            )
                ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
                ->setTo($user->email)
                ->setBcc(Yii::$app->params['supportEmail'])
                ->setSubject("HR-портал / ЖП / Заявка №" . $order->id . " / " . $emailTitle . '.')
                ->send();

            return $this->redirect(['index']);
        }

        // История движения заявки
        $orderStageSearchModel = new OrderStageSearch();
        $stages = $orderStageSearchModel->search(['OrderStageSearch' => ['order_id' => $id]]);

        return $this->render(
            'check',
            [
                'order' => $this->findModel($id),
                'stage' => $orderStage,
                'user' => User::findOne($this->findModel($id)->created_by),
                'stages' => $stages,
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

    // Передаём заявку куратору на проверку
    public function action2curator($id)
    {
        $order = Order::findOne($id);
        $order->status_id = Status::findOne(['code' => 'MANAGER_WAIT'])->id;
        $order->save();

        Yii::$app->session->setFlash('success', "Начат процесс согласования вашей заявки на оказание материальной помощи<br/>
        Вы будете получать email-уведомления, а также можете смотреть через личный кабинет, у кого из руководителей заявка в данный момент находится на согласовании");
        return $this->redirect(['/jk/order/view/', 'id' => $id]);

    }

    public function actionPdAgreement($id)
    {
        $order = Order::findOne($id);
        if (!$order) {
            return;
        }
        $pathDir = Yii::$app->params['module']['jk']['order']['filePath'] . $id;
        $file = $pathDir . DIRECTORY_SEPARATOR . $order->file_agree_personal_data;

        if (file_exists($file)) {
            Yii::$app->response->sendFile($file);
        }
    }


    /**
     * Присвоить заявке новый статус
     *
     * @param $id номер заявки
     *            new-status-code - Код нового статуса из справочника
     *
     * @return \yii\web\Response
     */
    public function actionSetNewStatus($id)
    {
        Yii::$app->session->setFlash('success', "Ваша заявка успешно отправлена");

        // Сохраняем новый статус заявки
        $newStatusCode = $_GET['new-status-code'];
        $newStatus = Status::findOne(['code' => $newStatusCode]);
        $order = Order::findOne($id);
        $order->status_id = $newStatus->id;
        $order->save();

        // В зависимости от нового статуса
        switch ($newStatus->code) {
            case 'MANAGER_WAIT':
                $order->sendManager();
                break;
            case 'CURATOR_CHECK':
                break;
        }

        // Сохраняем в историю движения заявки
        $orderStage = new OrderStage();
        $orderStage->order_id = $id;
        $orderStage->status_id = $newStatus->id;
        $orderStage->comment = $newStatus->title;
        $orderStage->save();

        return $this->redirect(['/jk/order/view/', 'id' => $id]);
    }

    // Формирование заявления
    public function actionOrder($id)
    {
        // Заявка
        $order = Order::findOne($id);
        $user = User::find($order->created_by)->one();

        // В зависимости от типа заявки выбираем шаблон заявления (займ или проценты)
        $file = 'percent.docx';
        if ($order->type == 2) {
            $file = 'zaim.docx';
        }
        $filePath = Yii::getAlias('@app') . '/modules/jk/files/' . $file;
        $templateProcessor = new TemplateProcessor($filePath);

        // Переменные в шаблоне
        $templateProcessor->setValue(
            [
                'FIO',
                'FIO_SHORT',

                'POSITION',
                'WORK_DEPARTMENT',
                'TAB_NUMBER',
                'WORK_PHONE',
                'EMAIL',

                'IPOTEKA_SIZE',
                'IPOTEKA_PERCENT',
                'IPOTEKA_USER',

                'JP_ADDRESS',
                'JP_COST',

                'FAMILY_OWN',
                'FAMILY_RENT',
                'FAMILY_ADDRESS',
                'FAMILY_DEAL',
                'FAMILY_LIST',

                'MONEY_MONTH_PAY',
                'MONEY_USER_PAY',

                'DATE',
            ],
            [
                $user->fio,
                $user->getFioShortDocx(),

                $user->position,
                $user->work_department,
                $user->tab_number,
                $user->work_phone,
                $user->email,

                number_format($order->ipoteka_size, 2, ',', ' '),
                $order->ipoteka_percent,
                number_format($order->ipoteka_user, 2, ',', ' '),

                $order->jp_address,
                number_format($order->jp_cost, 2, ',', ' '),

                $order->family_own,
                $order->family_rent,
                $order->family_address,
                $order->family_deal,
                $order->getFamilyList(),

                number_format($order->money_month_pay, 2, ',', ' '),
                number_format($order->money_user_pay, 2, ',', ' '),

                date('d.m.Y'),
            ]
        );

        // Ссылка для скачивания
        $fileUrl = '/files/jk/order/' . $id . '/JK_ORDER_' . $id . '_' . $user->surname . '_' . date('Y-m-d H-i-s') . '.docx';
        $templateProcessor->saveAs(Yii::getAlias('@app') . '/web' . $fileUrl);
        return Yii::$app->response->sendFile(Yii::getAlias('@webroot') . $fileUrl);
    }
}