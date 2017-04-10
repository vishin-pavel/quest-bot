<?php

namespace app\models\queries;

/**
 * This is the ActiveQuery class for [[\app\models\Group]].
 *
 * @see \app\models\Group
 */
class GroupQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\models\Group[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Group|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
