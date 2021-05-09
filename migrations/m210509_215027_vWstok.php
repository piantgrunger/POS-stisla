<?php

use yii\db\Migration;

/**
 * Class m210509_215027_vWstok
 */
class m210509_215027_vWstok extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        
        $this->execute("
      ALTER VIEW stok as

      SELECT *  , SUM(masuk-keluar) OVER(ORDER BY CONCAT(id_gudang,urutan,tanggal,no_dokumen)) AS saldo from (
      
      SELECT '1' AS urutan,'Pembelian' as ref , no_dokumen,tanggal,id_gudang,id_barang,id_satuan,b.kode AS kode_barang,b.nama AS nama_barang,g.kode AS kode_gudang,g.nama AS nama_gudang,d.qty AS masuk, 0 AS keluar,s.kode AS satuan
      
      FROM pembelian p
      INNER JOIN item_pembelian d ON p.id=d.id_pembelian
      INNER JOIN barang b ON d.id_barang =b.id
      INNER JOIN satuan s ON s.id = d.id_satuan
      INNER JOIN gudang g ON g.id =p.id_gudang
      
      UNION all
      
      SELECT '2' AS urutan, 'Penjualan' AS ref ,no_dokumen,tanggal,id_gudang,id_barang,id_satuan,b.kode AS kode_barang,b.nama AS nama_barang,g.kode AS kode_gudang,g.nama AS nama_gudang,0 AS masuk, d.qty AS keluar,s.kode AS satuan
      
      FROM penjualan p
      INNER JOIN item_penjualan d ON p.id=d.id_penjualan
      INNER JOIN barang b ON d.id_barang =b.id
      INNER JOIN satuan s ON s.id = d.id_satuan
      INNER JOIN gudang g ON g.id =p.id_gudang
      
      ) d
      ORDER BY id_gudang,urutan,tanggal,no_dokumen
       
            ");
      

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210509_215027_vWstok cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210509_215027_vWstok cannot be reverted.\n";

        return false;
    }
    */
}
