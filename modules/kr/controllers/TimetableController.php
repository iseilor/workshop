<?php

namespace app\modules\kr\controllers;

use Yii;
use app\modules\kr\models\Timetable;
use app\modules\kr\models\TimetableSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TimetableController implements the CRUD actions for Timetable model.
 */
class TimetableController extends Controller
{

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
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index','bti','it','b2b','b2c','b2g'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Timetable models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TimetableSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setSort(['defaultOrder' => ['weight' => SORT_ASC]]);
        $dataProvider->query->andWhere(['block_id'=>0]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'subTitle'=>''
        ]);
    }

    public function actionAdmin()
    {
        $searchModel = new TimetableSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('admin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Timetable model.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Timetable model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Timetable();
        $model->weight = Timetable::getMaxWeight() + 10;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->createQR();
            return $this->redirect(['admin']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Timetable model.
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->createQR();
            return $this->redirect(['admin']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Timetable model.
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

        return $this->redirect(['admin']);
    }

    /**
     * Finds the Timetable model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return Timetable the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Timetable::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * Lists all Timetable models.
     *
     * @return mixed
     */
    public function actionBti()
    {
        $searchModel = new TimetableSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setSort(['defaultOrder' => ['weight' => SORT_ASC]]);
        $dataProvider->query->andWhere(['block_id'=>1]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'subTitle'=>'БТИ'
        ]);
    }

    // IT
    public function actionIt()
    {
        $searchModel = new TimetableSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setSort(['defaultOrder' => ['weight' => SORT_ASC]]);
        $dataProvider->query->andWhere(['block_id'=>2]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'subTitle'=>'ИТ'
        ]);
    }

    // B2B
    public function actionB2b()
    {
        $searchModel = new TimetableSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setSort(['defaultOrder' => ['weight' => SORT_ASC]]);
        $dataProvider->query->andWhere(['block_id'=>3]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'subTitle'=>'B2B'
        ]);
    }

    // B2C
    public function actionB2c()
    {
        $searchModel = new TimetableSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setSort(['defaultOrder' => ['weight' => SORT_ASC]]);
        $dataProvider->query->andWhere(['block_id'=>4]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'subTitle'=>'B2C'
        ]);
    }

    // B2G
    public function actionB2g()
    {
        $searchModel = new TimetableSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setSort(['defaultOrder' => ['weight' => SORT_ASC]]);
        $dataProvider->query->andWhere(['block_id'=>5]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'subTitle'=>'B2G'
        ]);
    }
}
