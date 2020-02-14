<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item_satuan_barang".
 *
 * @property int $id
 * @property int $id_barang
 * @property int $id_satuan
 * @property string $konversi
 *
 * @property Satuan $satuan
 * @property Barang $barang
 */
class ItemSatuanBarang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item_satuan_barang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'id_satuan', 'konversi'], 'required'],
            [['id_barang', 'id_satuan'], 'integer'],
            [['konversi'], 'number'],
            [['id_satuan'], 'exist', 'skipOnError' => true, 'targetClass' => Satuan::className(), 'targetAttribute' => ['id_satuan' => 'id']],
            [['id_barang'], 'exist', 'skipOnError' => true, 'targetClass' => Barang::className(), 'targetAttribute' => ['id_barang' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_barang' => Yii::t('app', 'Id Barang'),
            'id_satuan' => Yii::t('app', 'Satuan'),
            'konversi' => Yii::t('app', 'Konversi'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSatuan()
    {
        return $this->hasOne(Satuan::className(), ['id' => 'id_satuan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBarang()
    {
        return $this->hasOne(Barang::className(), ['id' => 'id_barang']);
    }
}
