<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'My current Sayygos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sayygo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create a new Sayygo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'full_text',
            'user_id',
            'created_at',
            'updated_at',
            // 'type_id',
            // 'status',

	        // 'start_date',
	        // 'end_date',
	        // 'is_active_mode',
	        // 'notification_frequency',
	        // 'partner_sex',
	        // 'partner_experience',
	        // 'my_experience',
	        // 'partner_num_preference',
	        // 'num_of_partner',
	        // 'home_location',
	        // 'phone_number',
	        // 'languages',


	        ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
