<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Gudang */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Gudang',
]) . $model->kode;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Gudang'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="gudang-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
