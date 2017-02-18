<?php
namespace app\commands;

use yii\console\Controller;
class BotController extends Controller
{
    public function actionIndex()
    {
        $this->actionSetWebHook();
    }

    public function actionSetWebHook(){
        print_r(\Yii::$app->bot->setWebhook('https://telebot.backend.pro:8443/bot/333033824:AAEIZZwkaFssI-e-JRvtTcR6iICTW3u-yAI'));
    }
}
