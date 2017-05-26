<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "group_hint".
 *
 * @property integer $group_id
 * @property integer $hint_id
 * @property integer $current_game_task
 */
class GroupHint extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group_hint';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'hint_id'], 'required'],
            [['group_id', 'hint_id', 'current_game_task'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'group_id' => 'Group ID',
            'hint_id' => 'Hint ID',
            'current_game_task' => 'Current Game Task',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\queries\GroupHintQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\GroupHintQuery(get_called_class());
    }
}
