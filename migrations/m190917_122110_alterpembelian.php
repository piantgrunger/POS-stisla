<?php

use yii\db\Migration;

/**
 * Class m190917_122110_alterpembelian
 */
class m190917_122110_alterpembelian extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('pembelian', 'id_gudang', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190917_122110_alterpembelian cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190917_122110_alterpembelian cannot be reverted.\n";

        return false;
    }
    */
}
