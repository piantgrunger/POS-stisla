<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property int $id
 * @property string $kode
 * @property string $nama
 * @property string $alamat
 * @property string $telepon
 * @property string $cp
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode', 'nama'], 'required'],
            [['alamat'], 'string'],
            [['kode'], 'string', 'max' => 5],
            [['nama', 'telepon', 'cp'], 'string', 'max' => 50],
            [['kode'], 'unique'],
            [['nama'], 'unique'],
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
            'alamat' => Yii::t('app', 'Alamat'),
            'telepon' => Yii::t('app', 'Telepon'),
            'cp' => Yii::t('app', 'Cp'),
        ];
    }
}
