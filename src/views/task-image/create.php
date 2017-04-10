<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TaskImage */

$this->title = 'Create Task Image';
$this->params['breadcrumbs'][] = ['label' => 'Task Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-image-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
