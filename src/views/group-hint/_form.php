<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GroupHint */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="group-hint-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'group_id')->textInput() ?>

    <?= $form->field($model, 'hint_id')->textInput() ?>

    <?= $form->field($model, 'current_game_task')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
