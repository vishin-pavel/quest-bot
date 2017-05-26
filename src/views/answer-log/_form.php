<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AnswerLog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="answer-log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'answer')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'telegram_user_id')->textInput() ?>

    <?= $form->field($model, 'game_id')->textInput() ?>

    <?= $form->field($model, 'task_id')->textInput() ?>

    <?= $form->field($model, 'answer_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
