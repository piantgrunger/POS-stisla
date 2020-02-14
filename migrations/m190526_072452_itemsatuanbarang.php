<?php

use yii\db\Migration;

/**
 * Class m190526_072452_itemsatuanbarang
 */
class m190526_072452_itemsatuanbarang extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('item_satuan_barang',[
            'id' => $this->primaryKey(),
            'id_barang' => $this->integer()->notNull(),
            'id_satuan' => $this->integer()->notNull(),
            'konversi' => $this->decimal(19,2)->notNull() 
            
            
        ]);
        $this->addForeignKey('fk_item_barang_satuan','item_satuan_barang','id_satuan','satuan','id');
        $this->addForeignKey('fk_item_barang_satuan2','item_satuan_barang','id_barang','barang','id');
 
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190526_072452_itemsatuanbarang cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190526_072452_itemsatuanbarang cannot be reverted.\n";

        return false;
    }
    */
}
