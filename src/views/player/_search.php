<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\PlayerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="player-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'telegram_user_id') ?>

    <?= $form->field($model, 'game_id') ?>

    <?= $form->field($model, 'game_status') ?>

    <?= $form->field($model, 'current_task') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
