<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\mysql\QueryBuilder;
use yii\db\Query;

/**
 * This is the model class for table "task".
 *
 * @property integer $id
 * @property string $description
 * @property string $start_text
 * @property string $final_text
 * @property string $pass_phrase
 * @property integer $next_task
 * @property integer $prev_task
 * @property integer $game_id
 * @property string $longitude
 * @property string $latitude
 *
 * @property Game $game
 * @property File[] $images
 * @property Hint[] $hints
 *
 */
class Task extends \yii\db\ActiveRecord
{
//    var $longitude;
//    var $latitude;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'start_text', 'final_text',], 'string'],
            [['next_task', 'prev_task', 'game_id'], 'integer'],
//            [['longitude', 'latitude'], 'required'],
            [['pass_phrase'], 'string', 'max' => 255],
            [
                ['game_id'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => Game::className(),
                'targetAttribute' => ['game_id' => 'id']
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'description' => 'Description',
            'start_text'  => 'Start Text',
            'final_text'  => 'Final Text',
            'pass_phrase' => 'Pass Phrase',
            'next_task'   => 'Next Task',
            'prev_task'   => 'Prev Task',
            'game_id'     => 'Game ID',
//            'longitude' => 'Долгота',
//            'latitude' => 'Широта',
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
     * @inheritdoc
     * @return \app\models\queries\TaskQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\TaskQuery(get_called_class());
    }

    public function getTaskImages()
    {
        return $this->hasMany(TaskImage::className(), ['task_id' => 'id']);
    }

    public function getImages()
    {
        return $this->hasMany(File::className(), ['id'=>'image_id'])->via('taskImages');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHints()
    {
        return $this->hasMany(Hint::className(), ['task_id' => 'id']);
    }

}
