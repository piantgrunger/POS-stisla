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

$this->title = Yii::t('app', 'Pembayaran ') . $model->no_dokumen;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Penjualan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');

?>

<?php $form = ActiveForm::begin([
    'enableClientValidation' => false,
]); ?>
        <?= $form->errorSummary($model) ?> <!-- ADDED HERE -->

        <?= $form->field($model, 'total' )->textInput(['readOnly' => true]) ?>
        <?= $form->field($model, 'bayar', [
        'inputOptions' =>
        [
        'autofocus' => 'autofocus',
        'tabindex' => '1',
        ]
])->textInput(['maxlength' => true,'onKeyPress'=>"
      val = parseFloat($(this).val())-  parseFloat($('#penjualan-total').val());
      $('#penjualan-kembali').val(val);

"]) ?>
        <?= $form->field($model, 'kembali')->textInput(['readOnly' => true]) ?>

          



        <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

