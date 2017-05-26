<?php

namespace app\components\Telegram\Bot\commands;


use app\models\AdditionalGame;
use app\models\AnswerLog;
use app\models\Group;
use app\models\Player;
use app\models\Task;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

class AnswerCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "answer";

    /**
     * @var string Command Description
     */
    protected $description = "Отправка ответа на текущее заданиее";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
        $user_id = $this->getUpdate()->getChat()->getId();
        if ( ! $player = Player::findOne(['telegram_user_id' => $user_id])) {
            $this->replyWithMessage(['text' => 'Увас нет активных игр']);
            exit;
        }
        if ( ! $task = $player->currentTask) {
            $this->replyWithMessage(['text' => 'Увас нет активных игр']);
            exit;
        }

        $answer                   = new AnswerLog();
        $answer->game_id          = $player->game_id;
        $answer->task_id          = $task->id;
        $answer->telegram_user_id = $player->telegram_user_id;
        $answer->answer_time      = (new \DateTime())->format('Y-m-d H:i:s');
        $answer->answer           = mb_$arguments;
        $answer->save();

        if (( ! $task->pass_phrase) || (mb_strtolower($task->pass_phrase) == mb_strtolower($arguments))) {
            if ( ! ( ! $task->next_task && (( ! $player->before_additional_game_task && $player->before_additional_game_task !== -1) && $player->game->additionalGame))) {
                $this->replyWithMessage(['text' => $task->final_text]);
            }
//            $this->replyWithMessage(['text' => $task->final_text]);
            //выполнен последний таск и доп.таски завершены или их не было
            if ( ! $task->next_task && ($player->before_additional_game_task == -1 || ! $player->game->additionalGame)) {
                $player->delete();
                exit();
            } elseif ( ! $task->next_task && (( ! $player->before_additional_game_task && $player->before_additional_game_task !== -1) && $player->game->additionalGame)) {
                $player->game_status = $player->game_status | Player::GAME_STATUS_MAIN_QUEST_DONE;
                $player->save();
                $this->replyWithMessage(['text' => 'Не забудьте выполнить доп задание.']);
                $this->triggerCommand('additional_game');

                return true;
            } elseif ( ! $task->next_task && $player->before_additional_game_task && ($player->game_status & Player::GAME_STATUS_MAIN_QUEST_DONE)) {
                $player->current_task = $player->before_additional_game_task;
                $this->replyWithMessage(['text' => Task::findOne($player->current_task)->final_text]);
                $player->delete();

                return true;
            } elseif ( ! $task->next_task && $player->before_additional_game_task && $player->before_additional_game_task != -1) {
                $player->current_task                = $player->before_additional_game_task;
                $player->before_additional_game_task = -1;
                $player->game_status                 = $player->game_status | Player::GAME_STATUS_ADDITIONAL_DONE;
            } elseif ( ! $task->next_task && $player->before_additional_game_task === 0) {
                $player->delete();
                exit();
            } else {
                $player->current_task = $task->next_task;
            }

            //Todo: Раскоментировать для работы в команде
//            if($group = $player->getGroup()->one()){
//                /** @var Group $group */
//                $group->current_task = $task->next_task;
//                $player_ids = $group->getPlayers()->select('telegram_user_id, game_id')->asArray()->all();
//                Player::updateAll(['current_task'=>$task->next_task],'telegram_user_id=:telegram_user_id AND game_id=:game_id', [':telegram_user_id'=>array_column($player_ids, 'telegram_user_id'),':game_id'=> array_column($player_ids ,'game_id')]);
//            }
            $player->save();
            $nextTask = Task::findOne($player->current_task);
            if ($player->game_status & Player::GAME_STATUS_ADDITIONAL_DONE) {
                $additional_game_button_markup = Keyboard::hide();
            } else {
                $btn = Keyboard::button([
                    'text' => 'Спец.задание',
                ]);

                $additional_game_button_markup = Keyboard::make([
                    'keyboard'          => [[$btn]],
                    'resize_keyboard'   => true,
                    'one_time_keyboard' => true
                ]);
            }
            $this->replyWithMessage(['text' => $nextTask->start_text] + ['reply_markup' => $additional_game_button_markup]);
            foreach ($nextTask->images as $image) {
                $msg = [
                    'chat_id' => $this->getUpdate()->getChat()->getId(),
                    'photo'   => 'http://telebot.backend.pro' . $image->path,
                    'caption' => ' '
                ];
                if ($nextTask->getHints()->one()) {
                    $btn                 = Keyboard::inlineButton([
                        'text'          => 'Взять подсказку',
                        'callback_data' => '/hint'
                    ]);
                    $keyboard            = Keyboard::make()
                                                   ->inline()
                                                   ->row($btn);
                    $msg['reply_markup'] = $keyboard;
                }
                $this->replyWithPhoto($msg);
            };

        } else {
            $this->replyWithMessage(['text' => 'Неверный ответ, попробуйте еще.']);
        }
    }
}