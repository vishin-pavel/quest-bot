<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AdditionalGame */

$this->title = 'Create Additional Game';
$this->params['breadcrumbs'][] = ['label' => 'Additional Games', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="additional-game-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
