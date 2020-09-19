<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "penjualan".
 *
 * @property int $id
 * @property string $no_dokumen
 * @property string|null $tanggal
 * @property int $id_customer
 * @property int $id_gudang
 * @property string|null $keterangan
 *
 * @property ItemPenjualan[] $itemPenjualans
 * @property Customer $customer
 * @property Gudang $gudang
 */
class Penjualan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     * 
     */

    public $barcode;

    use \mdm\behaviors\ar\RelationTrait;

    public static function tableName()
    {
        return 'penjualan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_dokumen', 'id_customer', 'id_gudang'], 'required'],
            [['tanggal'], 'safe'],
            [['total','bayar','kembali'],'required','on'=>'pembayaran'],
            [['id_customer', 'id_gudang'], 'integer'],
            [['keterangan'], 'string'],
            [['no_dokumen'], 'string', 'max' => 50],
            [['no_dokumen'], 'unique'],
            [['id_customer'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['id_customer' => 'id']],
            [['id_gudang'], 'exist', 'skipOnError' => true, 'targetClass' => Gudang::className(), 'targetAttribute' => ['id_gudang' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_dokumen' => 'No Dokumen',
            'tanggal' => 'Tanggal',
            'id_customer' => 'Id Customer',
            'id_gudang' => 'Id Gudang',
            'keterangan' => 'Keterangan',
        ];
    }

    /**
     * Gets query for [[ItemPenjualans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getListPenjualan()
    {
        return $this->hasMany(ItemPenjualan::className(), ['id_penjualan' => 'id']);
    }

    public function setListPenjualan($value)
    {
        $this->loadRelated('listPenjualan', $value);
    }

    public function getTotalPenjualan() {
        return $this->hasMany(ItemPenjualan::className(), ['id_penjualan' => 'id'])->sum('sub_total');
    }

    /**
     * Gets query for [[Customer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'id_customer']);
    }

    /**
     * Gets query for [[Gudang]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGudang()
    {
        return $this->hasOne(Gudang::className(), ['id' => 'id_gudang']);
    }
}
