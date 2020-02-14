    <div class="panel panel-success"   >
<div class="panel-heading"> Detail Penjualan

</div>
<div class="panel-body">
<table class="table">
    <thead>
        <tr>

            <th align="center">Barang</th>
            <th align="center">Qty</th>
            <th align="center">Satuan</th>
            <th align="center">Harga</th>
            <th align="center">Sub Total</th>

        </tr>
    </thead>
    <tbody>
     <?php
     $total =0;
     foreach ($model as $data) {
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
    </tbody>
    <tfoot>
     <td colspan="4" align="right"> Total </td>
    <td colspan="4" align="right"> <?=yii::$app->formatter->asDecimal($total,2)?> </td>

    </tfoot>

   </table>
    </div>
    </div>
