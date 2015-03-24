<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Action */

$this->title = 'Create Action';
$this->params['breadcrumbs'][] = ['label' => 'Actions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="action-create">

    <h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render( '_create_form',[
        'model' => $model,
    ]) ?>

</div>
