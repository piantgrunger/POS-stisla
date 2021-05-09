<?php

namespace app\controllers;

use Yii;
use app\models\Stok;
use app\models\StokSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KartuStokController implements the CRUD actions for Stok model.
 */
class KartuStokController extends Controller
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
        $searchModel = new StokSearch();
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
    public function actionView($no_dokumen, $id_barang, $ref)
    {
        return $this->render('view', [
            'model' => $this->findModel($no_dokumen, $id_barang, $ref),
        ]);
    }

    /**
     * Creates a new Stok model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Stok();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'no_dokumen' => $model->no_dokumen, 'id_barang' => $model->id_barang, 'ref' => $model->ref]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Stok model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $no_dokumen
     * @param integer $id_barang
     * @param string $ref
     * @return mixed
     */
    public function actionUpdate($no_dokumen, $id_barang, $ref)
    {
        $model = $this->findModel($no_dokumen, $id_barang, $ref);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'no_dokumen' => $model->no_dokumen, 'id_barang' => $model->id_barang, 'ref' => $model->ref]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Stok model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $no_dokumen
     * @param integer $id_barang
     * @param string $ref
     * @return mixed
     */
    public function actionDelete($no_dokumen, $id_barang, $ref)
    {
        
       try
      {
        $this->findModel($no_dokumen, $id_barang, $ref)->delete();
      
      }
      catch(\yii\db\IntegrityException  $e)
      {
	Yii::$app->session->setFlash('error', "Data Tidak Dapat Dihapus Karena Dipakai Modul Lain");
       } 
         return $this->redirect(['index']);
    }

    /**
     * Finds the Stok model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $no_dokumen
     * @param integer $id_barang
     * @param string $ref
     * @return Stok the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($no_dokumen, $id_barang, $ref)
    {
        if (($model = Stok::findOne(['no_dokumen' => $no_dokumen, 'id_barang' => $id_barang, 'ref' => $ref])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
