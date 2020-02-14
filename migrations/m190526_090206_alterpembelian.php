<?php

use yii\db\Migration;

/**
 * Class m190526_090206_alterpembelian
 */
class m190526_090206_alterpembelian extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('item_pembelian','harga',$this->decimal(19,2)->notNull()->defaultValue(0));
        $this->addColumn('item_pembelian','sub_total',$this->decimal(19,2)->notNull()->defaultValue(0));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190526_090206_alterpembelian cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190526_090206_alterpembelian cannot be reverted.\n";

        return false;
    }
    */
}
