<?php

namespace app\components\Telegram\Bot\commands;


use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class HelpCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "help";

    /**
     * @var string Command Description
     */
    protected $description = "Список доступных команд";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
        $this->replyWithMessage(['text' => 'Добро пожаловать в квест "Совесть должна быть у каждого". Чтобы начать квест, введите код своей команды.']);
        $this->replyWithMessage(['text' => 'Вот команды, которые могут понадобиться Вам в ходе квеста.']);
        $this->replyWithChatAction(['action' => Actions::TYPING]);
        $commands = $this->getTelegram()->getCommands();
        $response = '';
        foreach ($commands as $name => $command) {
            if($name != 'answer'){
                $response .= sprintf('/%s - %s' . PHP_EOL, $name, $command->getDescription());
            }
        }
        $this->replyWithMessage(['text' => $response]);
    }
}