<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TelegramChat */

$this->title = 'Create Telegram Chat';
$this->params['breadcrumbs'][] = ['label' => 'Telegram Chats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="telegram-chat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
