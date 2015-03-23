<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cuser Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuser-project-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a( 'Create Cuser Project',[ 'create' ],[ 'class' => 'btn btn-success' ] ) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'cuser_id',
            'project_id',
            'projectrole',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
