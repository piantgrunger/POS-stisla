<?php

use yii\db\Migration;

/**
 * Class m190526_033353_barang
 */
class m190526_033353_barang extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {     $this->createTable('barang',[
        'id' => $this->primaryKey(),
        'kode' => $this->string(5),
        'nama' => $this->string(50),
        'id_jenis_barang' => $this->integer()
        
    ]);
     $this->addForeignKey('fk_barang_jenis','barang','id_jenis_barang','jenis_barang','id');


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190526_033353_barang cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190526_033353_barang cannot be reverted.\n";

        return false;
    }
    */
}
