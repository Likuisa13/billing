<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sppt */

// $this->title = 'Update Sppt: ' . $model->KD_PROPINSI;
$this->params['breadcrumbs'][] = ['label' => 'Sppts', 'url' => ['index']];
?>
<div class="sppt-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
