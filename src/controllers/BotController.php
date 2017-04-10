<?php
namespace app\controllers;


use Telegram\Bot\Objects\Update;
use yii\web\Controller;

class BotController extends Controller
{

    public function actionIndex()
    {
        try {
            $this->registerDefaultCommands();
            /** @var Update $update */
            $update = \Yii::$app->bot->getWebhookUpdate();
            if(!$update->getMessage()->getLocation()){
                $update = \Yii::$app->bot->commandsHandler(true);
            }
            if( !$update->getMessage()->getText() ||
                !isset(\Yii::$app->bot->getCommandBus()->parseCommand($update->getMessage()->getText())[1]) ||
                (isset(\Yii::$app->bot->getCommandBus()->parseCommand($update->getMessage()->getText())[1]) &&
                 in_array(\Yii::$app->bot->getCommandBus()->parseCommand($update->getMessage()->getText())[1], \Yii::$app->bot->getCommandBus()->getCommands()))
            ){
                $commandBus = \Yii::$app->bot->getCommandBus();
                $arguments = $update->getMessage()->getText()?$update->getMessage()->getText():'';
                $commandBus->execute('answer', $arguments, $update);

            }
        } catch (\Exception $e) {
            $update = \Yii::$app->bot->getWebhookUpdates();
            \Yii::$app->bot->sendMessage(['text'=>$e->getMessage(), 'chat_id'=>$update->getMessage()->getChat()->getId()]);
        }
    }

    private function registerDefaultCommands(){
        \Yii::$app->bot->addCommands([
            \app\components\Telegram\Bot\commands\AnswerCommand::class,
            \app\components\Telegram\Bot\commands\CurrentGameCommand::class,
            \app\components\Telegram\Bot\commands\CurrentTaskCommand::class,
            \app\components\Telegram\Bot\commands\HelpCommand::class,
            \app\components\Telegram\Bot\commands\StartCommand::class,
            \app\components\Telegram\Bot\commands\StartGameCommand::class,
        ]);
    }
}