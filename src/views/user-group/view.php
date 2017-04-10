<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserGroup */

$this->title = $model->telegram_user_id;
$this->params['breadcrumbs'][] = ['label' => 'User Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-group-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'telegram_user_id' => $model->telegram_user_id, 'group_id' => $model->group_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'telegram_user_id' => $model->telegram_user_id, 'group_id' => $model->group_id], [
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
            'group_id',
        ],
    ]) ?>

</div>
