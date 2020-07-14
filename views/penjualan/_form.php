<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

use kartik\datecontrol\DateControl;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Customer;
use app\models\Gudang;
use yii\web\JsExpression;

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
/* @var $model app\models\Penjualan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penjualan-form">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model) ?> <!-- ADDED HERE -->

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

<div class="card">
<div class="card-header card-success"> Detail Barang</div>

              <div class="card-body">
<table class="table">
    <thead>
        <tr>

            <th width='40%'>Barang</th>
            <th>Qty</th>
            <th>Satuan</th>
            <th>Harga</th>
            <th>Sub Total</th>

            <th><a id="btn-add2" href="#"><span class="fa fa-plus"></span></a></th>
        </tr>
    </thead>
    <tbody>
    <?= \mdm\widgets\TabularInput::widget([
        'id' => 'detail-grid',
        'allModels' => $model->listPenjualan,
        'model' => \app\models\ItemPenjualan::className(),
        'tag' => 'tbody',
        'form' => $form,
        'itemOptions' => ['tag' => 'tr'],
        'itemView' => '_item',
        'clientOptions' => [
            'btnAddSelector' => '#btn-add2',
        ]
    ]);
?>
</tbody>
<tfoot>

</tfoot>

    </table>
    </div>
    </div>

    </div>




    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
