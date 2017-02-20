<?php

namespace app\components\Telegram\Bot;


use Longman\TelegramBot\Telegram;
use Yii;
use yii\base\Configurable;
use yii\base\Exception;

class Api extends Telegram implements Configurable
{
    /**
     * Bot token
     *
     * @var string
     */
    public $apiToken;
    public $botName;

    public function __construct($config = [])
    {
        if (!empty($config)) {
            Yii::configure($this, $config);
        }
        if (empty($this->apiToken)) {
            throw new Exception('Bot token cannot be empty');
        }
        parent::__construct($this->apiToken, $this->botName);
        $this->addCommandsPath(Yii::getAlias('@app/components/Telegram/Bot/commands'));
        $this->addCommandsPath(Yii::getAlias('@app/components/Telegram/Bot/commands/disableDefaultCmd'));
    }
}