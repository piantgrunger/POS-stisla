<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pembelian".
 *
 * @property int $id
 * @property string $no_dokumen
 * @property string $tanggal
 * @property int $id_supplier
 * @property string $keterangan
 *
 * @property ItemPembelian[] $itemPembelians
 * @property Supplier $supplier
 */
class Pembelian extends \yii\db\ActiveRecord
{
    use \mdm\behaviors\ar\RelationTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pembelian';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_dokumen', 'id_supplier','id_gudang','jenis_ppn'], 'required'],
            [['tanggal'], 'safe'],
            [['id_supplier'], 'integer'],
            [['keterangan'], 'string'],
            [['no_dokumen'], 'string', 'max' => 50],
            [['no_dokumen'], 'unique'],
            [['id_supplier'], 'exist', 'skipOnError' => true, 'targetClass' => Supplier::className(), 'targetAttribute' => ['id_supplier' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'no_dokumen' => Yii::t('app', 'No Dokumen'),
            'tanggal' => Yii::t('app', 'Tanggal'),
            'id_supplier' => Yii::t('app', 'Supplier'),
            'id_gudang' => Yii::t('app', 'Gudang'),

            'keterangan' => Yii::t('app', 'Keterangan'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getListPembelian()
    {
        return $this->hasMany(ItemPembelian::className(), ['id_pembelian' => 'id']);
    }

    public function setListPembelian($value)
    {
        $this->loadRelated("listPembelian", $value);
    }
    /**
     * @return \yii\db\ActiveQuery
     */

     public function getTotal() {
         return $this->hasMany(ItemPembelian::className(), ['id_pembelian' => 'id'])->sum('sub_total');
     }

     public function getDpp() {
         return $this->jenis_ppn=='PPN-IN'?$this->total*100/(100+$this->ppn):$this->total ;
     }

     public function getGrand_total() {
         return $this->dpp + ($this->ppn/100*$this->dpp);
     }
    public function getSupplier()
    {
        return $this->hasOne(Supplier::className(), ['id' => 'id_supplier']);
    }

    public function getPpn()
    {
        return yii::$app->params['ppn'];
    }

    public function getGudang()
    {
        return $this->hasOne(Gudang::className(), ['id' => 'id_gudang']);
    }
}
