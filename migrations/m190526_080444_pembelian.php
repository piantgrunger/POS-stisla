<?php

use yii\db\Migration;

/**
 * Class m190526_080444_pembelian
 */
class m190526_080444_pembelian extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('pembelian',[
            'id' => $this->primaryKey(),
            'no_dokumen' => $this->string(50)->notNull()->unique(),
            'tanggal' => $this->date(),
            'id_supplier' => $this->integer()->notNull(),
            'keterangan' => $this->text(),
            
        ]);
        $this->createTable('item_pembelian',[
            'id' => $this->primaryKey(),
            'id_pembelian' => $this->integer()->notNull(),
            'id_barang' => $this->integer()->notNull(),
            'id_satuan' => $this->integer()->notNull(),
            'qty' => $this->decimal(19,2),
        ]);
        $this->addForeignKey('fk_pembelian_supp','pembelian','id_supplier','supplier','id');
        $this->addForeignKey('fk_item_pembelian','item_pembelian','id_pembelian','pembelian','id');
        $this->addForeignKey('fk_item_pembelian_brg','item_pembelian','id_barang','barang','id');
        $this->addForeignKey('fk_item_pembelian_satuan','item_pembelian','id_satuan','satuan','id');
 
     

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190526_080444_pembelian cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190526_080444_pembelian cannot be reverted.\n";

        return false;
    }
    */
}
