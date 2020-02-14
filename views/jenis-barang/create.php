<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\JenisBarang */

$this->title = Yii::t('app', 'Jenis Barang Baru');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Jenis Barang'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jenis-barang-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
