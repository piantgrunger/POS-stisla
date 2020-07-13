<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\datecontrol\DateControl;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\customer;
use app\models\Gudang;
use yii\web\JsExpression;

$customer = ArrayHelper::map(
    customer::find()->select(['id','ket'=> "concat(kode,' - ',nama)"])
  ->asArray()
  ->all(),
    'id',
    'ket'
);

$gudang = ArrayHelper::map(
    Gudang::find()->select(['id','ket'=> "concat(kode,' - ',nama)"])
  ->asArray()
  ->all(),
    'id',
    'ket'
);

?>
<div class="row">
<div class="col-md-6">

<?= $form->field($model, 'no_dokumen')->textInput(['maxlength' => true]) ?>

</div>
<div class="col-md-6">
<?= $form->field($model, 'tanggal')->widget(DateControl::classname()); ?>

   </div>
   </div>
<div class="row">
<div class="col-md-6">

<?= $form->field($model, 'id_gudang')->widget(Select2::className(), [
        'data' => $gudang,
        'options' => ['placeholder' => 'Pilih Gudang...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ])->label('Gudang') ?>
</div>
<div class="col-md-6">
<?= $form->field($model, 'id_customer')->widget(Select2::className(), [
        'data' => $customer,
        'options' => ['placeholder' => 'Pilih Customer...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ])->label('Customer') ?>
   </div>
</div>