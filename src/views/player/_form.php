<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Player */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="player-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'telegram_user_id')->textInput() ?>

    <?= $form->field($model, 'game_id')->textInput() ?>

    <?= $form->field($model, 'game_status')->textInput() ?>

    <?= $form->field($model, 'current_task')->textInput() ?>

    <?= $form->field($model, 'before_additional_game_task')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
