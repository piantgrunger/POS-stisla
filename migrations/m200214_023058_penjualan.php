<?php

use yii\db\Migration;

/**
 * Class m200214_023058_penjualan
 */
class m200214_023058_penjualan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        
        $this->createTable('penjualan',[
            'id' => $this->primaryKey(),
            'no_dokumen' => $this->string(50)->notNull()->unique(),
            'tanggal' => $this->date(),
            'id_customer' => $this->integer()->notNull(),
            'id_gudang' => $this->integer()->notNull(),
            'keterangan' => $this->text(),
            
        ]);
        $this->createTable('item_penjualan',[
            'id' => $this->primaryKey(),
            'id_penjualan' => $this->integer()->notNull(),
            'id_barang' => $this->integer()->notNull(),
            'id_satuan' => $this->integer()->notNull(),
            'qty' => $this->decimal(19,2),
            'harga' => $this->decimal(19,2),
            'sub_total' => $this->decimal(19,2),
        ]);
        $this->addForeignKey('fk_penjualan_cust','penjualan','id_customer','customer','id');

        $this->addForeignKey('fk_penjualan_gudang','penjualan','id_gudang','gudang','id');

        $this->addForeignKey('fk_item_penjualan','item_penjualan','id_penjualan','penjualan','id');
        $this->addForeignKey('fk_item_penjualan_brg','item_penjualan','id_barang','barang','id');
        $this->addForeignKey('fk_item_penjualan_satuan','item_penjualan','id_satuan','satuan','id');
 

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200214_023058_penjualan cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200214_023058_penjualan cannot be reverted.\n";

        return false;
    }
    */
}
