<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use hscstudio\mimin\components\Mimin;

/* @var $this yii\web\View */
/* @var $model app\models\Stok */

$this->title = $model->kode_barang;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Stok', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stok-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'urutan',
            'tanggal',
            'id_gudang',
            'id_satuan',
            'kode_barang',
            'nama_barang',
            'masuk',
            'keluar',
            'satuan',
            'saldo',
        ],
    ]) ?>

</div>
