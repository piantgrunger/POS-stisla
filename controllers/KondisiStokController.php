<?php

namespace app\controllers;

use Yii;
use app\models\KondisiStokSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KartuStokController implements the CRUD actions for Stok model.
 */
class KondisiStokController extends Controller
{
    /**
     * @inheritdoc
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
        ];
    }

    /**
     * Lists all Stok models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KondisiStokSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Stok model.
     * @param string $no_dokumen
     * @param integer $id_barang
     * @param string $ref
     * @return mixed
     */
    
}
