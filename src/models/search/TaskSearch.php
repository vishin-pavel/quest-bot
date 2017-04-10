<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Task;

/**
 * TaskSearch represents the model behind the search form about `app\models\Task`.
 */
class TaskSearch extends Task
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'next_task', 'prev_task', 'game_id'], 'integer'],
            [['description', 'start_text', 'final_text', 'pass_phrase'], 'safe'],
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
        $query = Task::find();

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
            'id' => $this->id,
            'next_task' => $this->next_task,
            'prev_task' => $this->prev_task,
            'game_id' => $this->game_id,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'start_text', $this->start_text])
            ->andFilterWhere(['like', 'final_text', $this->final_text])
            ->andFilterWhere(['like', 'pass_phrase', $this->pass_phrase]);

        return $dataProvider;
    }
}
