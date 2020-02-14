<?php
use app\models\Barang;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;

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
<?= $form->field($model, "[$key]qty")->textInput([

'onChange' => ' var total =  parseFloat($(this).val())*parseFloat($("#itempembelian-' . $key . '-harga").val()) ; $("#itempembelian-' . $key . '-sub_total").val(total)   '
,'inputOptions' => ['value' => Yii::$app->formatter->asDecimal($model->qty)]

])->label(false); ?>

</td>


<td>
<?= $form->field($model, "[$key]id_satuan")->widget(DepDrop::className(), [    'type' => DepDrop::TYPE_SELECT2,
        'data' => [$model->id_satuan => is_null($model->id_satuan) ? "--" : $model->satuan->nama],
        'options' => ['placeholder' => 'Pilih Satuan ...'],
        'select2Options' => ['pluginOptions' => ['allowClear' => true],
                           ],
        'pluginOptions' => [
            'depends' => ['itempembelian-'.$key.'-id_barang'],
            'url' => Url::to(['/pembelian/satuan']),
            'placeholder' => 'Pilih Satuan ...',
            'initialize' => true,
        ],
    ])->label(false)
    ?>

</td>
<td>
<?= $form->field($model, "[$key]harga")->textInput([

'onChange' => ' var total =  parseFloat($(this).val())*parseFloat($("#itempembelian-' . $key . '-qty").val()) ; $("#itempembelian-' . $key . '-sub_total").val(total)   ',
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