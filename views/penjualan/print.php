<div style="width: 80%; margin: 0 auto; text-align: center; ">
<h4>
  
  Nota Penjualan<br>
  <?=$setting->nama?><br>
  <?=$setting->alamat?><br>
  
  </h4>

  
  
</div>  
  <hr style=" border-top: 1px dotted red;">
  No:<?=$model->no_dokumen?><br>
  Tanggal:<?=yii::$app->formatter->asDate($model->tanggal)?><br>
<br>
<br>
<table class="table">
  
   
     <?php
     $total =0;
     foreach ($model->listPenjualan as $data) {
         $total+=$data->sub_total;
         ?>
       <tr>
            <td><?=$data->barang->nama?></td>
     <td align="right"><?=$data->qty?></td>
     <td><?=$data->satuan->nama?></td>
     <td align="right"><?= yii::$app->formatter->asDecimal($data->harga, 2)?></td>
     <td align="right"><?=yii::$app->formatter->asDecimal($data->sub_total, 2)?></td>


       </tr>

     <?php } ?>
   <tr>
     <td colspan=4 align='right'>Total </td>
     <td align="right"><?=yii::$app->formatter->asDecimal($model->total, 2)?></td>
  </tr>
  <tr>
     <td colspan=4 align='right'>Bayar </td>
     <td align="right"><?=yii::$app->formatter->asDecimal($model->bayar, 2)?></td>
  </tr>
  <tr>
     <td colspan=4 align='right'>Kembali </td>
     <td align="right"><?=yii::$app->formatter->asDecimal($model->kembali, 2)?></td>
  </tr>
 
   </table>

<div style="width: 80%; margin: 0 auto; text-align: center; ">
<h4>
 TERIMA KASIH ATAS KUNJUNGAN ANDA

  
  
</div>  
