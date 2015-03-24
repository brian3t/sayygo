<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Cuser Teams';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuser-team-index">

	<h1><?= Html::encode( $this->title ) ?></h1>

	<p>
		<?= Html::a( 'Create Cuser Team',[ 'create' ],[ 'class' => 'btn btn-success' ] ) ?>
	</p>

	<?= GridView::widget( [
		'dataProvider' => $dataProvider,
		'columns'      => [
			[ 'class' => 'yii\grid\SerialColumn' ],
			'team_id',
			'cuser_id',
			'teamrole',
			[ 'class' => 'yii\grid\ActionColumn' ],
		],
	] ); ?>

</div>
