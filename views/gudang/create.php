<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Gudang */

$this->title = Yii::t('app', 'Gudang Baru');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Gudang'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gudang-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
