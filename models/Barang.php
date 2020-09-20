<?php

namespace app\models;

use Yii;
use mdm\behaviors\ar\RelationTrait;

/**
 * This is the model class for table "barang".
 *
 * @property int $id
 * @property string $kode
 * @property string $nama
 * @property int $id_jenis_barang
 *
 * @property JenisBarang $jenisBarang
 */
class Barang extends \yii\db\ActiveRecord
{
    use RelationTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'barang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_jenis_barang'], 'integer'],
            [['kode'], 'string', 'max' => 5],
            [['nama','barcode'], 'string', 'max' => 50],
            [['harga_jual'],'number'],
            [['kode','nama'], 'unique'],
            [['kode','nama','id_jenis_barang','id_satuan_std','harga_jual'], 'required'],
            [['id_jenis_barang'], 'exist', 'skipOnError' => true, 'targetClass' => JenisBarang::className(), 'targetAttribute' => ['id_jenis_barang' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'kode' => Yii::t('app', 'Kode'),
            'nama' => Yii::t('app', 'Nama'),
            'id_jenis_barang' => Yii::t('app', 'Jenis Barang'),
            'id_satuan_std' => Yii::t('app', 'Satuan Std.'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJenisBarang()
    {
        return $this->hasOne(JenisBarang::className(), ['id' => 'id_jenis_barang']);
    }
    public function getSatuan_std()
    {
        return $this->hasOne(Satuan::className(), ['id' => 'id_satuan_std']);
    }
    public function getListSatuanBarang()
    {
        return $this->hasMany(ItemSatuanBarang::className(), ['id_barang' => 'id']);
    }
    public function setListSatuanBarang($value)
    {
        $this->loadRelated('listSatuanBarang',$value);
    }


}
