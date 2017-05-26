<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "answer_log".
 *
 * @property integer $id
 * @property string $answer
 * @property integer $telegram_user_id
 * @property integer $game_id
 * @property integer $task_id
 * @property string $answer_time
 *
 * @property Game $game
 * @property Task $task
 * @property TelegramUser $telegramUser
 */
class AnswerLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'answer_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['answer'], 'string'],
            [['telegram_user_id', 'game_id', 'task_id'], 'integer'],
            [['answer_time'], 'safe'],
            [['game_id'], 'exist', 'skipOnError' => true, 'targetClass' => Game::className(), 'targetAttribute' => ['game_id' => 'id']],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'id']],
            [['telegram_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => TelegramUser::className(), 'targetAttribute' => ['telegram_user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'answer' => 'Answer',
            'telegram_user_id' => 'Telegram User ID',
            'game_id' => 'Game ID',
            'task_id' => 'Task ID',
            'answer_time' => 'Answer Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGame()
    {
        return $this->hasOne(Game::className(), ['id' => 'game_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'task_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTelegramUser()
    {
        return $this->hasOne(TelegramUser::className(), ['id' => 'telegram_user_id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\queries\AnswerLogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\AnswerLogQuery(get_called_class());
    }
}
