<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\BaseHtml;

/* @var $this yii\web\View */
/* @var $model backend\models\Cuser */
/* @var $projectsHtml string */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cusers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuser-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
	<?php

	$html = [ ];
	foreach ( $model->teams as $team ) {
		$html[] = BaseHtml::a( $team->name,Yii::$app->urlManager->createUrl( [
			'team/view',
			'id' => $team->id
		] ),[ 'target' => '_blank' ] );
	};

	$html = implode( ', ',$html );

	?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'avatar',
            'email:email',
            'points',
            'lastactive',
//            'password',
            'apikey',
            'agent_uid',
	        [
		        'attribute' => 'teams',
		        'format'    => 'raw',
		        'value'     => $html
	        ],
	        [
		        'attribute' => 'projects',
		        'format'    => 'raw',
		        'value'     => $projectsHtml
	        ]

        ],
    ]) ?>

</div>
