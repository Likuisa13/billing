<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Billing */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="billing-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NOP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TH_PJK')->textInput() ?>

    <?= $form->field($model, 'NOMINAL')->textInput() ?>

    <?= $form->field($model, 'VA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EXP_DATE')->textInput() ?>

    <?= $form->field($model, 'CREATED_DATE')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
