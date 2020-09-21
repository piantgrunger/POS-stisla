<?php

namespace app\controllers;

use Yii;
use app\models\Penjualan;
use app\models\PenjualanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use app\models\Setting;
use kartik\mpdf\Pdf;
use app\models\BarangSearch;
use yii\helpers\Url;

/**
 * PenjualanController implements the CRUD actions for Penjualan model.
 */
class PenjualanController extends Controller
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
     * Lists all Penjualan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PenjualanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Penjualan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Penjualan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id=null)
    {
        $model = new Penjualan();
        $default = Setting::find()->one();
      
      

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->listPenjualan = Yii::$app->request->post('ItemPenjualan', []);
                if (($model->save())) {
                    $transaction->commit();
                    return $this->redirect(['pembayaran','id'=>$model->id]);
                }
            } catch (\Exception $ecx) {
                $transaction->rollBack();
                throw $ecx;
            }
            $model->no_dokumen = $default->no_penjualan;
          
            return $this->render('create', [
                'model' => $model,
            ]);
        } else {
            $model->tanggal = date('Y-m-d');
            $model->id_gudang = $default->gudang_default;
            $model->id_customer = $default->customer_default;
            $model->no_dokumen = $default->no_penjualan;
          
           if($id!== null) {
             
                  
            $url= Url::to(['print','id'=>$id]);
            $script = "
            function openInNewTab(url) {
              var win = window.open(url, '_blank');
              win.focus();
            }
             openInNewTab('$url');
          ";
          $this->getView()->registerJs( $script , \yii\web\View::POS_READY );
           }
          
            
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Penjualan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
  
     public function actionBrowseBarang()
     {
     
        $searchModel = new BarangSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->renderAjax('browse-barang', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
     
     
     }

    public function actionPembayaran($id)
    {
        $model = $this->findModel($id);
        $model->scenario ='pembayaran';
        if ($model->load(Yii::$app->request->post())) {
           
            if ($model->save()) {
         
             return $this->redirect(['create','id'=>$id]);
              
            }
        }

        $model->total = $model->totalPenjualan;  
        return $this->render(
            'pembayaran',
            [
              'model' => $model,
            ]
        );
    }

    public function actionPrint($id)
    {
      $content = $this->renderPartial('print',[
            'model'=>$this->findModel($id),
            'setting' => (Setting::find()->one())
             
      ]);
            $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            //     'cssFile' => '@app/web/css/print.css',
            'defaultFont' => 'Arial',
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',

            // any css to be embedded if required
            'cssInline' => ' .page
          {
            height:200mm;
            width:40mm;
            page-break-after:always;
          }',
            // set mPDF properties on the fly
            'options' => ['title' => 'Cetak  '],
            // call mPDF methods on the fly
        ]);

        return  $pdf->render();
      
      
      
    }
  
    public function actionGetHarga($id)
    {
        $model = \app\models\Barang::findOne(['id' => $id]);

        return Json::encode([
            'harga_jual' => $model->harga_jual,
            'nama_satuan' => $model->satuan_std->nama,
            'id_satuan_std' => $model->id_satuan_std,
            
        ]);
    }

    public function actionGetBarang($kode)
    {
        $model = \app\models\Barang::find() ->with(['satuan_std']) ->where(['barcode' => $kode])->asArray()->one();

        return Json::encode($model);
    }
     
    public function actionSatuan()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id = $_POST['depdrop_parents'];
            $out = [];
            $data = \app\models\ItemSatuanBarang::find()
                ->select([
                    'id' => 'satuan.id', 'name' => 'nama',
                ])
                ->innerJoin('satuan', 'item_satuan_barang.id_satuan = satuan.id ')
                ->where(['id_barang' => $id])
                ->asArray()
                ->all();
            foreach ($data as $i => $list) {
                $out[] = ['id' => $list['id'], 'name' => $list['name']];
            }
            $data = \app\models\Barang::find()
                ->select([
                    'id' => 'id_satuan_std', 'name' => 'satuan.nama',
                ])
                ->innerJoin('satuan', 'barang.id_satuan_std = satuan.id ')
                ->where(['barang.id' => $id])
                ->asArray()
                ->all();
            foreach ($data as $i => $list) {
                $out[] = ['id' => $list['id'], 'name' => $list['name']];
            }

            if (!empty($_POST['depdrop_params'])) {
                $params = $_POST['depdrop_params'];
                $param1 = $params[0]; // get the value of input-type-1
                $param2 = $params[1]; // get the value of input-type-2
            } else {
                $selected = '';
            }
            // and return the default sub cat for the cat_id
            echo Json::encode(['output' => $out, 'selected' => $selected]);
            return;
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->listPenjualan = Yii::$app->request->post('ItemPenjualan', []);
                if (($model->save())) {
                    $transaction->commit();
                    return $this->redirect(['pembayaran','id'=>$model->id]);
                }
            } catch (\Exception $ecx) {
                $transaction->rollBack();
                throw $ecx;
            }
            return $this->render('update', [
                'model' => $model,
            ]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Penjualan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        
        try {
            $this->findModel($id)->delete();
        } catch (\yii\db\IntegrityException  $e) {
            Yii::$app->session->setFlash('error', 'Data Tidak Dapat Dihapus Karena Dipakai Modul Lain');
        }
         return $this->redirect(['index']);
    }

    /**
     * Finds the Penjualan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Penjualan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Penjualan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
