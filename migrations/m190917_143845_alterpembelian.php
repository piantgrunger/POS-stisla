<?php

use yii\db\Migration;

/**
 * Class m190917_143845_alterpembelian
 */
class m190917_143845_alterpembelian extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fk_item_pembelian', 'item_pembelian');
        $this->addForeignKey('fk_item_pembelian', 'item_pembelian', 'id_pembelian', 'pembelian', 'id', 'CASCADE', 'CASCADE');

        $this->addColumn('pembelian', 'jenis_ppn', $this->string(10));
        $this->addColumn('pembelian', 'ppn', $this->decimal(19, 2));
        $this->addColumn('pembelian', 'dpp', $this->decimal(19, 2));
        $this->addColumn('pembelian', 'grand_total', $this->decimal(19, 2));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190917_143845_alterpembelian cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190917_143845_alterpembelian cannot be reverted.\n";

        return false;
    }
    */
}
