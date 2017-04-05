<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Item;

/**
 * ItemSearch represents the model behind the search form about `backend\models\Item`.
 */
class ItemSearch extends Item
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'quantity_remaining', 'item_category_id', 'item_sub_category_id', 'active'], 'integer'],
            [['name', 'picture', 'size', 'description'], 'safe'],
            [['gross_price', 'production_cost'], 'number'],
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
        $query = Item::find();

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
            'item_id' => $this->item_id,
            'quantity_remaining' => $this->quantity_remaining,
            'gross_price' => $this->gross_price,
            'production_cost' => $this->production_cost,
            'item_category_id' => $this->item_category_id,
            'item_sub_category_id' => $this->item_sub_category_id,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'picture', $this->picture])
            ->andFilterWhere(['like', 'size', $this->size])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
