<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Satuan */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Satuan',
]) . $model->kode;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Satuan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="satuan-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
