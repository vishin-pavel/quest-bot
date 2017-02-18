<?php
/**
 * Yii bootstrap file.
 * Used for enhanced IDE code autocompletion.
 */
class Yii extends \yii\BaseYii
{
    /**
     * @var BaseApplication|WebApplication|ConsoleApplication the application instance
     */
    public static $app;
}

/**
 * Class BaseApplication
 * Used for properties that are identical for both WebApplication and ConsoleApplication
 *
 * @property \SonkoDmitry\Yii\TelegramBot\Component $bot The auth manager for this application. Null is returned if auth manager is not configured. This property is read-only. Extended component.
 */
abstract class BaseApplication extends yii\base\Application
{
}

/**
 * Class WebApplication
 * Include only Web application related components here
 *
 * @property \SonkoDmitry\Yii\TelegramBot\Component $bot The error handler application component. This property is read-only. Extended component.
 */
class WebApplication extends yii\web\Application
{
}

/**
 * Class ConsoleApplication
 * Include only Console application related components here
 *
 * @property \SonkoDmitry\Yii\TelegramBot\Component $bot The user component. This property is read-only. Extended component.
 */
class ConsoleApplication extends yii\console\Application
{
}