<?php
use app\models\JenisBarang;
use app\models\Satuan;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;





$satuan = ArrayHelper::map(
    Satuan::find()->select(['id','ket'=> "concat(kode,' - ',nama)"])
    ->asArray()
    ->all()
      ,'id'
      ,'ket'
  );
  

?>
<td>
<?= $form->field($model, "[$key]id_satuan")->widget(Select2::className(), [
        'data' => $satuan,
        'options' => ['placeholder' => 'Pilih Satuan...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ])->label(false);
 ?>

</td>
<td>
<?= $form->field($model, "[$key]konversi")->textInput(['class' => 'form-control tmepicker'])->label(false); ?>

</td>

    <td>

    <a data-action="delete" id='delete3'><i class="fa fa-trash">
</td>