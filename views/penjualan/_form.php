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

        <div class="row">
              <div class="col-md-5">

              <?=$this->render('_input_detail',['form'=>$form,'model'=>$model])?>
              </div>
              <div class="col-md-7">
               
                 

                <h1>
                    <div class="row">
                                        <div class="col-md-2">Total</div>    
                <div class="col-md-6">
                <?=$form->field($model,'total')->textInput(['readOnly'=>true,
'inputOptions' => ['value' => Yii::$app->formatter->asDecimal($model->total)]

])->label(false) ?>
                </div>
                </div>

            </h1>
              <div class="panel-body">
<table class="table">
    <thead>
        <tr>

            <th>Barang</th>
            <th>Qty</th>
            <th>Satuan</th>
            <th>Harga</th>
            <th>Sub Total</th>

            <th><a id="btn-add2" href="#"><span class="fa fa-plus"></span></a></th>
        </tr>
    </thead>
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


    </table>
    </div>
    </div>


              </div>

        </div>

   
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
