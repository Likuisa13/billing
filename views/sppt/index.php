<?php

use yii\helpers\Html;
use yii\grid\GridView;
// $this->title = 'Search NOP';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sppt-index">
	<h1><?= Html::encode($this->title) ?></h1>
	<?php echo $this->render('_search', ['model' => $searchModel]); ?>
</div>
