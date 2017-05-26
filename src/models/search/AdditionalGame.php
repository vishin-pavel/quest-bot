<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AdditionalGame as AdditionalGameModel;

/**
 * AdditionalGame represents the model behind the search form about `app\models\AdditionalGame`.
 */
class AdditionalGame extends AdditionalGameModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'first_task_id', 'game_id'], 'integer'],
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
        $query = AdditionalGameModel::find();

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
            'first_task_id' => $this->first_task_id,
            'game_id' => $this->game_id,
        ]);

        return $dataProvider;
    }
}
