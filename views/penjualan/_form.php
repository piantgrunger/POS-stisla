<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\widgets\Pjax; 

use kartik\datecontrol\DateControl;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Customer;
use app\models\Gudang;
use yii\web\JsExpression;
use yii\helpers\Url;
use yii\bootstrap4\Modal;


$this->registerCss('
/* Important part */
.modal-dialog{
    overflow-y: initial !important
}
.modal-body{
    height: 500px;
    overflow-y: auto;
}');

$js = <<<JS
$('#modal').insertAfter($('body'));
  $("#modal").on("shown.bs.modal",function(event){
           event.preventDefault();
       var button = $(event.relatedTarget);
       var href = button.attr("href");
       $.pjax.reload("#pjax-modal",{
                 "timeout" : false,
                 "url" :href,
                 "replace" :false,
       });
  });
JS;
$this->registerJs($js);

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



$js = "
   if(event.key === 'Enter')
   {

    $.post( '" . Url::to(['penjualan/get-barang']) . "?kode=' +$(this).val(), function(data) {
        data1 = JSON.parse(data);
        if(data1 !== null) {
            
           
            i = $('#table-barang tr').length + 1;
          
            $('#table-barang > tbody').append('<tr class=\"mdm-item\" data-key=\"'+i+'\" data-index=\"'+i+'\">'+
                                             
                                               '<td>'+
                                              '<div class=\"form-group field-itempenjualan-'+i+'-id_barang\">'+
                                              ' <input type=\"hidden\" value=\"'+data1.id+'\" name=\"ItemPenjualan['+i+'][id_barang]\"> '+
                                              data1.kode+' - '+data1.nama+
                                              '</div>'+
                                               '</td>'+
                                           
                                               '<td>'+
                                             
                                               '<div class=\"form-group field-itempenjualan-'+i+'-qty validating\">'+

'<div class=\"input-group  bootstrap-touchspin bootstrap-touchspin-injected\">'+
'<input type=\"text\" id=\"itempenjualan-'+i+'-qty\" class=\"form-control \" name=\"ItemPenjualan['+i+'][qty]\" value=\"1\" placeholder=\"Qty\" onkeyup=\" var total =  parseFloat($(this).val())*parseFloat($(&quot;#itempenjualan-'+i+'-harga&quot;).val()) ; $(&quot;#itempenjualan-'+i+'-sub_total&quot;).val(total)   \" inputoptions=\"{&quot;value&quot;:&quot;1&quot;}\" data-krajee-touchspin=\"TouchSpin_d78e8e3c\" aria-invalid=\"false\"><span class=\"input-group-addon input-group-append\"></div>'+
'</div>'+
                                               '</td>'+

                                               '<td>'+
'<span id=\"satuan-'+i+'\">'+data1.satuan_std.nama+'</span>'+
  '<div class=\"form-group field-itempenjualan-'+i+'-id_satuan\">'+
'<input type=\"hidden\" id=\"itempenjualan-'+i+'-id_satuan\" class=\"form-control\" name=\"ItemPenjualan['+i+'][id_satuan]\" value=\"'+data1.id_satuan_std+'\">'+

'</div></td>'+


'<td><div class=\"form-group field-itempenjualan-'+i+'-harga validating\">'+
'<input type=\"text\" id=\"itempenjualan-'+i+'-harga\" class=\"form-control is-valid\" name=\"ItemPenjualan['+i+'][harga]\" value=\"'+data1.harga_jual+'\" onchange=\" var total =  parseFloat($(this).val())*parseFloat($(&quot;#itempenjualan-'+i+'-qty&quot;).val()) ; $(&quot;#itempenjualan-'+i+'-sub_total&quot;).val(total)   \"  aria-invalid=\"false\"></div></td>'+



'<td><div class=\"form-group field-itempenjualan-'+i+'-sub_total validating\">'+
'<input type=\"text\" id=\"itempenjualan-'+i+'-sub_total\" class=\"form-control is-valid\" name=\"ItemPenjualan['+i+'][sub_total]\" value=\"'+data1.harga_jual+'\" readonly=\"\"  aria-invalid=\"false\"></div></td>'+
   



'<td>  <a data-action=\"delete\" id=\"delete3\"><span class=\"fa fa-trash\"></span></a></td>'+









'</tr>');


                                            
        }
             

      }
      );
      event.key=0;
      $(this).val('');
      return event.key != 'Enter';     

   } 
   
  

";

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

  <div class="col-md-12">
    <?=$form->field($model, 'barcode')->textInput(['onKeyDown'=> "$js"])?>


  
  
              <div class="card-body">
<table  id="table-barang" class="table table-bordered table-hover kv-grid-table kv-table-wrap">
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


<?php

Modal::begin([
    'id' => 'modal',
    
       'size' => 'modal-lg',
]);

Pjax::begin(
    [
    'id' => 'pjax-modal',
    'enablePushState' => 'false',
  
    ]
);
Pjax::end();
?>
    <?php Modal::end(); ?>
