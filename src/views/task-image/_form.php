<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TaskImage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-image-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'task_id')->textInput() ?>

    <?= $form->field($model, 'image_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
