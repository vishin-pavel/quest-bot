<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GroupHint as GroupHintModel;

/**
 * GroupHint represents the model behind the search form about `app\models\GroupHint`.
 */
class GroupHint extends GroupHintModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'hint_id', 'current_game_task'], 'integer'],
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
        $query = GroupHintModel::find();

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
            'group_id' => $this->group_id,
            'hint_id' => $this->hint_id,
            'current_game_task' => $this->current_game_task,
        ]);

        return $dataProvider;
    }
}
