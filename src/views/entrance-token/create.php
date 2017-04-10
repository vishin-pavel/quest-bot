<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EntranceToken */

$this->title = 'Create Entrance Token';
$this->params['breadcrumbs'][] = ['label' => 'Entrance Tokens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entrance-token-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
