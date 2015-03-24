<?php

use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\switchinput\SwitchBox;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Websites';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="website-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Website', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'member_id',
            'url:url',
            'status',
            'status_updated',
            // 'structure_type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php
        $scrapeStatus = file_get_contents(dirname(dirname(__DIR__)) . '/controllers/scrapestatus.txt');//1 or 0
    ?>


    <h2>Scraping</h2>
    <?= \dosamigos\switchinput\SwitchBox::widget([
        'name' => 'scrape_status',
        'checked' => ($scrapeStatus == "1")?true:false,
        'clientOptions' => [
            'size' => 'large',
            'onColor' => 'success',
            'offColor' => 'danger',
        ]
    ]);?>
    <?php
    $this->registerJs("
        $('input[name=\"scrape_status\"]').on('switchChange.bootstrapSwitch', function(event, state) {
            $.ajax('/api/backend/web/index.php?r=scrapestatus/toggle');
        });");
    ?>

</div>
