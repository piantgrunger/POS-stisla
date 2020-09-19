<?php

namespace app\controllers;

use Yii;
use app\models\Setting;
use app\models\SettingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SettingController implements the CRUD actions for Setting model.
 */
class SettingController extends Controller
{
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
        ];
    }

    /**
     * Lists all Setting models.
     * @return mixed
     */
    public function actionIndex()
    {
       $model = Setting::find()->one();
       if(is_null($model)) {
          $model = new Setting();

       }
       if ($model->load(Yii::$app->request->post()) && $model->save()) {
        return $this->redirect(['index']);
    } else {
       return $this->render('create',[
           'model'=> $model
       ]) ;
      }
    }

   
}
