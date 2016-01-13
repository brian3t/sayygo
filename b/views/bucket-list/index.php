<?php

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BucketListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bucket List';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);

?>

<div class="bucket-list-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Bucket List', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="search-form" style="display:none">
        <?= $this->render('_search', ['model' => $searchModel]); ?>
    </div>

    <?php
    $gridColumn = [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'hidden' => true],
            [
                    'attribute' => 'user.username',
                    'label' => 'Created by',
            ],
            ['attribute' => 'type',
                    'contentOptions' => [
                            'class' => 'cap'

                    ]
            ],
            ['attribute' => 'state',
                    'contentOptions' => [
                            'class' => 'cap'

                    ],
                    'filter' => Html::activeDropDownList($searchModel, 'state', ['active' => 'Active',
                            'inactive' => 'Inactive', 'on hold' => 'On hold',
                            'fulfilled' => 'Fulfilled'], ['class' => 'form-control', 'prompt' => 'All'])
            ]
        ,
            [
                    'attribute' => 'name',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::a($model->name, \yii\helpers\Url::to(['bucket-list/view/',
                                'id' => $model->id]), ['data-pjax' => 0]);
                    }
            ],
            ['attribute' => 'tbl_lock', 'hidden' => true],
            ['attribute' => 'created_at',
//                'filterType' => GridView::FILTER_DATE_RANGE,
                    'format' => 'date',

                    'filter' => DateRangePicker::widget([
                            'useWithAddon' => true,
                            'hideInput' => true,
                            'name' => 'created_at_range',
                            'value' => Yii::$app->request->getQueryParam('created_at_range'),
                            'convertFormat' => true,
                            'pluginOptions' => [
                                    'locale' => [
                                            'format' => 'd-M-y',
                                            'separator' => ' to ',
                                    ],
                                    'opens' => 'left'
                            ]
                    ]),
            ],
            [
                    'attribute' => 'updated_at',
                    'label' => 'Last updated at',
                    'class' => kartik\grid\DataColumn::className(),
//                'filterType' => GridView::FILTER_DATE_RANGE
            ],

            [
                    'class' => 'yii\grid\ActionColumn',
            ],

    ];
    ?>
    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => $gridColumn,
            'filterRowOptions' => ['class' => 'kartik-sheet-style'],

            'pjax' => false,
            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],
            'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>  ' . Html::encode($this->title) . ' </h3>',
            ],
        // set a label for default menu
            'export' => [
                    'label' => 'Page',
                    'fontAwesome' => true,
            ],
        // your toolbar can include the additional full export menu
            'toolbar' => [
//            '{export}',
//            ExportMenu::widget([
//                'dataProvider' => $dataProvider,
//                'columns' => $gridColumn,
//                'target' => ExportMenu::TARGET_BLANK,
//                'fontAwesome' => true,
//                'dropdownOptions' => [
//                    'label' => 'Full',
//                    'class' => 'btn btn-default',
//                    'itemsBefore' => [
//                        '<li class="dropdown-header">Export All Data</li>',
//                    ],
//                ],
//            ]) ,

            ],
    ]); ?>

</div>
