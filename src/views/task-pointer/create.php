<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TaskPointer */

$this->title = 'Create Task Pointer';
$this->params['breadcrumbs'][] = ['label' => 'Task Pointers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-pointer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
