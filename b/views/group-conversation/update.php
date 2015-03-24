<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\GroupConversation */

$this->title = 'Update Group Conversation: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Group Conversations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="group-conversation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
