<?php

use yii\db\Migration;

/**
 * Class m210508_235530_alterSetting
 */
class m210508_235530_alterSetting extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('setting','no_dokumen',$this->string());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210508_235530_alterSetting cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210508_235530_alterSetting cannot be reverted.\n";

        return false;
    }
    */
}
