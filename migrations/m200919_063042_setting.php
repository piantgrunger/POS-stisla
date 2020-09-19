<?php

use yii\db\Migration;

/**
 * Class m200919_063042_setting
 */
class m200919_063042_setting extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('setting', [
            'id' => $this->primaryKey(),
            'nama' => $this->string(100),
            'alamat' => $this->text(),
            'gudang_default' => $this->integer(),
            'customer_default' => $this->integer(),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200919_063042_setting cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200919_063042_setting cannot be reverted.\n";

        return false;
    }
    */
}
