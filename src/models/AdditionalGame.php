<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "additional_game".
 *
 * @property integer $id
 * @property integer $first_task_id
 * @property integer $game_id
 *
 * @property Game $game
 * @property Task $firstTask
 */
class AdditionalGame extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'additional_game';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_task_id', 'game_id'], 'required'],
            [['first_task_id', 'game_id'], 'integer'],
            [['game_id'], 'exist', 'skipOnError' => true, 'targetClass' => Game::className(), 'targetAttribute' => ['game_id' => 'id']],
            [['first_task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['first_task_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_task_id' => 'First Task ID',
            'game_id' => 'Game ID',
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
    public function getFirstTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'first_task_id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\queries\AdditionalGameQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\AdditionalGameQuery(get_called_class());
    }
}
