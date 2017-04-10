<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task_pointer".
 *
 * @property integer $id
 * @property integer $from
 * @property integer $to
 * @property integer $type
 *
 * @property Task $from0
 * @property Task $to0
 */
class TaskPointer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task_pointer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['from', 'to', 'type'], 'integer'],
            [['from'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['from' => 'id']],
            [['to'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['to' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from' => 'From',
            'to' => 'To',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrom0()
    {
        return $this->hasOne(Task::className(), ['id' => 'from']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTo0()
    {
        return $this->hasOne(Task::className(), ['id' => 'to']);
    }

    /**
     * @inheritdoc
     * @return \app\models\queries\TaskPointerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\TaskPointerQuery(get_called_class());
    }
}
