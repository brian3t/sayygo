<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'options'      => [ 'class' => 'table-responsive' ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'avatar',
            'phone',
            'email:email',
            // 'points',
            // 'lastactive',
            // 'password',
            // 'apikey',
            // 'agent_uid',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
