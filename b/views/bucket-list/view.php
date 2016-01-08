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
            <h2><?= 'Viewing bucket list: '.' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">

            <?= Html::a('Add an Item', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Update This List', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete This List', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
        <p>This bucket list was created on <?= \usv\yii2helper\PHPHelper::date_time_format($model->created_at) ?>
        <br/>
        It was last updated on <?= \usv\yii2helper\PHPHelper::date_time_format($model->updated_at) ?></p>
        <br/>
<?php //
//    $gridColumn = [
//        ['attribute' => 'id', 'hidden' => true],
//        [
//            'attribute' => 'user.id',
//            'label' => 'User',
//        ],
//        'name',
//        ['attribute' => 'tbl_lock', 'hidden' => true],
//    ];
//    echo DetailView::widget([
//        'model' => $model,
//        'attributes' => $gridColumn
//    ]);
//?>
    </div>
    
    <div class="row">
        <p>You can drag the items to sort their rankings</p>
<?php
    $gridColumnBucketItem = [
//        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'hidden' => true],
            ['label' => 'Item Description', 'value' => 'name'],
            ['label' => 'Order', 'value' => 'order'],
//        [
//            'attribute' => 'bucketList.name',
//            'label' => 'Bucket List',
//        ],
    ];
//    echo Gridview::widget([
//        'dataProvider' => $providerBucketItem,
//        'pjax' => true,
//        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],
//        'panel' => [
//        'type' => GridView::TYPE_INFO,
//        'heading' => '<h3 class="panel-title">' . Html::encode('Bucket Items in this list:') . ' </h3>',
//        ],
//        'columns' => $gridColumnBucketItem,
//        'export'=>false,
//        'toolbar'=>false
//    ]);

echo \yii\grid\GridView::widget([
        'dataProvider' => $bucketitem_model_search,
        'columns' => [
                [
                        'class' => \kotchuprik\sortable\grid\Column::className(),
                ],
//                'id',
                'name',
//                'order',
        ],
        'options' => [
                'data' => [
                        'sortable-widget' => 1,
                        'sortable-url' => \yii\helpers\Url::toRoute(['bucket-item/sorting']),
                ]
        ],
    'layout' => "{items}"
]);

?>
    </div>
</div>