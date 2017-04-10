<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserGroup */

$this->title = 'Update User Group: ' . $model->telegram_user_id;
$this->params['breadcrumbs'][] = ['label' => 'User Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->telegram_user_id, 'url' => ['view', 'telegram_user_id' => $model->telegram_user_id, 'group_id' => $model->group_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-group-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
