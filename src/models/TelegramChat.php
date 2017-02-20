<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "telegram_chat".
 *
 * @property integer $id
 * @property string $type
 * @property string $title
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property integer $all_members_are_administrators
 */
class TelegramChat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'telegram_chat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'all_members_are_administrators'], 'integer'],
            [['type', 'title', 'username', 'first_name', 'last_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'title' => 'Title',
            'username' => 'Username',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'all_members_are_administrators' => 'All Members Are Administrators',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\queries\TelegramChatQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\TelegramChatQuery(get_called_class());
    }
}
