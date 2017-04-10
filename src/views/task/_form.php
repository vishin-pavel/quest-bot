<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'start_text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'final_text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'pass_phrase')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'next_task')->textInput() ?>

    <?= $form->field($model, 'prev_task')->textInput() ?>

    <?= $form->field($model, 'game_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
