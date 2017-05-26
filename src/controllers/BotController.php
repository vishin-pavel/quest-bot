<?php
namespace app\controllers;


use app\models\Player;
use app\models\TelegramUser;
use Telegram\Bot\Laravel\Facades\Telegram;
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
            if($update->detectType() == 'callback_query'){
                $callbackQuery = $update->getCallbackQuery();
                if($callbackQuery->getData() == '/hint'){
                    $commandBus = \Yii::$app->bot->getCommandBus();
                    $commandBus->execute('hint', '', $update);
                }
                return true;
            }
            if ( ! $update->getMessage()) {
                return true;
            }
            $commandBus = \Yii::$app->bot->getCommandBus();
            $arguments  = $update->getMessage()->getText() ? $update->getMessage()->getText() : '';
            if ($update->getMessage()->getText() == 'Спец.задание') {
                $commandBus->execute('additional_game', $arguments, $update);
                return true;
            }
            if ( ! $update->getMessage()->getLocation()) {
                $update = \Yii::$app->bot->commandsHandler(true);
            }
            if ( ! $update->getMessage()->getText() ||
                 ! isset(\Yii::$app->bot->getCommandBus()->parseCommand($update->getMessage()->getText())[1]) ||
                 (isset(\Yii::$app->bot->getCommandBus()->parseCommand($update->getMessage()->getText())[1]) &&
                  in_array(\Yii::$app->bot->getCommandBus()->parseCommand($update->getMessage()->getText())[1],
                      \Yii::$app->bot->getCommandBus()->getCommands()))
            ) {
                $telegram_user = TelegramUser::findOne($update->getChat()->getId());
                if (!$telegram_user || !$player = $telegram_user->getPlayers()->one()) {
                    $commandBus->execute('start_quest', $arguments, $update);
                }else{
                    $commandBus->execute('answer', $arguments, $update);
                }
            }
        } catch (\Exception $e) {
            $update = \Yii::$app->bot->getWebhookUpdates();
            \Yii::$app->bot->sendMessage(['text'    => $e->getMessage(),
                                          'chat_id' => $update->getMessage()->getChat()->getId()
            ]);
        }
    }

    private function registerDefaultCommands()
    {
        \Yii::$app->bot->addCommands([
            \app\components\Telegram\Bot\commands\AnswerCommand::class,
//            \app\components\Telegram\Bot\commands\CurrentGameCommand::class,
//            \app\components\Telegram\Bot\commands\CurrentTaskCommand::class,
            \app\components\Telegram\Bot\commands\HelpCommand::class,
            \app\components\Telegram\Bot\commands\StartCommand::class,
            \app\components\Telegram\Bot\commands\StartQuestCommand::class,
            \app\components\Telegram\Bot\commands\HintCommand::class,
            \app\components\Telegram\Bot\commands\AdditionalGameCommand::class,
        ]);
    }
}