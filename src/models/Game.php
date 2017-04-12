<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "game".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property mixed $first_task
 *
 * @property Player[] $players
 * @property TelegramUser[] $telegramUsers
 * @property Task[] $tasks
 */
class Game extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['first_task'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayers()
    {
        return $this->hasMany(Player::className(), ['game_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTelegramUsers()
    {
        return $this->hasMany(TelegramUser::className(), ['id' => 'telegram_user_id'])->viaTable('player', ['game_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['game_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\queries\GameQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\GameQuery(get_called_class());
    }
}
