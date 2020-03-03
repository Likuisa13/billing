<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BillingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="billing-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'NOP') ?>

    <?= $form->field($model, 'TH_PJK') ?>

    <?= $form->field($model, 'NOMINAL') ?>

    <?= $form->field($model, 'VA') ?>

    <?= $form->field($model, 'EXP_DATE') ?>

    <?php // echo $form->field($model, 'CREATED_DATE') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
