<?php

use yii\db\Migration;

/**
 * Class m200214_072335_penjualan
 */
class m200214_072335_penjualan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fk_item_penjualan', 'item_penjualan');
        $this->addForeignKey('fk_item_penjualan', 'item_penjualan', 'id_penjualan', 'penjualan', 'id', 'CASCADE', 'CASCADE');

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
        echo "m200214_072335_penjualan cannot be reverted.\n";

        return false;
    }
    */
}
