<?php

use yii\db\Migration;

/**
 * Class m190526_064554_satuan
 */
class m190526_064554_satuan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
            $this->createTable('satuan',[
            'id' => $this->primaryKey(),
            'kode' => $this->string(5),
            'nama' => $this->string(50),
            
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190526_064554_satuan cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190526_064554_satuan cannot be reverted.\n";

        return false;
    }
    */
}
