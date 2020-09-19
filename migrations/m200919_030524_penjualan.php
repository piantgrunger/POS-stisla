<?php

use yii\db\Migration;

/**
 * Class m200919_030524_penjualan
 */
class m200919_030524_penjualan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('penjualan', 'total' , $this->decimal(19,2));
        $this->addColumn('penjualan', 'bayar' , $this->decimal(19,2));
        $this->addColumn('penjualan', 'kembali' , $this->decimal(19,2));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200919_030524_penjualan cannot be reverted.\n";

        return false;
    }
    */
}
