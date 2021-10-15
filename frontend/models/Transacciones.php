<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "transacciones".
 *
 * @property int $id
 * @property int $tipo_id
 * @property int $servicio_extra_id
 * @property int|null $cliente_id
 * @property int|null $total
 * @property string|null $fecha_pago
 * @property string|null $date
 * @property string|null $concepto
 *
 * @property Clientes $cliente
 * @property TiposImportes $tipo
 * @property ServiciosExtras $servicioExtra
 * @property TransaccionesDetalle[] $transaccionesDetalles
 */
class Transacciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transacciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo_id', 'servicio_extra_id', 'cliente_id', 'total'], 'integer'],
            [['fecha_pago', 'date', 'concepto'], 'safe'],
            [['fecha_pago', 'tipo_id', 'total'], 'required'],
            [['cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clientes::className(), 'targetAttribute' => ['cliente_id' => 'id']],
            [['tipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => TiposImportes::className(), 'targetAttribute' => ['tipo_id' => 'id']],
            [['servicio_extra_id'], 'exist', 'skipOnError' => true, 'targetClass' => ServiciosExtras::className(), 'targetAttribute' => ['servicio_extra_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo_id' => 'Tipo importe',
            'servicio_extra_id' => 'Servicio',
            'cliente_id' => 'Cliente',
            'total' => 'Total',
            'fecha_pago' => 'Fecha Pago',
            'date' => 'Date',
        ];
    }

    /**
     * Gets query for [[Cliente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(Clientes::className(), ['id' => 'cliente_id']);
    }

    /**
     * Gets query for [[Tipo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipo()
    {
        return $this->hasOne(TiposImportes::className(), ['id' => 'tipo_id']);
    }

    /**
     * Gets query for [[ServicioExtra]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServicioExtra()
    {
        return $this->hasOne(ServiciosExtras::className(), ['id' => 'servicio_extra_id']);
    }

    /**
     * Gets query for [[TransaccionesDetalles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransaccionesDetalles()
    {
        return $this->hasMany(TransaccionesDetalle::className(), ['transaccion_id' => 'id']);
    }
}
