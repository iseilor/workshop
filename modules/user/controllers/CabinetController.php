<?php

namespace app\modules\user\controllers;

use app\modules\jk\models\AgreementSearch;
use app\modules\nsi\models\ColorSearch;
use app\modules\user\models\User;
use PhpOffice\PhpWord\TemplateProcessor;
use Yii;
use app\modules\user\models\Child;
use app\modules\user\models\ChildSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ChildController implements the CRUD actions for Child model.
 */
class CabinetController extends Controller
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
        ];
    }

    /**
     * Lists all Child models.
     *
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new AgreementSearch();
        $queryParams = Yii::$app->request->queryParams;
        $queryParams['AgreementSearch']['user_id']=Yii::$app->user->identity->id;
        $dataProvider = $searchModel->search($queryParams) ;
        $dataProvider->query->andWhere('receipt_at>0'); // Только те, которые уже быле переданы на согласование

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
