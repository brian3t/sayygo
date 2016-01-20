<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $kw backend\models\Keyword */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'My current Sayygos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sayygo-index">

	<h1><?= Html::encode( $this->title ) ?></h1>

	<p>
		<?= Html::a( 'Create a Sayygo',[ 'create' ],[ 'class' => 'btn btn-success' ] ) ?>
	</p>

	<?= GridView::widget( [
		                      'dataProvider' => $dataProvider,
		                      'options'      => [ 'class' => 'table-responsive' ],
		                      'columns'      => [
			                      [ 'class' => 'yii\grid\SerialColumn' ],
//            'id',
			                      ['label'=>'full_text',
                                  'format'=>'raw',
                                  'value' => function($data){
                                      return Html::a($data->full_text,Url::to(['sayygo/view','id'=> $data->id]));
                                  }],
//            'user_id',
			                      'created_at',
			                      'updated_at',
			                      // 'type_id',
			                      // 'status',

//	         'start_date',
//	         'end_date',
			                      // 'is_active_mode',
			                      // 'notification_frequency',
			                      // 'partner_sex',
			                      // 'partner_experience',
			                      // 'partner_num_preference',
			                      // 'num_of_partner',

			                      [
				                      'format'         => 'html',
				                      'label'          => 'View Matching sayygos',
				                      'contentOptions' => [ 'class' => 'keyword' ],
				                      'value'          => function ( $data ) {
					                      $kws    = $data->getKeywordsToShow();
					                      $return = [ ];
					                      foreach ( $kws as $kw ) {
						                      $return[] = Html::a( $kw['description'],Url::to( [
							                                                                       'listmatch',
							                                                                       'id'   => $data->id,
							                                                                       'kwId' => $kw['id']
						                                                                       ] ) );
					                      }

					                      return implode( '&nbsp',$return );
				                      }
			                      ],
			                      [ 'class' => 'yii\grid\ActionColumn' ],
		                      ],
	                      ] ); ?>

</div>
