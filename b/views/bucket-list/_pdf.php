<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\BucketList */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Bucket List', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bucket-list-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Bucket List'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'hidden' => true],
        [
            'attribute' => 'user.id',
            'label' => 'User',
        ],
        'name',
        'type',
        'state',
        ['attribute' => 'tbl_lock', 'hidden' => true],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
    $gridColumnBucketItem = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'hidden' => true],
        'name',
        [
            'attribute' => 'bucketList.name',
            'label' => 'Bucket List',
        ],
        'order',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerBucketItem,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>  ' . Html::encode('Bucket Item'.' '. $this->title) . ' </h3>',
        ],
        'columns' => $gridColumnBucketItem
    ]);
?>
    </div>
</div>