<?php

use yii\helpers\Url;
use yii\helpers\Html;
?>

<div>
	<?php if (Yii::$app->session->hasFlash('error')): ?>

		<div class="info">

			<?= Yii::$app->session->getFlash('error'); ?>

		</div>

	<?php endif; ?>
	<div class="col-md-3">
		
	</div>
	<div class="col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading"><center>Detail Tagihan Pajak</center></div>
			<div class="panel-body">
				<div class="row">
					<center>
						<label>Silahkan Transfer Ke Virtual Account :</label><br>
						 <?= Html::tag('span','<strong>'.$model->VA).'</strong>' ?><br>
						 <?= Html::tag('span','<strong>Rp. '.$model->NOMINAL).'</strong>' ?><br>						
						 <?= Html::tag('span','Sebelum '.$model->EXP_DATE) ?><br>
						<a href="/sppt/index"><button class="btn btn-warning">Home</button></a><br>
					</center>
				</div>
			</div>
		</div>
	</div>
</div>