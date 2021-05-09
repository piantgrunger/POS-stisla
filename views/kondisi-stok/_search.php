<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;
use yii\helpers\ArrayHelper;

$databrg = ArrayHelper::map((\app\models\Barang::find()->asArray()->all()),'id','nama');

$datagdg = ArrayHelper::map((\app\models\Gudang::find()->asArray()->all()),'id','nama');


/* @var $this yii\web\View */
/* @var $model app\models\PembelianSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pembelian-search">

<?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
<div class="row">
   

 <div class="col-md-6">
     <?= $form->field($model, 'tanggal')->widget(DateControl::className()) ?>
 </div>
</div>
<div class="row">
<div class="col-md-6">

    <?= $form->field($model, 'id_barang')->widget(Select2::className(),['data'=>$databrg,   'options' => ['placeholder' => 'Pilih Barang...'], 
        'pluginOptions' => [
            'allowClear' => true,
          
        ],

     ]) ?>
</div>
<div class="col-md-6">
 
    <?= $form->field($model, 'id_gudang')->widget(Select2::className(),['data'=>$datagdg,   'options' => ['placeholder' => 'Pilih Gudang...'], 
        'pluginOptions' => [
            'allowClear' => true,
          
        ],

     ]) ?>
</div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>