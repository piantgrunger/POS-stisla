<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Penjualan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penjualan-form">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model) ?> <!-- ADDED HERE -->

              <?=$this->render('_input_detail',['form'=>$form,'model'=>$model])?>
              </div>

<div class="card">
<div class="card-header card-success"> Detail Barang</div>

              <div class="card-body">
<table class="table">
    <thead>
        <tr>

            <th width='40%'>Barang</th>
            <th>Qty</th>
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
