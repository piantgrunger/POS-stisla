<?php

use yii\db\Migration;

/**
 * Class m210509_012225_vWstok
 */
class m210509_012225_vWstok extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("CREATE VIEW stok as
        SELECT no_dokumen,tanggal,id_barang,id_satuan,b.kode AS kode_barang,b.nama AS nama_barang,d.qty AS masuk, 0 AS keluar,s.kode AS satuan
        
        FROM pembelian p
        INNER JOIN item_pembelian d ON p.id=d.id_pembelian
        INNER JOIN barang b ON d.id_barang =b.id
        INNER JOIN satuan s ON s.id = d.id_satuan
        UNION all
        
        SELECT no_dokumen,tanggal,id_barang,id_satuan,b.kode AS kode_barang,b.nama AS nama_barang,0 AS masuk, d.qty AS keluar,s.kode AS satuan
        
        FROM penjualan p
        INNER JOIN item_penjualan d ON p.id=d.id_penjualan
        INNER JOIN barang b ON d.id_barang =b.id
        INNER JOIN satuan s ON s.id = d.id_satuan");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210509_012225_vWstok cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210509_012225_vWstok cannot be reverted.\n";

        return false;
    }
    */
}
