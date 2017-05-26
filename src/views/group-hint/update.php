<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GroupHint */

$this->title = 'Update Group Hint: ' . $model->group_id;
$this->params['breadcrumbs'][] = ['label' => 'Group Hints', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->group_id, 'url' => ['view', 'group_id' => $model->group_id, 'hint_id' => $model->hint_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="group-hint-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
