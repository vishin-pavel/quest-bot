<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Player */

$this->title = 'Update Player: ' . $model->telegram_user_id;
$this->params['breadcrumbs'][] = ['label' => 'Players', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->telegram_user_id, 'url' => ['view', 'telegram_user_id' => $model->telegram_user_id, 'game_id' => $model->game_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="player-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
