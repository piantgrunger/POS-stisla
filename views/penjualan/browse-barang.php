<?php


use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

$js = "$(document).on('submit', 'form[data-pjax]', function(event) {
    $.pjax.submit(event, '#pjax_translation', {
        'push': false,
        'replace': false,
        'timeout': 5000,
        'scrollTo': false,
        'maxCacheLength': 0
    });             
});";     
$this->registerJs($js);

$gridColumns=[['class' => 'kartik\grid\SerialColumn'],
            'kode',
            'nama',
          
            'harga_jual:decimal',
           [
             'attribute' =>'aksi',
             'format' => 'raw',
             'value' => function($modal) {
                return "<a href='#' class='btn btn-success'> Pilih </a>";
             }
           ]   
   ];


/* @var $this yii\web\View */
/* @var $searchModel app\models\BarangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Daftar Barang');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="barang-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
      'filterUrl'    => Url::to(["browse-barang" ]),
   
      'options' => ['data-pjax' => false ],
          
    ]);
 ?>
   
</div>
