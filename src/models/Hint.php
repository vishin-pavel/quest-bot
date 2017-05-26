<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hint".
 *
 * @property integer $id
 * @property string $hint_text
 * @property integer $task_id
 * @property integer $start_task_id
 *
 * @property Task $startTask
 * @property Task $task
 */
class Hint extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hint';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hint_text'], 'string'],
            [['task_id', 'start_task_id'], 'integer'],
            [['start_task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['start_task_id' => 'id']],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hint_text' => 'Hint Text',
            'task_id' => 'Task ID',
            'start_task_id' => 'Start Task ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStartTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'start_task_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'task_id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\queries\HintQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\HintQuery(get_called_class());
    }
}
