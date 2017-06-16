<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PaymentMethod;

/**
 * PaymentMethodSearch represents the model behind the search form about `backend\models\PaymentMethod`.
 */
class PaymentMethodSearch extends PaymentMethod
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
         return [
            [['customer_id', 'active'], 'integer'],
            [['card_last_digits', 'exp_date', 'card_type', 'name', 'address', 'state', 'zipcode'], 'safe'],
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
            $query = PaymentMethod::find()->where(['customer_id' => $c_id]);
        } else {
            $query = PaymentMethod::find();
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
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'card_last_digits', $this->card_last_digits])
            ->andFilterWhere(['like', 'exp_date', $this->exp_date])
            ->andFilterWhere(['like', 'card_type', $this->card_type])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'zipcode', $this->zipcode])
            ->andFilterWhere(['=', 'active', 1]);

        return $dataProvider;
    }
}