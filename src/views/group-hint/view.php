<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\GroupHint */

$this->title = $model->group_id;
$this->params['breadcrumbs'][] = ['label' => 'Group Hints', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-hint-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'group_id' => $model->group_id, 'hint_id' => $model->hint_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'group_id' => $model->group_id, 'hint_id' => $model->hint_id], [
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
            'group_id',
            'hint_id',
            'current_game_task',
        ],
    ]) ?>

</div>
