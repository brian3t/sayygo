<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Keywords';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="keyword-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Keyword', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'options'      => [ 'class' => 'table-responsive' ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'description',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
