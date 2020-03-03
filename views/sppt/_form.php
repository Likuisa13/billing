<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Sppt */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sppt-form">
    <?php $form = ActiveForm::begin([
        'action'=>'success',
        'method' => 'get',
    ]); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">Detail Nop</div>
        <div class="panel-body">
            <div class="form-group">
                <div class="col-md-6">
                    <?= $form->field($model, 'nop')->textInput(['maxlength' => true,'name'=>'nop','readonly'=> true]) ?>
                    <?= $form->field($model, 'THN_PAJAK_SPPT')->textInput(['maxlength' => true,'name'=>'tahun','readonly'=> true]) ?>
                    <?= $form->field($model, 'NM_WP_SPPT')->textInput(['maxlength' => true,'name'=>'nama','readonly'=> true]) ?>
                    <?= $form->field($model, 'JLN_WP_SPPT')->textInput(['maxlength' => true,'readonly'=> true]) ?>
                    <?= $form->field($model, 'KOTA_WP_SPPT')->textInput(['maxlength' => true,'readonly'=> true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'KELURAHAN_WP_SPPT')->textInput(['maxlength' => true,'readonly'=> true]) ?>
                    <?= $form->field($model, 'PBB_YG_HARUS_DIBAYAR_SPPT')->hiddenInput(['maxlength' => true,'name'=>'nominal','readonly'=> true])->label(false); ?>
                    <?= Html::tag('p','Tagihan<div><strong>Rp. '.$model->PBB_YG_HARUS_DIBAYAR_SPPT).'</strong></div>' ?><br>
                    <?= Html::tag('p','Tanggal Jatuh Tempo<div><strong>'.date( 'd - M - Y',strtotime($model->TGL_JATUH_TEMPO_SPPT))).'</strong></div>' ?>
                    <div>
                        <?= Html::tag('p','Belum Dibayar', ['style' => 'color:red']) ?></div>
                        <?= Html::Button('Pilih Metode Pembayaran', ['class' => 'btn btn-block btn-success']) ?><br>
                        <?= Html::checkbox('agree', true, ['label' => 'E-Collection']) ?><br>
                        <?= Html::checkbox('agree', false, ['label' => 'Yap!']) ?><br>
                        <center><?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?></center>
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
