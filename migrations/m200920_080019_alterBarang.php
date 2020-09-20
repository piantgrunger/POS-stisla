<?php

use yii\db\Migration;

/**
 * Class m200920_080019_alterBarang
 */
class m200920_080019_alterBarang extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->addColumn('barang','barcode',$this->string(100));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200920_080019_alterBarang cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200920_080019_alterBarang cannot be reverted.\n";

        return false;
    }
    */
}
