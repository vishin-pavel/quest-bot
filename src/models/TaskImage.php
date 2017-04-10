<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task_image".
 *
 * @property integer $task_id
 * @property integer $image_id
 *
 * @property File $image
 * @property Task $task
 */
class TaskImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['task_id', 'image_id'], 'required'],
            [['task_id', 'image_id'], 'integer'],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => File::className(), 'targetAttribute' => ['image_id' => 'id']],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'task_id' => 'Task ID',
            'image_id' => 'Image ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(File::className(), ['id' => 'image_id']);
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
     * @return \app\models\queries\TaskImageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\TaskImageQuery(get_called_class());
    }
}
