<?php

use yii\db\Migration;

/**
 * Class m190526_060518_supplier
 */
class m190526_060518_supplier extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('supplier',[
            'id' => $this->primaryKey(),
            'kode' => $this->string(5)->unique()->notNull(),
            'nama' => $this->string(50)->unique()->notNull(),
            'alamat' => $this->text(),
            'telepon' => $this->string(50),
            'cp' => $this->string(50)

            
            
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190526_060518_supplier cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190526_060518_supplier cannot be reverted.\n";

        return false;
    }
    */
}
