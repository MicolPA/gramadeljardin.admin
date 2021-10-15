<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Clientes;

/**
 * ClientesSearch represents the model behind the search form of `frontend\models\Clientes`.
 */
class ClientesSearch extends Clientes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tipo_servicio_id', 'importe_base', 'status'], 'integer'],
            [['empresa', 'dominio', 'logo_url', 'representante_nombre', 'representante_telefono', 'representante_correo', 'fecha_comienzo', 'tiempo_estimado', 'date'], 'safe'],
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
        $query = Clientes::find();

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
            'tipo_servicio_id' => $this->tipo_servicio_id,
            'importe_base' => $this->importe_base,
            'fecha_comienzo' => $this->fecha_comienzo,
            'status' => $this->status,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'empresa', $this->empresa])
            ->andFilterWhere(['like', 'dominio', $this->dominio])
            ->andFilterWhere(['like', 'logo_url', $this->logo_url])
            ->andFilterWhere(['like', 'representante_nombre', $this->representante_nombre])
            ->andFilterWhere(['like', 'representante_telefono', $this->representante_telefono])
            ->andFilterWhere(['like', 'representante_correo', $this->representante_correo])
            ->andFilterWhere(['like', 'tiempo_estimado', $this->tiempo_estimado]);

        return $dataProvider;
    }
}
