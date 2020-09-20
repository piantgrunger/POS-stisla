<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "setting".
 *
 * @property int $id
 * @property string|null $nama
 * @property string|null $alamat
 * @property int|null $gudang_default
 * @property int|null $customer_default
 */
class Setting extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'setting';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alamat','no_dok_penjualan'], 'string'],
            [['gudang_default', 'customer_default'], 'integer'],
           [['no_dokumen'],'unique'],
            [['nama'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'alamat' => 'Alamat',
            'gudang_default' => 'Gudang Default',
            'customer_default' => 'Customer Default',
        ];
    }
  public function getNo_penjualan()
  {
    $format = $this->no_dok_penjualan;
    $format = str_replace('MM',date('m'),$format);
    $format = str_replace('YYYY',date('Y'),$format);
    
    //$format = date($format);   
    $formatWithoutDigit = str_replace('_','',$format);
    $dataTerakhir = Penjualan::find()->where("no_dokumen like '".$format."'")->orderBy('no_dokumen desc')->one();
    if(is_null($dataTerakhir)) {
      $nomor =0;
    } else {
      $nomor = str_replace($formatWithoutDigit,'',$dataTerakhir->no_dokumen);
     
      if(!is_numeric($nomor)) {
         $nomor =0;
      }
      
    }
    $nomor+=1;
    $nomor=str_pad($nomor,substr_count($format,'_'),'0',STR_PAD_LEFT );
    return $formatWithoutDigit.$nomor;
    
  } 
}
