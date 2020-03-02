<?php

namespace app\modules\jk\controllers;

use app\modules\jk\models\OrderStage;
use app\modules\jk\Module;
use app\modules\user\models\User;
use Yii;
use app\modules\jk\models\Order;
use app\modules\jk\models\OrderSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
            'url' => ['/jk']
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
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render(
            'view',
            [
                'model' => $this->findModel($id),
            ]
        );
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();

        $model->status_id = 1;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render(
            'create',
            [
                'model' => $model,
            ]
        );
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->upload();

            if (isset(Yii::$app->request->post()['check'])) {
                $model->status_id = 2;
            }
            $model->save();

            if ($model->status_id == 1) {
                return $this->redirect(['update', 'id' => $model->id]);
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
            ]
        );
    }

    // Проверка куратором
    public function actionCheck($id)
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
            'check',
            [
                'order' => $this->findModel($id),
                'stage' => $orderStage,
                'user' => User::findOne($this->findModel($id)->created_by)
            ]
        );
    }


    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
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
     * @param integer $id
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
        $curators = User::findAll(['role_id'=>1]);

        // Автор заявки
        $user = User::findOne(Yii::$app->user->identity->getId());

        // Отправляем письма всем кураторам
        foreach ($curators as $curator) {
            Yii::$app->mailer->compose(
                '@app/modules/jk/mails/order_curator',
                [
                    'user' => $user,
                    'curator' => $curator,
                    'order' => $order
                ]
            )
                ->setFrom('workshop@tr.ru')
                ->setTo($curator->email)
                ->setSubject('WORKSHOP / ЖК / Куратору')
                ->send();
        }
        return true;
    }

    // Отправить п
    public function actionSendEmailUser($orderStage){

    }
}