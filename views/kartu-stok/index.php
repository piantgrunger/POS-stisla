<?php


use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax; use kartik\export\ExportMenu;
$gridColumns=[['class' => 'yii\grid\SerialColumn'], 
            'no_dokumen',
            'ref',
            'tanggal:date',
            [
                'attribute' => 'saldo_awal' ,   
                 'value' => function($model) {
                      return $model->saldo - $model->masuk + $model->keluar;
                 },
               ],
           
             'masuk',
             'keluar',
             [
              'attribute' => 'saldo_akhir' ,   
               'value' => 'saldo',
             ],
             'satuan',
             

         ['class' => 'yii\grid\ActionColumn',   'template' => Mimin::filterActionColumn([
              'view'],$this->context->route),    ],    ]; 
/* @var $this yii\web\View */
/* @var $searchModel app\models\StokSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Laporan Kartu Stok';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stok-index">



    <?php Pjax::begin(); ?>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>


   
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
    //    'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'tableOptions' => ['class' => 'table  table-bordered table-hover'],
        'striped' => false,

        'pjax' => true,
        'bordered' => true,
        'striped' => false,
        'condensed' => false,

        'panel' => [
            'type' => GridView::TYPE_INFO,
             'heading' => '<i class="glyphicon glyphicon-tasks"></i>  <strong> '.Yii::t('app', 'Kartu Stok'). '</strong>',
      ],
            'toolbar' => [
      
        '{export}',
        '{toggleData}',
    ],

         'resizableColumns' => true,
    ]);
    ?>
 <?php Pjax::end(); ?>
</div>
