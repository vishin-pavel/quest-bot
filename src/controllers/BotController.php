<?php
namespace app\controllers;


use TelegramBot\Api\Client;
use TelegramBot\Api\Exception;
use yii\web\Controller;

class BotController extends Controller
{

    public function actionIndex()
    {
        try {
            $bot = new Client(\Yii::$app->bot->apiToken);
            $bot->command('start', function ($message) use ($bot) {
                $bot->sendMessage($message->getChat()->getId(), "Здаровки, иди на хуй");
            });
            $bot->run();

        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}