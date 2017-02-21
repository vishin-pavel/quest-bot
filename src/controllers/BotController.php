<?php
namespace app\controllers;


use yii\base\Exception;
use yii\web\Controller;

class BotController extends Controller
{

    public function actionIndex()
    {
        try {
            $this->registerDefaultCommands();
            $update = \Yii::$app->bot->commandsHandler(true);
            if( !$update->isEmpty() &&
                \Yii::$app->bot->getCommandBus()->parseCommand($update->getMessage()) &&
                in_array(\Yii::$app->bot->getCommandBus()->getCommands(),
                \Yii::$app->bot->getCommandBus()->parseCommand($update->getMessage())[0])){
                \Yii::$app->bot->getCommandBus()->execute('answer', [], $update->getMessage());
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    private function registerDefaultCommands(){
        \Yii::$app->bot->addCommands([
            \app\components\Telegram\Bot\commands\AnswerCommand::class,
            \app\components\Telegram\Bot\commands\CurrentGameCommand::class,
            \app\components\Telegram\Bot\commands\CurrentTaskCommand::class,
            \app\components\Telegram\Bot\commands\HelpCommand::class,
            \app\components\Telegram\Bot\commands\MyGamesCommand::class,
            \app\components\Telegram\Bot\commands\StartCommand::class,
            \app\components\Telegram\Bot\commands\StartGameCommand::class,
            \app\components\Telegram\Bot\commands\StartTaskCommand::class,
        ]);
    }
}