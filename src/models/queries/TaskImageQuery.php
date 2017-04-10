<?php

namespace app\models\queries;

/**
 * This is the ActiveQuery class for [[\app\models\TaskImage]].
 *
 * @see \app\models\TaskImage
 */
class TaskImageQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\models\TaskImage[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\TaskImage|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
