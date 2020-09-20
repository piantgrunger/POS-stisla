<?php

use yii\db\Migration;

/**
 * Class m200920_012835_alterSetting
 */
class m200920_012835_alterSetting extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->addColumn('setting','no_dok_penjualan',$this->string(50));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200920_012835_alterSetting cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200920_012835_alterSetting cannot be reverted.\n";

        return false;
    }
    */
}
