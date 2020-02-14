<?php

use yii\db\Migration;

/**
 * Class m190526_041426_gudang
 */
class m190526_041426_gudang extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('gudang',[
            'id' => $this->primaryKey(),
            'kode' => $this->string(5)->unique()->notNull(),
            'nama' => $this->string(50)->unique()->notNull(),
            
        ]);
  

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190526_041426_gudang cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190526_041426_gudang cannot be reverted.\n";

        return false;
    }
    */
}
