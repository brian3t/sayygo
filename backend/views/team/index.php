<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\BaseHtml;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Teams';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="team-index">

	<h1><?= Html::encode( $this->title ) ?></h1>

	<p>
		<?= Html::a( 'Create Team',[ 'create' ],[ 'class' => 'btn btn-success' ] ) ?>
	</p>

	<?= GridView::widget( [
		'dataProvider' => $dataProvider,
		'columns'      => [
			[ 'class' => 'yii\grid\SerialColumn' ],
//            'id',
			[
				'attribute' => 'name',
				'format'    => 'raw',
				'value'     => function ( $data ) {
					return \yii\helpers\BaseHtml::a( $data->name,$data->id,[ ] );
				}
			],
			[
				'attribute' => 'cusers',
				'label'     => 'Members',
				'format'    => 'raw',
				'value'     => function ( $data ) {
					$html = [ ];
					foreach ( $data->cusers as $cuser ) {
						$html[] = BaseHtml::a( $cuser->name,Yii::$app->urlManager->createUrl( [
							'cuser/view',
							'id' => $cuser->id
						] ),[ ] );
					};

					return implode( ', ',$html );
				}
			],
			[ 'class' => 'yii\grid\ActionColumn' ],
		],
	] ); ?>

</div>
