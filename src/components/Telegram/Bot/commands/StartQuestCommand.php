<?php

namespace app\components\Telegram\Bot\commands;


use app\models\EntranceToken;
use app\models\Game;
use app\models\Group;
use app\models\Player;
use app\models\Task;
use app\models\TelegramUser;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

class StartQuestCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "start_quest";

    /**
     * @var string Command Description
     */
    protected $description = "Начать новую игру";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
        if ( ! $telegramUser = TelegramUser::findOne($this->getUpdate()->getChat()->getId())) {
            $telegramUser     = new TelegramUser();
            $telegramUser->id = $this->getUpdate()->getChat()->getId();
            $telegramUser->first_name = $this->getUpdate()->getChat()->getFirstName();
            $telegramUser->last_name = $this->getUpdate()->getChat()->getLastName();
            $telegramUser->username = $this->getUpdate()->getChat()->getUsername();
            $telegramUser->save();
        }
        if ( ! $token = EntranceToken::find()->where('token=:token', [':token' => $arguments])->one()) {
            $this->replyWithMessage(['text' => 'Не верный пароль']);
            return 0;
        }
        if ($token->counter < 1) {
            $this->replyWithMessage(['text' => 'Превышен лимит игроков']);

            return 0;
        }
        if ( ! $game = $token->game) {
            $this->replyWithMessage(['text' => 'Токен не привязан ни к одной игре']);

            return 0;
        }
        if ( ! $group = $token->group) {
            $group               = new Group();
            $group->current_task = $game->first_task;
            $group->game_id = $game->id;
            $group->save();
            $token->link('group', $group);
        }

        if ( ! $player = Player::findOne(['telegram_user_id' => $telegramUser->id, 'game_id' => $game->id])) {
            $player                   = new Player();
            $player->telegram_user_id = $telegramUser->id;
            $player->game_id          = $game->id;
            $player->save();
            $group->link('players', $player);
            $token->updateCounters(['counter' => -1]);
        }
        /** @var Task $firstTask */
        $firstTask            = $game->getTasks()->where(['prev_task' => null])->one();
        $player->current_task = $firstTask->id;
        $player->save();

        $this->replyWithMessage([
            'text' => 'Квест ' . $game->name . ' начинается.',
        ]);
        if ($player->game_status & Player::GAME_STATUS_ADDITIONAL_DONE){
            $additional_game_button_markup = Keyboard::hide();
        }else{
            $btn = Keyboard::button([
                'text' => 'Спец.задание',
            ]);

            $additional_game_button_markup = Keyboard::make([
                'keyboard' => [[$btn]],
                'resize_keyboard' => true,
                'one_time_keyboard' => true
            ]);
        }
        $this->replyWithMessage(['text' => $game->description]);
        $this->replyWithMessage(['text' => $firstTask->start_text]+['reply_markup'=>$additional_game_button_markup]);
        foreach ($firstTask->images as $image) {
            $msg = [
                'chat_id' => $this->getUpdate()->getChat()->getId(),
                'photo'   => 'http://telebot.backend.pro' . $image->path,
                'caption' => ' '
            ];
            if ($firstTask->getHints()->one()){
                $btn      = Keyboard::inlineButton([
                    'text'             => 'Взять подсказку',
                    'callback_data'    => '/hint'
                ]);
                $keyboard = Keyboard::make()
                                    ->inline()
                                    ->row($btn);
                $msg['reply_markup'] = $keyboard;
            }
            $this->replyWithPhoto($msg);
        };
    }
}