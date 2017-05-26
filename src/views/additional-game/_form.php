<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AdditionalGame */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="additional-game-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_task_id')->textInput() ?>

    <?= $form->field($model, 'game_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
