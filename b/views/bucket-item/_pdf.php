<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\BucketItem */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Bucket Item', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bucket-item-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Bucket Item'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'hidden' => true],
        'name',
        [
            'attribute' => 'bucketList.name',
            'label' => 'Bucket List',
        ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>