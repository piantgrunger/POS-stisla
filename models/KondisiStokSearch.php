<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Stok;

/**
 * StokSearch represents the model behind the search form of `app\models\Stok`.
 */
class KondisiStokSearch extends Stok
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['urutan', 'ref', 'no_dokumen', 'tanggal', 'kode_barang', 'nama_barang', 'satuan'], 'safe'],
            [[ 'id_satuan'], 'integer'],
            [['tanggal'],'required'],
            [['masuk', 'keluar', 'saldo','id_gudang', 'id_barang'], 'number'],
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
        $query = Stok::find()->select(new  \yii\db\Expression("satuan,id_gudang,id_barang,kode_gudang,nama_gudang,kode_barang,nama_barang,sum(masuk-keluar) as saldo "));

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' =>false
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_gudang' => $this->id_gudang,
            'id_barang' => $this->id_barang,
        ]);
        $query->andWhere(['<=','tanggal',$this->tanggal]);
       
        $query->groupBy("id_gudang,id_barang,kode_gudang,nama_gudang,kode_barang,nama_barang,satuan");
        $query->orderBy('kode_gudang,kode_barang');

        return $dataProvider;
    }
}
