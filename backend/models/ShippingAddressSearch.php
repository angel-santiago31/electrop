<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ShippingAddress;

/**
 * ShippingAddressSearch represents the model behind the search form about `backend\models\ShippingAddress`.
 */
class ShippingAddressSearch extends ShippingAddress
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'apt_number', 'active'], 'integer'],
            [['street_name', 'zipcode', 'state'], 'safe'],
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
            $query = ShippingAddress::find()->where(['customer_id' => $c_id]);
        } else {
            $query = ShippingAddress::find();
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
            'customer_id' => $this->customer_id,
            'apt_number' => $this->apt_number,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'street_name', $this->street_name])
            ->andFilterWhere(['like', 'zipcode', $this->zipcode])
            ->andFilterWhere(['like', 'state', $this->state]);

        return $dataProvider;
    }
}