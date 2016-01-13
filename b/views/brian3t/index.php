<?php

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\Brian3tSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Brian3t';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);

?>


<div class="brian3t-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Brian3t', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Advance Search', '#', ['class' => 'btn btn-info search-button']) ?>
    </p>
    <div class="search-form" style="display:none">
        <?= $this->render('_search', ['model' => $searchModel]); ?>
    </div>

    <?php
    $gridColumn = [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'hidden' => true],
            'name',
            ['attribute' => 'date_to_search',
                    'class' => \kartik\grid\DataColumn::className(),
                    'format' => 'date',
                    'filter' => '<div class="input-group drp-container">'. DateRangePicker::widget([
                            'name'=>'date_range_1',
                            'convertFormat'=>true,
                            'useWithAddon'=>true,
                            'pluginOptions'=>[
                                    'locale'=>[
                                            'format'=>'d-M-y',
                                            'separator'=>' to ',
                                    ],
                                    'opens'=>'left'
                            ]
                    ]) . '</div>',

            ],
            [
                    'class' => 'yii\grid\ActionColumn',
            ],
    ];
    ?>
    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'filterRowOptions' => ['class' => 'kartik-sheet-style'],
            'columns' => $gridColumn,
            'pjax' => false,
            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container'],
            'afterGrid'=>'<script>'.$search_date.'</script>'],
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
                    '{export}',
                    ExportMenu::widget([
                            'dataProvider' => $dataProvider,
                            'columns' => $gridColumn,
                            'target' => ExportMenu::TARGET_BLANK,
                            'fontAwesome' => true,
                            'dropdownOptions' => [
                                    'label' => 'Full',
                                    'class' => 'btn btn-default',
                                    'itemsBefore' => [
                                            '<li class="dropdown-header">Export All Data</li>',
                                    ],
                            ],
                    ]),
            ],
    ]); ?>

</div>
