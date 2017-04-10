<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Player;

/**
 * PlayerSearch represents the model behind the search form about `app\models\Player`.
 */
class PlayerSearch extends Player
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['telegram_user_id', 'game_id', 'game_status', 'current_task'], 'integer'],
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
        $query = Player::find();

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
            'telegram_user_id' => $this->telegram_user_id,
            'game_id' => $this->game_id,
            'game_status' => $this->game_status,
            'current_task' => $this->current_task,
        ]);

        return $dataProvider;
    }
}
