<?php
use app\models\Barang;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;
use kartik\touchspin\TouchSpin;

$barang = ArrayHelper::map(
    Barang::find()->select(['id','ket'=> "concat(kode,' - ',nama)"])
    ->asArray()
    ->all(),
    'id',
    'ket'
);

?>
<td>
<?= $form->field($model, "[$key]id_barang")->widget(Select2::className(), [
        'data' => $barang,
        'options' => ['placeholder' => 'Pilih Barang...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ])->label(false);
 ?>

</td>
<td>
<?= $form->field($model, "[$key]qty")->
widget(TouchSpin::classname(), [
    'options'=>['placeholder'=>'Qty',


    'onChange' => ' var total =  parseFloat($(this).val())*parseFloat($("#itempenjualan-' . $key . '-harga").val()) ; $("#itempenjualan-' . $key . '-sub_total").val(total)   '
    ,'inputOptions' => ['value' => Yii::$app->formatter->asDecimal($model->qty)]
    
],
    'pluginOptions' => [
        'verticalbuttons' => true,
        'verticalup' => '<i class="fas fa-plus"></i>',
        'verticaldown' => '<i class="fas fa-minus"></i>'
    ]
])->label(false);

/*
textInput([

'onChange' => ' var total =  parseFloat($(this).val())*parseFloat($("#itempenjualan-' . $key . '-harga").val()) ; $("#itempenjualan-' . $key . '-sub_total").val(total)   '
,'inputOptions' => ['value' => Yii::$app->formatter->asDecimal($model->qty)]

])->label(false); */?>

</td>


<td>
<?= $form->field($model, "[$key]id_satuan")->widget(DepDrop::className(), [    'type' => DepDrop::TYPE_SELECT2,
        'data' => [$model->id_satuan => is_null($model->id_satuan) ? "--" : $model->satuan->nama],
        'options' => ['placeholder' => 'Pilih Satuan ...'],
        'select2Options' => ['pluginOptions' => ['allowClear' => true],
                           ],
        'pluginOptions' => [
            'depends' => ['itempenjualan-'.$key.'-id_barang'],
            'url' => Url::to(['/penjualan/satuan']),
            'placeholder' => 'Pilih Satuan ...',
            'initialize' => true,
        ],
    ])->label(false)
    ?>

</td>
<td>
<?= $form->field($model, "[$key]harga")->textInput([

'onChange' => ' var total =  parseFloat($(this).val())*parseFloat($("#itempenjualan-' . $key . '-qty").val()) ; $("#itempenjualan-' . $key . '-sub_total").val(total)   ',
'inputOptions' => ['value' => Yii::$app->formatter->asDecimal($model->harga)]

])->label(false); ?>

</td>
<td>
<?= $form->field($model, "[$key]sub_total")->textInput(['readOnly'=>true,
'inputOptions' => ['value' => Yii::$app->formatter->asDecimal($model->sub_total)]

])->label(false); ?>

</td>
    <td>

    <a data-action="delete" id='delete3'><span class="fa fa-trash">
</td>