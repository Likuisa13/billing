<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BillingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Billings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="billing-index">

    <h1><?= Html::encode($this->title) ?></h1>
   <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'NOP',
        'TH_PJK',
        'NOMINAL',
        'VA',
        'EXP_DATE',
        'CREATED_DATE',
            // ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>


</div>
