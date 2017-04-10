<?php

namespace app\models;

use yii\web\HttpException;
use yii\web\UploadedFile;

/**
 * This is the model class for table "file".
 *
 * @property integer $id
 * @property string $path
 *
 * @property UploadedFile $imageFile
 *
 * @property TaskImage[] $taskImages
 * @property Task[] $tasks
 */
class File extends \yii\db\ActiveRecord
{
    const BASE_UPLOAD_PATH = '/upload/';
    public $imageFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['path'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, gif'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $path = $this->makePath();
            $this->imageFile->saveAs(__DIR__ . '/../web' . $path);

            return $path;
        } else {
            return false;
        }
    }

    public function removeFile()
    {
        if (file_exists(__DIR__ . '/../web' . $this->path)) {
            unlink(__DIR__ . '/../web' . $this->path);
        }
    }

    private function makePath()
    {
        $name = \Yii::$app->security->generateRandomString(32);
        return self::BASE_UPLOAD_PATH . $name . '.' . $this->imageFile->extension;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'   => 'ID',
            'path' => 'Path',
            'imageFile' => 'File'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaskImages()
    {
        return $this->hasMany(TaskImage::className(), ['image_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['id' => 'task_id'])->viaTable('task_image', ['image_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\queries\FileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\FileQuery(get_called_class());
    }

    public function afterDelete()
    {
        parent::afterDelete();
        $this->removeFile();
    }

    public function beforeSave($insert)
    {
        if($insert){
            if (!$this->path = $this->upload()){
                throw new HttpException('Ошибка загрузки файла');
            }
        }

        return parent::beforeSave($insert);
    }
}
