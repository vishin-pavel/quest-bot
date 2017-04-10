<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Player */

$this->title = $model->telegram_user_id;
$this->params['breadcrumbs'][] = ['label' => 'Players', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="player-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'telegram_user_id' => $model->telegram_user_id, 'game_id' => $model->game_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'telegram_user_id' => $model->telegram_user_id, 'game_id' => $model->game_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'telegram_user_id',
            'game_id',
            'game_status',
            'current_task',
        ],
    ]) ?>

</div>
