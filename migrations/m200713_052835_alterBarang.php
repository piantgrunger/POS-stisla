<?php

use yii\db\Migration;

/**
 * Class m200713_052835_alterBarang
 */
class m200713_052835_alterBarang extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->addColumn('barang','harga_jual',$this->decimal(19,2));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200713_052835_alterBarang cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200713_052835_alterBarang cannot be reverted.\n";

        return false;
    }
    */
}
