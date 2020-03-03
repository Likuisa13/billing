<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\settings\models\CompaniesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="companies-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">Search NOP</div>
            <div class="panel-body">
                <?= $form->field($model, 'nop') ?>
                <?= $form->field($model, 'tahun') ?>
                <div class="form-group">
                    <p style="text-align: right;"><?= Html::submitButton('Cari', ['class' => 'btn btn-primary']) ?></p>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>