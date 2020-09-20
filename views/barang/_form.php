<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\JenisBarang;
use app\models\Satuan;


$jenisBarang = ArrayHelper::map(
  JenisBarang::find()->select(['id','ket'=> "concat(kode,' - ',nama)"])
  ->asArray()
  ->all()
    ,'id'
    ,'ket'
);


$satuan = ArrayHelper::map(
    Satuan::find()->select(['id','ket'=> "concat(kode,' - ',nama)"])
    ->asArray()
    ->all()
      ,'id'
      ,'ket'
  );

/* @var $this yii\web\View */
/* @var $model app\models\Barang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="barang-form">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model) ?> <!-- ADDED HERE -->

    <?= $form->field($model, 'kode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_jenis_barang')->widget(Select2::className(), [
        'data' => $jenisBarang,
        'options' => ['placeholder' => 'Pilih Jenis Barang...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]) ?>

<?= $form->field($model, 'id_satuan_std')->widget(Select2::className(), [
        'data' => $satuan,
        'options' => ['placeholder' => 'Pilih Satuan...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]) ?>

    <?= $form->field($model, 'harga_jual')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'barcode')->textInput(['maxlength' => true]) ?>

<!--
<div class="panel panel-success"   >
<div class="panel-heading"> Data Satuan Lain

</div>
<div class="panel-body">
<table class="table">
    <thead>
        <tr>

            <th>Satuan</th>
            <th>Konversi</th>


            <th><a id="btn-add2" href="#"><i class="fa fa-plus"></i></a></th>
        </tr>
    </thead>
    <?= \mdm\widgets\TabularInput::widget([
        'id' => 'detail-grid',
        'allModels' => $model->listSatuanBarang,
        'model' => \app\models\ItemSatuanBarang::className(),
        'tag' => 'tbody',
        'form' => $form,
        'itemOptions' => ['tag' => 'tr'],
        'itemView' => '_item_satuan',
        'clientOptions' => [
            'btnAddSelector' => '#btn-add2',
        ]
    ]);
    ?>
    </table>
    </div>
    </div>
        -->
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
