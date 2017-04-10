<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EntranceToken */

$this->title = 'Update Entrance Token: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Entrance Tokens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="entrance-token-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
