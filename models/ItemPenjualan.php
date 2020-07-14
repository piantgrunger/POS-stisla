<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item_penjualan".
 *
 * @property int $id
 * @property int $id_penjualan
 * @property int $id_barang
 * @property int $id_satuan
 * @property float|null $qty
 * @property float|null $harga
 * @property float|null $sub_total
 *
 * @property Penjualan $penjualan
 * @property Barang $barang
 * @property Satuan $satuan
 */
class ItemPenjualan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item_penjualan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_barang'], 'required'],
            [['id_penjualan', 'id_barang', 'id_satuan'], 'integer'],
            [['qty', 'harga', 'sub_total'], 'number'],
            [['id_penjualan'], 'exist', 'skipOnError' => true, 'targetClass' => Penjualan::className(), 'targetAttribute' => ['id_penjualan' => 'id']],
            [['id_barang'], 'exist', 'skipOnError' => true, 'targetClass' => Barang::className(), 'targetAttribute' => ['id_barang' => 'id']],
            [['id_satuan'], 'exist', 'skipOnError' => true, 'targetClass' => Satuan::className(), 'targetAttribute' => ['id_satuan' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_penjualan' => 'Id Penjualan',
            'id_barang' => 'Id Barang',
            'id_satuan' => 'Id Satuan',
            'qty' => 'Qty',
            'harga' => 'Harga',
            'sub_total' => 'Sub Total',
        ];
    }

    /**
     * Gets query for [[Penjualan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPenjualan()
    {
        return $this->hasOne(Penjualan::className(), ['id' => 'id_penjualan']);
    }

    /**
     * Gets query for [[Barang]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBarang()
    {
        return $this->hasOne(Barang::className(), ['id' => 'id_barang']);
    }

    /**
     * Gets query for [[Satuan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSatuan()
    {
        return $this->hasOne(Satuan::className(), ['id' => 'id_satuan']);
    }
}
