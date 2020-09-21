<?php


use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

$gridColumns=[['class' => 'kartik\grid\SerialColumn'],
            'kode',
            'nama',
            [
             'attribute' =>'Jenis Barang',
             'value'=>'jenisBarang.nama',
            ],
            [
                'attribute' =>'Satuan Std.',
                'value'=>'satuan_std.nama',
            ],
             [
               'attribute' => "barcode",
               'format' =>'raw',
               'value' => function($model) {
                 $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                 return '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($model->barcode, $generator::TYPE_CODE_128)) . '">';
                 
               }
               
             ], 
            'harga_jual:decimal',

         ['class' => 'kartik\grid\ActionColumn',   'template' => Mimin::filterActionColumn([
              'update','delete','view'],$this->context->route),    ],    ];


/* @var $this yii\web\View */
/* @var $searchModel app\models\BarangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Daftar Barang');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="barang-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'tableOptions' => ['class' => 'table  table-bordered table-hover'],
        'striped' => false,

        'pjax' => true,
        'bordered' => true,
        'striped' => false,
        'condensed' => true,

        'panel' => [
            'type' => GridView::TYPE_INFO,
             'heading' => '<i class="glyphicon glyphicon-tasks"></i>  <strong> '.Yii::t('app', 'Barang'). '</strong>',
      ],
            'toolbar' => [
        ['content' => ((Mimin::checkRoute($this->context->id . "/create"))) ?         Html::a(Yii::t('app', 'Barang Baru'), ['create'], ['class' => 'btn btn-success']) :""],

        '{export}',
        '{toggleData}',
    ],

         'resizableColumns' => true,
    ]);
 ?>
    <?php Pjax::end(); ?>
</div>
