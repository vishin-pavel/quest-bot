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
        $this->replyWithMessage(['text' => 'Привет и добро поаловать. Вот список доступных команд: ']);
        $this->replyWithChatAction(['action' => Actions::TYPING]);
        $commands = $this->getTelegram()->getCommands();
        $response = '';
        foreach ($commands as $name => $command) {
            $response .= sprintf('/%s - %s' . PHP_EOL, $name, $command->getDescription());
        }
        $this->replyWithMessage(['text' => $response]);
        $this->replyWithChatAction(['action' => Actions::TYPING]);
        $this->replyWithMessage(['text' => 'И еще:']);
        $this->replyWithChatAction(['action' => Actions::TYPING]);
        $this->replyWithMessage(['text' => 'Сходите пожалуста на хуй!']);
    }
}