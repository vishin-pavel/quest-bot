<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaskImage */

$this->title = 'Update Task Image: ' . $model->task_id;
$this->params['breadcrumbs'][] = ['label' => 'Task Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->task_id, 'url' => ['view', 'task_id' => $model->task_id, 'image_id' => $model->image_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="task-image-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
