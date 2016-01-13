<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\Brian3t */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Brian3t', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brian3t-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Brian3t'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'hidden' => true],
        'name',
        'date_to_search',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>