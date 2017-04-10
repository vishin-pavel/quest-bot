<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TelegramChat;

/**
 * TelegramChatSearch represents the model behind the search form about `app\models\TelegramChat`.
 */
class TelegramChatSearch extends TelegramChat
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'all_members_are_administrators'], 'integer'],
            [['type', 'title', 'username', 'first_name', 'last_name'], 'safe'],
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
        $query = TelegramChat::find();

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
            'all_members_are_administrators' => $this->all_members_are_administrators,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name]);

        return $dataProvider;
    }
}
