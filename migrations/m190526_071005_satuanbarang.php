<?php

use yii\db\Migration;

/**
 * Class m190526_071005_satuanbarang
 */
class m190526_071005_satuanbarang extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->addColumn('barang','id_satuan_std',$this->integer()->notNull());
       $this->addForeignKey('fk_barang_satuan','barang','id_satuan_std','satuan','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190526_071005_satuanbarang cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190526_071005_satuanbarang cannot be reverted.\n";

        return false;
    }
    */
}
