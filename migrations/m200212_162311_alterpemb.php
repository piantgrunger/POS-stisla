<?php

use yii\db\Migration;

/**
 * Class m200212_162311_alterpemb
 */
class m200212_162311_alterpemb extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('pembelian', 'dpp');
        $this->dropColumn('pembelian', 'grand_total');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200212_162311_alterpemb cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down to run migration code without a transaction.
    public function up()
    {

    }

    public function down
    {
        echo "m200212_162311_alterpemb cannot be reverted.\n";

        return false;
    }
    */
}
