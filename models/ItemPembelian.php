<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item_pembelian".
 *
 * @property int $id
 * @property int $id_pembelian
 * @property int $id_barang
 * @property int $id_satuan
 * @property string $qty
 *
 * @property Pembelian $pembelian
 * @property Barang $barang
 * @property Satuan $satuan
 */
class ItemPembelian extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item_pembelian';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'id_barang', 'id_satuan'], 'required'],
            [['id_pembelian', 'id_barang', 'id_satuan'], 'integer'],
            [['qty','harga','sub_total'], 'number'],
            [['id_pembelian'], 'exist', 'skipOnError' => true, 'targetClass' => Pembelian::className(), 'targetAttribute' => ['id_pembelian' => 'id']],
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
            'id' => Yii::t('app', 'ID'),
            'id_pembelian' => Yii::t('app', 'Id Pembelian'),
            'id_barang' => Yii::t('app', 'Id Barang'),
            'id_satuan' => Yii::t('app', 'Id Satuan'),
            'qty' => Yii::t('app', 'Qty'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPembelian()
    {
        return $this->hasOne(Pembelian::className(), ['id' => 'id_pembelian']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBarang()
    {
        return $this->hasOne(Barang::className(), ['id' => 'id_barang']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSatuan()
    {
        return $this->hasOne(Satuan::className(), ['id' => 'id_satuan']);
    }
}
