<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Colaboradores;

/**
 * ColaboradoresSearch represents the model behind the search form of `frontend\models\Colaboradores`.
 */
class ColaboradoresSearch extends Colaboradores
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nombre', 'apellido', 'fecha_nacimiento', 'fecha_ingreso', 'resumen', 'cuenta', 'cuenta_banco', 'portafolio_url', 'date'], 'safe'],
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
        $query = Colaboradores::find();

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
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'fecha_ingreso' => $this->fecha_ingreso,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'apellido', $this->apellido])
            ->andFilterWhere(['like', 'resumen', $this->resumen])
            ->andFilterWhere(['like', 'cuenta', $this->cuenta])
            ->andFilterWhere(['like', 'cuenta_banco', $this->cuenta_banco])
            ->andFilterWhere(['like', 'portafolio_url', $this->portafolio_url]);

        return $dataProvider;
    }
}
