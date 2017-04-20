<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Order;

/**
 * OrderSearch represents the model behind the search form about `backend\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_number', 'order_date', 'amount_stickers', 'order_status', 'customer_id', 'tracking_number'], 'integer'],
            [['total_price'], 'number'],
            [['shipper_company_name'], 'safe'],
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
    public function search($params, $c_id = NULL)
    {
        if ($c_id !== NULL) {
            $query = Order::find()->where(['customer_id' => $c_id])->orderBy(['order_date' => SORT_DESC]);
        } else {
            $query = Order::find()->orderBy(['order_date' => SORT_DESC]);
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
            'order_date' => $this->order_date,
            'amount_stickers' => $this->amount_stickers,
            'total_price' => $this->total_price,
            'order_status' => $this->order_status,
            'customer_id' => $this->customer_id,
            'tracking_number' => $this->tracking_number,
        ]);

        $query->andFilterWhere(['like', 'shipper_company_name', $this->shipper_company_name]);

        return $dataProvider;
    }
}
