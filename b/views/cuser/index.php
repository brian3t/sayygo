<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\BaseHtml;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Members';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuser-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
	    <?= Html::a( 'Add Member',[ 'create' ],[ 'class' => 'btn btn-success' ] ) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            [
                'attribute' => 'name',
                'format'    => 'raw',
                'value'     => function ( $data ) {
                    return BaseHtml::a( $data->name,$data->id,[ ] );
                }
            ],
            'avatar',
            'email:email',
	        [
		        'attribute' => 'teams',
		        'format'    => 'raw',
		        'value'     => function ( $data ) {
			        $html = [ ];
			        foreach ( $data->teams as $team ) {
				        $html[] = BaseHtml::a( $team->name,Yii::$app->urlManager->createUrl( [
					        'team/view',
					        'id' => $team->id
				        ] ),[ ] );
			        };

			        return implode( ', ',$html );
		        }
	        ],
            // 'points',
            // 'lastactive',
            // 'password',
            // 'apikey',
            // 'agent_uid',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
