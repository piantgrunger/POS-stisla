<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Stok;

/**
 * StokSearch represents the model behind the search form of `app\models\Stok`.
 */
class StokSearch extends Stok
{
    /**
     * @inheritdoc
     */public $tanggal_awal;
     

     public $tanggal_akhir;

    public function rules()
    {
        return [
            [['urutan', 'ref', 'no_dokumen', 'tanggal', 'kode_barang', 'nama_barang', 'satuan'], 'safe'],
            [[ 'id_satuan'], 'integer'],
            [['tanggal_awal','tanggal_akhir','id_gudang', 'id_barang'],'required'],
            [['masuk', 'keluar', 'saldo'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Stok::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' =>false
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
             $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andWhere([
            'id_gudang' => $this->id_gudang,
            'id_barang' => $this->id_barang,
        ]);
        $query->andWhere(['>=','tanggal',$this->tanggal_awal]);
        $query->andWhere(['<=','tanggal',$this->tanggal_akhir]);
        

        return $dataProvider;
    }
}
