<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Hint as HintModel;

/**
 * Hint represents the model behind the search form about `app\models\Hint`.
 */
class Hint extends HintModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'task_id', 'start_task_id'], 'integer'],
            [['hint_text'], 'safe'],
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
        $query = HintModel::find();

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
            'task_id' => $this->task_id,
            'start_task_id' => $this->start_task_id,
        ]);

        $query->andFilterWhere(['like', 'hint_text', $this->hint_text]);

        return $dataProvider;
    }
}
