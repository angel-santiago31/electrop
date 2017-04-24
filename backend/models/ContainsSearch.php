<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Contains;

/**
 * ContainsSearch represents the model behind the search form about `backend\models\Contains`.
 */
class ContainsSearch extends Contains
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_number', 'item_id', 'quantity_in_order'], 'integer'],
            [['price_sold'], 'number'],
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
    public function search($params, $orderNum = NULL)
    {
        if ($orderNum != NULL) {
            $query = Contains::find()->where(['order_number' => $orderNum]);

            $sql ="SELECT * FROM contains WHERE order_number = $orderNum";
                 Yii::$app->getSession()->setFlash('success', [
                    'type' => 'success',
                    'duration' => 5000,
                    'icon' => 'glyphicon glyphicon-ok-sign',
                    'title' => 'Query',
                    'showSeparator' => true,
                    'message' => $sql,
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
        } else {
            $query = Contains::find();
        }


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
            'order_number' => $this->order_number,
            'item_id' => $this->item_id,
            'price_sold' => $this->price_sold,
            'quantity_in_order' => $this->quantity_in_order,
        ]);

        return $dataProvider;
    }
}
