<?php

namespace app\components\Telegram\Bot;


use Yii;
use yii\base\Configurable;
use yii\base\Exception;

class Api extends \Telegram\Bot\Api implements Configurable
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
        parent::__construct($this->apiToken);
    }
}