<?php

namespace app\models\queries;

/**
 * This is the ActiveQuery class for [[\app\models\TaskPointer]].
 *
 * @see \app\models\TaskPointer
 */
class TaskPointerQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\models\TaskPointer[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\TaskPointer|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
