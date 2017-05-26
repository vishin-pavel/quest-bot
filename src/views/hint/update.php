<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Hint */

$this->title = 'Update Hint: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Hints', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hint-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
