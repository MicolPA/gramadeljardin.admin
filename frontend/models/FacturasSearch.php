<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Facturas;

/**
 * FacturasSearch represents the model behind the search form of `frontend\models\Facturas`.
 */
class FacturasSearch extends Facturas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cliente_id', 'total', 'user_id'], 'integer'],
            [['cliente_nombre', 'date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Facturas::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id' => SORT_DESC]],
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
            'cliente_id' => $this->cliente_id,
            'total' => $this->total,
            'user_id' => $this->user_id,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'cliente_nombre', $this->cliente_nombre]);

        return $dataProvider;
    }
}
