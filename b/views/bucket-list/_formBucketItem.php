<?php
use kartik\grid\GridView;
use kartik\builder\TabularForm;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var int $id */

Pjax::begin();
$dataProvider = new ArrayDataProvider([
    'allModels' => $row,
    'pagination' => [
        'pagesize' => 50,
//        'route' => 'bucket-list/update'
    ],


]);
//$dataProvider->refresh();
//$dataProvider->setSort([]);
echo TabularForm::widget([
    'dataProvider' => $dataProvider,
    'formName' => 'BucketItem',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
//        "id" => ['type' => TabularForm::INPUT_HIDDEN, 'columnOptions' => ['hidden' => true]],
        'name' => ['type' => TabularForm::INPUT_TEXT, 'label' => 'Item Description'],
        'order' => ['label'=>'Rank', 'type' => TabularForm::INPUT_TEXT],
        'bucket_list_id' => [
            'label' => '',
            'type' => TabularForm::INPUT_HIDDEN,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\BucketList::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                'options' => ['placeholder' => 'Choose Bucket list'],
            ],
            'columnOptions' => ['hidden' => true]
        ],
        'del' => [
            'type' => TabularForm::INPUT_STATIC,
            'label' => '',
            'value' => function ($model, $key) {
                return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' => 'Delete',
                    'onClick' => 'delRowBucketItem(' . $key . '); return false;', 'id' => 'bucket-item-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> ' . 'Bucket Item' . '  </h3>',
            'type' => GridView::TYPE_INFO,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . 'Add an Item', ['type' => 'button',
                'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowBucketItem()']),
        ]
    ]
]);
echo $extra_message;
Pjax::end();
?>