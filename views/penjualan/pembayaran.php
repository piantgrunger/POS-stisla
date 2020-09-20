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

<table  class="table table-bordered table-hover kv-grid-table kv-table-wrap">
  <thead>
    <th width='40%'>Barang</th>
            <th>Qty</th>
            <th>Satuan</th>
            <th>Harga</th>
            <th>Sub Total</th>
  </thead>
  <tbody>
      <?php foreach($model->listPenjualan as $data) { ?>
       <th width='40%'><?=$data->barang->nama?></th>
            <th><?=$data->qty?></th>
            <th><?=$data->satuan->nama?></th>
 <td align="right"><?= yii::$app->formatter->asDecimal($data->harga, 2)?></td>
     <td align="right"><?=yii::$app->formatter->asDecimal($data->sub_total, 2)?></td>
    <?php } ?>
  </tbody>
</table>

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
])->textInput(['maxlength' => true,'onKeyUp'=>"
      val = parseFloat($(this).val())-  parseFloat($('#penjualan-total').val());
      $('#penjualan-kembali').val(val);

"]) ?>
        <?= $form->field($model, 'kembali')->textInput(['readOnly' => true]) ?>

          



        <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

