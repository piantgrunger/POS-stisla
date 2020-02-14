<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Satuan */

$this->title = Yii::t('app', 'Satuan Baru');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Satuan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="satuan-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
