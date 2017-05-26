<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GroupHint */

$this->title = 'Create Group Hint';
$this->params['breadcrumbs'][] = ['label' => 'Group Hints', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-hint-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
