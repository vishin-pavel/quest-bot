<?php

namespace app\components\Telegram\Bot\commands;


use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

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
       //Todo: Обработка ответа
        $this->replyWithMessage(['text' => 'Ответ принят']);
    }
}