<?php

use yii\db\Migration;

/**
 * Class m190526_032131_jenis_barang
 */
class m190526_032131_jenis_barang extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->createTable('jenis_barang',[
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
        echo "m190526_032131_jenis_barang cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190526_032131_jenis_barang cannot be reverted.\n";

        return false;
    }
    */
}
