<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AnswerLog */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Answer Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="answer-log-view">

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'answer:ntext',
            'telegram_user_id',
            'game_id',
            'task_id',
            'answer_time',
        ],
    ]) ?>

</div>
