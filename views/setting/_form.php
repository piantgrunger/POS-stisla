<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\datecontrol\DateControl;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Customer;
use app\models\Gudang;
use yii\web\JsExpression;
use yii\helpers\Url;

$customer = ArrayHelper::map(
    Customer::find()->select(['id','ket'=> "concat(kode,' - ',nama)"])
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


/* @var $this yii\web\View */
/* @var $model app\models\Setting */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="setting-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat')->textarea(['rows' => 16,'style'=>'height:150px']) ?>
    <?= $form->field($model, 'gudang_default')->widget(Select2::className(), [
        'data' => $gudang,
        'options' => ['placeholder' => 'Pilih Gudang...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]) ?>

<?= $form->field($model, 'customer_default')->widget(Select2::className(), [
        'data' => $customer,
        'options' => ['placeholder' => 'Pilih Customer...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]) ?>
  
      <?= $form->field($model, 'no_dok_penjualan')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
