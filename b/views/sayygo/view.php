<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Sayygo */
/* @var boolean $isOwner */

$this->title                   = substr( $model->full_text,0,40 ) . "...";
$this->params['breadcrumbs'][] = [ 'label' => 'Sayygos','url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sayygo-view">

	<h1><?= Html::encode( $this->title ) ?></h1>

	<p>
		<?php if ( $isOwner ): ?>
			<?= Html::a( 'Update',[ 'update','id' => $model->id ],[ 'class' => 'btn btn-primary' ] ) ?>
			<?= Html::a( 'Delete',[ 'delete','id' => $model->id ],[
				'class' => 'btn btn-danger',
				'data'  => [
					'confirm' => 'Are you sure you want to delete this item?',
					'method'  => 'post',
				],
			] ) ?>
		<?php endif; ?>
	</p>

	<?= DetailView::widget( [
		                        'model'      => $model,
		                        'attributes' => [
			                        [
				                        'label' => 'Posted by',
				                        'value' => \common\models\User::findOne( $model->user_id )->username
			                        ],
			                        'full_text',
			                        'CreatedAtFormatted',
			                        'UpdatedAtFormatted',
//            'type_id',
//            'status',

			                        'start_date',
			                        'end_date',
//			                        'is_active_mode',
			                        'notification_frequency',
			                        'partner_sex',
			                        'partner_experience',
			                        'partner_num_preference',
			                        [
				                        'attribute' => 'num_of_partner',
				                        'visible'   => ( ! in_array( $model->partner_num_preference,
				                                                     [ "One","More than 10" ] ) )
			                        ]
		                        ],
	                        ] ) ?>
	<?php if ( !$isOwner ): ?>
	<button type="button" class="btn btn-outline btn-primary" onclick="location.href='/b/web/communication/create/<?=Yii::$app->user->id.'/'.$model->user_id.'/'.$model->id?>'">Contact this person</button>
	<?php endif;?>
</div>
