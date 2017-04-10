<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TaskImage as TaskImageModel;

/**
 * TaskImage represents the model behind the search form about `app\models\TaskImage`.
 */
class TaskImage extends TaskImageModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['task_id', 'image_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = TaskImageModel::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'task_id' => $this->task_id,
            'image_id' => $this->image_id,
        ]);

        return $dataProvider;
    }
}
