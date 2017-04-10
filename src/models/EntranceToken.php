<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "entrance_token".
 *
 * @property integer $id
 * @property string $token
 * @property integer $counter
 * @property integer $group_id
 *
 * @property Group $group
 * @property Game $game
 */
class EntranceToken extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entrance_token';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['counter', 'group_id', 'game_id'], 'integer'],
            [['token'], 'default', 'value'=>function(){return \Yii::$app->security->generateRandomString(32);}],
            [['token'], 'string', 'max' => 32],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_id' => 'id']],
            [['game_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['game_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'token' => 'Token',
            'counter' => 'Counter',
            'group_id' => 'Group ID',
            'game_id' => 'Game ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
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
     * @return \app\models\queries\EntranceTokenQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\EntranceTokenQuery(get_called_class());
    }
}
