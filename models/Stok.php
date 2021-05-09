<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stok".
 *
 * @property string $urutan
 * @property string $ref
 * @property string $no_dokumen
 * @property string|null $tanggal
 * @property int|null $id_gudang
 * @property int $id_barang
 * @property int $id_satuan
 * @property string|null $kode_barang
 * @property string|null $nama_barang
 * @property float|null $masuk
 * @property float|null $keluar
 * @property string|null $satuan
 * @property float|null $saldo
 */
class Stok extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stok';
    }

    public static function primaryKey()
    {
        return ['no_dokumen','id_barang','ref'];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal'], 'safe'],
            [['id_gudang', 'id_barang', 'id_satuan'], 'integer'],
            [['masuk', 'keluar', 'saldo'], 'number'],
            [['urutan'], 'string', 'max' => 1],
            [['ref'], 'string', 'max' => 9],
            [['no_dokumen', 'nama_barang'], 'string', 'max' => 50],
            [['kode_barang', 'satuan'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'urutan' => 'Urutan',
            'ref' => 'Ref',
            'no_dokumen' => 'No Dokumen',
            'tanggal' => 'Tanggal',
            'id_gudang' => 'Id Gudang',
            'id_barang' => 'Id Barang',
            'id_satuan' => 'Id Satuan',
            'kode_barang' => 'Kode Barang',
            'nama_barang' => 'Nama Barang',
            'masuk' => 'Masuk',
            'keluar' => 'Keluar',
            'satuan' => 'Satuan',
            'saldo' => 'Saldo',
        ];
    }
}
