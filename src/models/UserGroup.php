<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_group".
 *
 * @property integer $telegram_user_id
 * @property integer $group_id
 *
 * @property TelegramUser $telegramUser
 * @property Group $group
 */
class UserGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['telegram_user_id', 'group_id'], 'required'],
            [['telegram_user_id', 'group_id'], 'integer'],
            [['telegram_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => TelegramUser::className(), 'targetAttribute' => ['telegram_user_id' => 'id']],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'telegram_user_id' => 'Telegram User ID',
            'group_id' => 'Group ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTelegramUser()
    {
        return $this->hasOne(TelegramUser::className(), ['id' => 'telegram_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\queries\UserGroupQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\UserGroupQuery(get_called_class());
    }
}
