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




$js = "    
     
    $.post( '".Url::to(['penjualan/get-harga'])."?id=' +$(this).val(), function(data) {
                                                      data1 = JSON.parse(data)
                                                      $( '#itempenjualan-$key-harga' ).val(data1.harga_jual);
                                                      $('#satuan-$key' ).html(data1.nama_satuan);
                                                      $( '#itempenjualan-$key-id_satuan' ).val(data1.id_satuan_std);
                                                      
    }
    );
                    ";



?>




<td>
<?= $form->field($model, "[$key]id_barang")->widget(Select2::className(), [
        'data' => $barang,
        'options' => ['placeholder' => 'Pilih Barang...',
        'onChange' => $js,
      ],
       
        'pluginOptions' => [
            'allowClear' => true,
          
        ],
    ])->label(false);
 ?>

</td>
<td>
<?= $form->field($model, "[$key]qty")->
textInput( [
    'options'=>['placeholder'=>'Qty'],


    'onkeyUp' => ' var total =  parseFloat($(this).val())*parseFloat($("#itempenjualan-' . $key . '-harga").val()) ; $("#itempenjualan-' . $key . '-sub_total").val(total)   '

    
])->label(false);
?>
</td>
<td>
<span id="satuan-<?=$key?>" ><?=is_null($model->barang)?"":$model->barang->satuan_std->nama?></span>
  <?= $form->field($model,"[$key]id_satuan")->hiddenInput()->label(false) ?>

</td>


<td>
<?= $form->field($model, "[$key]harga")->textInput([

'onKeyup' => ' var total =  parseFloat($(this).val())*parseFloat($("#itempenjualan-' . $key . '-qty").val()) ; $("#itempenjualan-' . $key . '-sub_total").val(total)   ',
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