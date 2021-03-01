<?php

namespace app\modules\jk\controllers;

use app\modules\jk\models\Agreement;
use app\modules\jk\models\Min;
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
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Yii;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\HttpException;
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
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],

            // Доступ только авторизованным пользователям
            'access0' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],

            //Доступ только для куратора РФ
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'admin'],
                'rules' => [
                    [
                        'actions' => ['index', 'admin'],
                        'allow' => true,
                        'roles' => ['curator_rf'],
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
     * @throws \yii\web\HttpException
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        // Авто заявки и его руководители
        $user_created = User::findOne($model->created_by);
        $manager_list = $user_created->getManagerList();

        // Доступ не ниже куратора, либо автор заявки, либо его руководители
        if (Yii::$app->user->can('curator_rf') || $model->created_by == Yii::$app->user->identity->getId()
            || in_array(Yii::$app->user->identity->getId(), $manager_list)
        ) {
            return $this->render(
                'view/view',
                [
                    'model' => $model,
                ]
            );
        } else {
            throw new HttpException(403, 'Доступ запрещён');
        }

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
                ->andWhere(['<', 'filling_step', 7])
                ->orderBy(['updated_at' => SORT_DESC])
                ->one();
            if ($unfilledOrder) {
                return $this->redirect(['order/' . $unfilledOrder->id . '/update']);
            }
        }

        $min = Min::find()->orderBy('title')->all();
        $model = new Order();
        $model->status_id = Status::findOne(['code' => 'NEW'])->id;

        if ($user) {
            $spouse = Spouse::findOne(['user_id' => $user->id]);
            $passport = $user->passport;
        }
        //         if (!$spouse) {
        //             $spouse = new Spouse();
        //         }

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
            if (!$spouse) {
                $spouse = new Spouse();
            }

            if ($user) {
                $spouse->user_id = $user->id;
            }

            foreach (Yii::$app->request->post()['Spouse'] as $spouseKey => $spouseVal) {
                $spouse->$spouseKey = $spouseVal;
            }

            $spouse->save();

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
                'spouse' => $spouse,
                'passport' => $passport,
                'mins' => $min,
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

        // Доступ не ниже куратора, либо автор заявки
        if (!(Yii::$app->user->can('curator_rf') || $model->created_by == Yii::$app->user->identity->getId())) {
            throw new HttpException(403, 'Доступ запрещён');
        }

        $min = Min::find()->orderBy('title')->all();

        $user = User::findOne($model->created_by);
        if (!$user) {
            $user = $user = User::findOne(Yii::$app->user->identity->getId());
        }

        if ($user) {
            $spouse = Spouse::findOne(['user_id' => $user->id]);
            $passport = $user->passport;
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
            if (!$spouse) {
                $spouse = new Spouse();
            }
            if ($user) {
                $spouse->user_id = $user->id;
            }
            foreach (Yii::$app->request->post()['Spouse'] as $spouseKey => $spouseVal) {
                switch ($spouseKey) {
                    case 'personal_data_file_form':
                        $spousePdFile = UploadedFile::getInstance($spouse, 'personal_data_file_form');
                        if ($spousePdFile) {
                            $spouseFileDir = Yii::$app->params['module']['spouse']['filePath'] . $spouse->id;
                            $spouseFileName = 'spouse_' . $spouse->id . '_personal_data_file_' . date('YmdHis') . '.' . $spousePdFile->extension;
                            FileHelper::createDirectory($spouseFileDir, $mode = 0777, $recursive = true);
                            $spousePdFile->saveAs($spouseFileDir . '/' . $spouseFileName);
                            $spouse->personal_data_file = $spouseFileName;
                        }
                        break;
                    case 'ndfl2_file_form':
                        $spouseNdfl2File = UploadedFile::getInstance($spouse, 'ndfl2_file_form');
                        if ($spouseNdfl2File) {
                            $spouseNdfl2FileDir = Yii::$app->params['module']['spouse']['filePath'] . $spouse->id;
                            $spouseNdfl2FileName = 'spouse_' . $spouse->id . '_ndfl2_file_' . date('YmdHis') . '.' . $spouseNdfl2File->extension;
                            FileHelper::createDirectory($spouseNdfl2FileDir, $mode = 0777, $recursive = true);
                            $spouseNdfl2File->saveAs($spouseNdfl2FileDir . '/' . $spouseNdfl2FileName);
                            $spouse->ndfl2_file = $spouseNdfl2FileName;
                        }
                        break;
                    case 'salary_file_form':
                        $spouseSalaryFile = UploadedFile::getInstance($spouse, 'salary_file_form');
                        if ($spouseSalaryFile) {
                            $spouseSalaryFileDir = Yii::$app->params['module']['spouse']['filePath'] . $spouse->id;
                            $spouseSalaryFileName = 'spouse_' . $spouse->id . '_salary_file_' . date('YmdHis') . '.' . $spouseSalaryFile->extension;
                            FileHelper::createDirectory($spouseSalaryFileDir, $mode = 0777, $recursive = true);
                            $spouseSalaryFile->saveAs($spouseSalaryFileDir . '/' . $spouseSalaryFileName);
                            $spouse->salary_file = $spouseSalaryFileName;
                        }
                        break;
                    default:
                        $spouse->$spouseKey = $spouseVal;
                }


            }

            $spouse->save();
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
        // var_dump($min);
        // die();

        return $this->render(
            'update',
            [
                'model' => $model,
                'usermd' => $user,
                'spouse' => $spouse,
                'passport' => $passport,
                'mins' => $min,
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


    /**
     * Проверка заявки куратором
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
                case 'COMMISSION_WAIT':
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
                ->setSubject("HR-портал / Жилищная Программа / Заявка №" . $order->id . " / " . $emailTitle . '.')
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

    /**
     * Оформление документов куратором
     *
     * @param $id Номер заявки
     *
     * @return string|\yii\web\Response
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionDoc($id)
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
                    $emailTemplate = 'check/userReturn';
                    $emailTitle = 'Возвращено куратором на доработку';
                    break;
                case 'CURATOR_NO':
                    $emailTemplate = 'check/userNo';
                    $emailTitle = 'Отклонено куратором';
                    break;
                case 'FINISH':
                    $emailTemplate = 'finish/user';
                    $emailTitle = 'Заявка выполнена';
                    break;

            }
            Yii::$app->mailer->compose(
                '@app/modules/jk/mails/' . $emailTemplate,
                [
                    'user' => $user,
                    'order' => $order,
                    'stage' => $orderStage,
                ]
            )
                ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
                ->setTo($user->email)
                ->setBcc(Yii::$app->params['supportEmail'])
                ->setSubject($order->getEmailSubject($emailTitle))
                ->send();

            return $this->redirect(['index']);
        }

        // История движения заявки
        $orderStageSearchModel = new OrderStageSearch();
        $stages = $orderStageSearchModel->search(['OrderStageSearch' => ['order_id' => $id]]);

        return $this->render(
            'doc',
            [
                'order' => $this->findModel($id),
                'stage' => $orderStage,
                'user' => User::findOne($this->findModel($id)->created_by),
                'stages' => $stages,
            ]
        );
    }

    // Проверка комиссией
    public function actionCommission($id)
    {
        $orderStage = new OrderStage();
        $orderStage->order_id = $id;
        $order = Order::findOne($id);
        $orderStage->field1 = $order->getLoanMaxVal();
        $orderStage->field2 = $order->getLoanPeriod();

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
                case 'COMMISSION_YES':
                    if ($order->is_mortgage) {
                        $emailTemplate = 'commission_yes_percent';
                    } else {
                        $emailTemplate = 'commission_yes_zaim';
                    }
                    $emailTitle = 'Согласовано комиссией';
                    break;
                case 'COMMISSION_NO':
                    $emailTemplate = 'commission_no';
                    $emailTitle = 'Не согласовано комиссией';
                    break;
                case 'RESERVE':
                    $emailTemplate = 'reserve';
                    $emailTitle = 'Заявка переведена в резерв';
                    break;
            }
            Yii::$app->mailer->compose(
                '@app/modules/jk/mails/commission/' . $emailTemplate,
                [
                    'user' => $user,
                    'order' => $order,
                    'stage' => $orderStage,
                    'filial'=> Rf::findOne($user->filial_id)
                ]
            )
                ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
                ->setTo(YII_ENV_PROD ? $user->email : User::findOne(Yii::$app->user->identity->getId())->email)
                ->setBcc(Yii::$app->params['supportEmail'])
                ->setSubject("HR-портал / Жилищная Программа / Заявка №" . $order->id . " / " . $emailTitle . '.')
                ->send();
            return $this->redirect(['index']);
        }

        return $this->render(
            'commission',
            [
                'model' => $this->findModel($id),
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

    // Принудительно передаём заявку на проверку куратору
    public function action2curator($id)
    {
        $this->findModel($id)->sendCurator();
        return $this->redirect(['index']);
    }

    // Переводим в статус оформление документов
    public function action2doc($id)
    {
        $newStatusCode = 'DOC';
        $newStatus = Status::findOne(['code' => $newStatusCode]);
        $order = Order::findOne($id);
        $order->status_id = $newStatus->id;
        $order->save();

        // Сохраняем в историю движения заявки
        $orderStage = new OrderStage();
        $orderStage->order_id = $id;
        $orderStage->status_id = $newStatus->id;
        $orderStage->comment = $newStatus->title;
        $orderStage->save();

        // Письма куратору и сотруднику
        $this->findModel($id)->sendCuratorDoc();
        return $this->redirect(['index']);
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
        // Получаем новый статус заявки
        $newStatusCode = $_GET['new-status-code'];
        $newStatus = Status::findOne(['code' => $newStatusCode]);
        $order = Order::findOne($id);
        $order->status_id = $newStatus->id;

        if ($order->save()) {
            Yii::$app->session->setFlash('success', "Ваша заявка успешно отправлена");

            // В зависимости от нового статуса
            switch ($newStatus->code) {
                case 'MANAGER_WAIT':
                    $order->sendManager();
                    $order->setNewStatus($newStatusCode);
                    break;
                case 'CURATOR_CHECK':
                    $order->sendCurator();
                    break;
                case 'DOC':
                    $order->sendCuratorDoc();
                    break;
            }

            // Сохраняем в историю движения заявки
            $orderStage = new OrderStage();
            $orderStage->order_id = $id;
            $orderStage->status_id = $newStatus->id;
            $orderStage->comment = $newStatus->title;
            $orderStage->save();

            return $this->redirect(['/jk/order/view/', 'id' => $id]);
        } else {
            $errors = '';
            foreach ($order->errors as $error) {
                $errors .= $error[0] . '<br/>';
            }
            Yii::$app->session->setFlash('danger', $errors);
            return $this->redirect(['/jk/order/view/', 'id' => $id]);
        }

    }

    // Формирование заявления
    public function actionOrder($id)
    {
        // Заявка
        $order = Order::findOne($id);
        $user = User::findOne($order->created_by);

        // В зависимости от типа заявки выбираем шаблон заявления (займ или проценты)
        $file = 'percent.docx';

        if ($order->type == 2) {
            $file = 'zaim.docx';
        }
        $filePath = Yii::getAlias('@app') . '/modules/jk/files/' . $file;
        $templateProcessor = new TemplateProcessor($filePath);

        // Региональный филиал
        $rf = Rf::findOne($user->filial_id);

        // Ипотека
        $ipoteka = '';
        if (isset($order->ipoteka_size) && $order->ipoteka_size > 0) {
            $ipoteka = '2. Планируемые условия кредита на улучшение жилищных условий: размер ' . number_format($order->ipoteka_size, 2, ',', ' ')
                . ' руб., срок ' . $order->getIpotekaYearCount() . ' лет, процентная ставка по кредиту ' . $order->ipoteka_percent . '% годовых.'
                . PHP_EOL;
        }

        // Переменные в шаблоне
        $templateProcessor->setValue(
            [
                'HEADER', // Заявление на имя
                'FIO',
                'FIO_SHORT',

                'POSITION',
                'WORK_DEPARTMENT',
                'TAB_NUMBER',
                'WORK_PHONE',
                'EMAIL',
                'IS_PARTICIPATE',

                // Проценты
                'PERCENT_PERCENT',
                'PERCENT_YEAR',

                // Займ
                'ZAIM_COUNT',
                'ZAIM_YEAR',

                // Ипотека
                'IPOTEKA',
                'IPOTEKA_SIZE',
                'IPOTEKA_PERCENT',
                'IPOTEKA_USER',
                'IPOTEKA_YEAR',


                'JP_ADDRESS',
                'JP_COST',
                'JP_AREA',
                'JP_ROOM_COUNT',
                'NEW',
                'JP_TYPE',

                'FAMILY_OWN',
                'FAMILY_RENT',

                'FAMILY_ADDRESS',
                'RESIDENT_OWN_TYPE',
                'JP_ROOM_COUNT2',
                'JP_TYPE2',
                'JP_AREA2',
                'RESIDENT_COUNT',
                'RESIDENT_TYPE',

                'FAMILY_DEAL',
                'IS_DZO',
                'FAMILY_LIST',

                'MONEY_MONTH_PAY',
                'MONEY_USER_PAY',
                'MONEY_MONTH_FAMILY',

                'DATE',
            ],
            [
                $rf->header,
                $user->fio,
                $user->getFioShortDocx(),

                $user->position,
                $user->work_department_full,
                $user->tab_number,
                $user->work_phone,
                $user->email,
                ($order->is_participate > 0) ? 'участвовали' : 'не участвовали',

                // Проценты
                $order->getPcRate(),
                $order->getPcTerm(),

                // Займ
                number_format($order->getLoanMaxVal(), 0, ',', ' '),
                $order->getLoanPeriod(),

                // Ипотека
                $ipoteka,
                number_format($order->ipoteka_size, 2, ',', ' '),
                $order->ipoteka_percent,
                number_format($order->ipoteka_user, 2, ',', ' '),
                $order->getIpotekaYearCount(),

                ($order->is_mortgage) ? $order->jp_address : $order->min->title,
                number_format($order->jp_cost, 2, ',', ' '),
                $order->jp_new_area,
                (isset($order->jp_new_room_count) && $order->jp_new_room_count) ? $order->jp_new_room_count . ' комнат(а/ы)' : '',
                (isset($order->is_new_building) && $order->is_new_building) ? 'новостройка' : 'вторичка',
                (isset($order->jp_new_type)) ? Order::getJPTypeList()[$order->jp_new_type] : 'квартира',

                $order->family_own,
                (isset($order->family_rent) && $order->family_rent)
                    ? 'Я и члены моей семьи имеем следующие действующие договоры найма в жилых помещениях, относящихся к государственному или муниципальному жилищным фондам: '
                    . $order->family_rent : '',

                $order->family_address,
                mb_strtolower(Order::getResidentOwnTypeList()[$order->resident_own_type]),
                $order->jp_room_count,
                mb_strtolower(Order::getJPTypeList()[$order->jp_type]),
                $order->jp_area,
                $order->resident_count,
                (isset($order->resident_type) && $order->resident_type && $order->resident_count > 1) ? '('
                    . mb_strtolower(Order::getResidentTypeList()[$order->resident_type]) . ')' : '',

                $order->family_deal,
                $order->isDZO(),
                $order->getFamilyList(),

                number_format($order->money_month_pay, 2, ',', ' '),
                number_format($order->money_user_pay, 2, ',', ' '),
                number_format($order->getMoneyMonthFamily(), 2, ',', ' '),

                date('d.m.Y'),
            ]
        );

        // Ссылка для скачивания
        FileHelper::createDirectory('files/jk/order/' . $id . '/', $mode = 0777, $recursive = true);
        $fileUrl = '/files/jk/order/' . $id . '/JK_ORDER_' . $id . '_' . $user->surname . '_' . date('Y-m-d_ H-i-s') . '.docx';
        $templateProcessor->saveAs(Yii::getAlias('@app') . '/web' . $fileUrl);
        return Yii::$app->response->sendFile(Yii::getAlias('@webroot') . $fileUrl);
    }

    // Выгрузка документов по заявке
    public function actionUnload($id)
    {
        FileHelper::createDirectory('files/jk/order_archives', $mode = 0777, $recursive = true);

        $zip = new \ZipArchive();
        $zipUrl = '/files/jk/order_archives/order_' . $id . '.zip';

        if (!$zip->open(Yii::getAlias('@webroot') . $zipUrl, \ZipArchive::OVERWRITE | \ZipArchive::CREATE) === true) {
            return false;
        }

        $order = Order::findOne($id);
        $user = User::findOne($order->created_by);
        $passport = $user->passport;

        $spouse = Spouse::findOne(['user_id' => $user->id]);

        $children = $user->children;

        //список файлов в папке зяавки
        $order_dir = '/files/jk/order/' . $id;
        $order_files = scandir(Yii::getAlias('@webroot') . $order_dir);

        //2 файла с названиями '.' и '..'
        unset($order_files[0], $order_files[1]);

        //для отсечения начала и конца названия файла, чтобы получить имя поля в базе
        $order_regs = ['/jk_order_[\d]+_/', '/_[\d]+.[\w]+/'];

        //файлы по заявке
        foreach ($order_files as $file) {
            //сохраняем расширение файла
            preg_match('/.[\w]+$/', $file, $extension);
            //имя поля в базе
            $field = preg_replace($order_regs, '', $file);
            switch (true) {
                case isset($order->{$field}):
                    $fileName = $order->attributeLabels()[$field . '_form'] . $extension[0];
                    $value = $order->{$field};
                    break;
                case isset($user->{$field}):
                    $fileName = $user->attributeLabels()[$field . '_form'] . $extension[0];
                    $value = $user->{$field};
                    break;
                case isset($passport->{$field}):
                    $fileName = $passport->attributeLabels()[$field . '_form'] . $extension[0];
                    $value = $passport->{$field};
                    break;
                default:
                    $value = '';
            }
            //условие, чтобы добавлять в архив только актуальные файлы
            if ($value == $file) {
                $zip->addFile(Yii::getAlias('@webroot') . $order_dir . '/' . $file, $fileName);
            }
        }
        //файлы по работнику
        $user_dir = '/files/user/' . $user->id;
        $user_files = scandir(Yii::getAlias('@webroot') . $user_dir);
        unset($user_files[0], $user_files[1]);
        $user_regs = ['/[\d]+_/', '/_[\d]+.[\w]+/'];
        foreach ($user_files as $file) {
            //сохраняем расширение файла
            preg_match('/.[\w]+$/', $file, $extension);
            //имя поля в базе
            $field = preg_replace($user_regs, '', $file) . '_file';
            switch (true) {
                case isset($user->{$field}) && $user->{$field} == $file:
                    $fileName = $user->attributeLabels()[$field] . $extension[0];
                    $zip->addFile(Yii::getAlias('@webroot') . $user_dir . '/' . $file, $user->fio . '/' . $fileName);
                    break;

                case isset($user->work_transferred_file) && $file == $user->work_transferred_file:
                    //$fileName = $user->attributeLabels()['work_transferred_file'] . $extension[0];
                    $zip->addFile(Yii::getAlias('@webroot') . $user_dir . '/' . $file, $user->fio . '/' . $file);
                    break;

            }
        }
        //файлы по супруге
        if ($spouse) {
            $spouse_dir = '/files/spouse/' . $spouse->id;
            $spouse_files = scandir(Yii::getAlias('@webroot') . $spouse_dir);
            unset($spouse_files[0], $spouse_files[1]);

            $spouse_regs = ['/spouse_[\d]+_/', '/_[\d]+.[\w]+/'];
            foreach ($spouse_files as $file) {
                //сохраняем расширение файла
                preg_match('/.[\w]+$/', $file, $extension);
                //имя поля в базе
                $field = preg_replace($spouse_regs, '', $file);
                switch (true) {
                    case isset($spouse->{$field}):
                        $fileName = $spouse->attributeLabels()[$field . '_form'] . $extension[0];
                        $value = $spouse->{$field};
                        break;
                    default:
                        $value = '';
                }
                if ($value == $file) {
                    $zip->addFile(Yii::getAlias('@webroot') . $spouse_dir . '/' . $file, $spouse->fio . '/' . $fileName);
                }
            }
        }
        //файлы по детям
        if (!empty($children)) {
            foreach ($children as $child) {
                $child_dir = '/files/child/' . $child->id;
                $child_files = scandir(Yii::getAlias('@webroot') . $child_dir);
                unset($child_files[0], $child_files[1]);

                $child_regs = ['/child_[\d]+_/', '/_[\d]+.[\w]+/'];
                foreach ($child_files as $file) {
                    //сохраняем расширение файла
                    preg_match('/.[\w]+$/', $file, $extension);
                    //имя поля в базе
                    $field = preg_replace($child_regs, '', $file);
                    switch (true) {
                        case isset($child->{$field}):
                            $fileName = $child->attributeLabels()[$field . '_form'] . $extension[0];
                            $value = $child->{$field};
                            break;
                        default:
                            $value = '';
                    }
                    if ($value == $file) {
                        $zip->addFile(Yii::getAlias('@webroot') . $child_dir . '/' . $file, $child->fio . '/' . $fileName);
                    }
                }
            }
        }
        $zip->close();

        if (file_exists(Yii::getAlias('@webroot') . $zipUrl)) {
            return Yii::$app->response->sendFile(Yii::getAlias('@webroot') . $zipUrl);
        } else {
            return $this->redirect(['index']);
        }
    }

    // Выгрузка реестра в XLSX-файл
    public function actionExcel()
    {

        // Шаблон
        $templatePath = Yii::getAlias('@app') . '/modules/jk/files/excel_example.xlsx';

        // Сюда складываем все выгрузки
        $dirPath = 'files/jk/excel/';
        FileHelper::createDirectory($dirPath, $mode = 0777, $recursive = true);
        $fileUrl = '/files/jk/excel/orders_' . date('YmdHis') . '.xlsx';

        // Работаем с активной вкладкой
        $spreadsheet = IOFactory::load($templatePath);
        $worksheet = $spreadsheet->getActiveSheet();

        // Формируем данные
        $orders = Order::find()->published()->all();
        $rowNum = 8;
        $num = 1;

        foreach ($orders as $order) {
            $worksheet->getCell('A' . $rowNum)->setValue($num);
            $worksheet->getCell('B' . $rowNum)->setValue($order->createdUser->filial->title);
            $worksheet->getCell('C' . $rowNum)->setValue($order->createdUser->tab_number);
            $worksheet->getCell('D' . $rowNum)->setValue($order->createdUser->fio);
            $worksheet->getCell('E' . $rowNum)->setValue($order->createdUser->work_department_full);
            $worksheet->getCell('F' . $rowNum)->setValue($order->createdUser->position);
            $worksheet->getCell('G' . $rowNum)->setValue(Yii::$app->formatter->format($order->createdUser->birth_date, 'date'));
            $worksheet->getCell('H' . $rowNum)->setValue($order->createdUser->years);
            $worksheet->getCell('I' . $rowNum)->setValue($order->createdUser->gender ? 'М' : 'Ж');
            $worksheet->getCell('J' . $rowNum)->setValue($order->createdUser->pensionDate);
            $worksheet->getCell('K' . $rowNum)->setValue(''); // Дата приёма на работу
            $worksheet->getCell('L' . $rowNum)->setValue(Yii::$app->formatter->format($order->created_at, 'date'));
            $worksheet->getCell('M' . $rowNum)->setValue($order->createdUser->experience);
            $worksheet->getCell('N' . $rowNum)->setValue($order->createdUser->experiencePoints);
            $worksheet->getCell('O' . $rowNum)->setValue('Нет');
            $worksheet->getCell('P' . $rowNum)->setValue(0);
            $worksheet->getCell('Q' . $rowNum)->setValue('Нет');
            $worksheet->getCell('R' . $rowNum)->setValue('TODO'); // Молодой работник
            $worksheet->getCell('S' . $rowNum)->setValue('TODO'); // Баллы за молодого
            $worksheet->getCell('T' . $rowNum)->setValue($order->resident_count); // Кол-во членов семьи

            // Супруга
            $spouseType = $order->createdUser->spouseType;   // Наличие супруги
            $spouseDO = '';
            $spouseWork = '';
            if ($spouse = $order->createdUser->spouse) {
                if ($spouseType == 'Да') {
                    $spouseDO = (isset($spouse->is_do) && $spouse->is_do) ? 'Да' : 'Нет';
                    $spouseWork = (isset($spouse->is_work) && $spouse->is_work) ? 'Да' : 'Нет';
                }
            }
            $worksheet->getCell('U' . $rowNum)->setValue($spouseType);  // Наличие супруги
            $worksheet->getCell('V' . $rowNum)->setValue($spouseDO);    // Супруга в ДО
            $worksheet->getCell('W' . $rowNum)->setValue($spouseWork);  // Супруга официально работает
            $worksheet->getCell('X' . $rowNum)->setValue('TODO'); // Баллы за семейное положение

            // Дети
            $worksheet->getCell('Y' . $rowNum)->setValue('TODO');
            $worksheet->getCell('Z' . $rowNum)->setValue('TODO');
            $worksheet->getCell('AA' . $rowNum)->setValue($order->createdUser->childsCount);    // Всего детей

            // Доходы
            $worksheet->getCell('AC' . $rowNum)->setValue(Yii::$app->formatter->asCurrency($order->money_summa_year));
            $worksheet->getCell('AD' . $rowNum)->setValue(''); // Должностной оклад брать из 12

            // Собственность в наличии
            $worksheet->getCell('AG' . $rowNum)->setValue($order->family_own);
            $worksheet->getCell('AH' . $rowNum)->setValue($order->jp_total_area);
            $worksheet->getCell('AI' . $rowNum)->setValue($order->jp_part);
            $worksheet->getCell('AJ' . $rowNum)->setValue($order->is_mortgage);

            //
            $worksheet->getCell('AL' . $rowNum)->setValue('TODO'); // Соц.найм
            $worksheet->getCell('AM' . $rowNum)->setValue('TODO'); // Условия проживания
            $worksheet->getCell('AN' . $rowNum)->setValue(Order::getResidentOwnTypeList()[$order->resident_own_type]); // Вид проживания

            $worksheet->getCell('AO' . $rowNum)->setValue('TODO'); // Соц.найм
            $worksheet->getCell('AP' . $rowNum)->setValue('TODO'); // Соц.найм
            $worksheet->getCell('AQ' . $rowNum)->setValue($order->getCorpNorm()); // Корпоративная норма площади

            // Сведения о  жилом помещении, приобретаемом с помощью Общества
            $worksheet->getCell('AR' . $rowNum)->setValue($order->jp_new_area);     // Общая площадь
            $worksheet->getCell('AS' . $rowNum)->setValue(Yii::$app->formatter->asCurrency($order->jp_cost));       // Стоимость
            $worksheet->getCell('AT' . $rowNum)->setValue(Yii::$app->formatter->asCurrency($order->ipoteka_user));  // Собственные средства работника, тыс. руб.
            $worksheet->getCell('AU' . $rowNum)->setValue(round($order->getCorporateAreaNormFactor(),3));  // Коэффициент учета корпоративной нормы площади

            $worksheet->getCell('AV' . $rowNum)->setValue(($order->ipoteka_size>0)?Yii::$app->formatter->asCurrency($order->ipoteka_size):''); // Сумма имеющейся ипотеки
            $worksheet->getCell('AW' . $rowNum)->setValue($order->ipoteka_percent);   // Ставка по имеющейся ипотеке

            $worksheet->getCell('AX' . $rowNum)->setValue($order->getLoanMaxVal());     // Размер займа
            $worksheet->getCell('AY' . $rowNum)->setValue($order->getLoanPeriod());     // Срок возврата, лет
            $worksheet->getCell('AZ' . $rowNum)->setValue($order->getPcRate());         // Ставка компенсации %
            $worksheet->getCell('BA' . $rowNum)->setValue($order->getPcTerm());         // Срок выплаты компенсации

            $worksheet->getCell('BD' . $rowNum)->setValue($order->createdUser->work_address);         // Адрес рабочего места
            $worksheet->getCell('BF' . $rowNum)->setValue(Yii::$app->formatter->asCurrency($order->getPcMaxVal()));         // Максимальная сумма компенсации процентов в год (расчетная)
            $worksheet->getCell('BG' . $rowNum)->setValue ((isset($order->createdUser->is_do) && $order->createdUser->is_do) ? 'Да' : 'Нет'); // Декретный отпуск

            $worksheet->getCell('BI' . $rowNum)->setValue(Yii::$app->formatter->format($order->ipoteka_last_date, 'date')); // Срок закрытия кредитного договора
            //$worksheet->getCell('BJ' . $rowNum)->setValue(Order::getIpotekaTargetName($order->id)); //

            $rowNum++;
            $num++;


        }


        // Сохраняем и выгружаем в браузер файл
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save(Yii::getAlias('@app') . '/web' . $fileUrl);
        return Yii::$app->response->sendFile(Yii::getAlias('@webroot') . $fileUrl);
    }


    /**
     * AJAX-action
     * Принудительная повторная отправка уведомления руководителю, у которогона данный момент находится заявка на согласовании
     *
     * @param $id Номер заявки
     */
    public function actionManager($id)
    {
        Agreement::sendEmailManager($id); // Отправляем письмо руководителю
        $order = Order::findOne($id)->setNewStatus('MANAGER_WAIT_REPEAT');
        $agreement = Agreement::find()->where(['order_id' => $id, 'approval_at' => null])->one();
        $manager = User::findOne($agreement->user_id);
        return 'Повторное email-уведомление о необходимости согласования заявки было направлено на имя: <strong>' . $manager->fio . '</strong>';
    }

    public function actionAddressupdate($address, $id)
    {
        $order = $this->findModel($id);
        $user = User::findOne($order->created_by);
        if (!$user) {
            $user = $user = User::findOne(Yii::$app->user->identity->getId());
        }

        $passport = $user->passport;
        if ($passport) {
            $user->passport_registration = $address;
            $user->update();
        }
    }
}