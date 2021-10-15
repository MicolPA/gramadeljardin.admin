<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "transacciones_detalle".
 *
 * @property int $id
 * @property int $tipo_id
 * @property int|null $cliente_id
 * @property int|null $tarjeta_id
 * @property int|null $transaccion_id
 * @property string|null $fecha_pago
 * @property int|null $total
 * @property string|null $date
 *
 * @property Clientes $cliente
 * @property TiposImportes $tipo
 * @property Tarjetas $tarjeta
 * @property Transacciones $transaccion
 */
class TransaccionesDetalle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transacciones_detalle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo_id', 'cliente_id', 'tarjeta_id', 'transaccion_id', 'total'], 'integer'],
            [['fecha_pago', 'date'], 'safe'],
            [['cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clientes::className(), 'targetAttribute' => ['cliente_id' => 'id']],
            [['tipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => TiposImportes::className(), 'targetAttribute' => ['tipo_id' => 'id']],
            [['tarjeta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tarjetas::className(), 'targetAttribute' => ['tarjeta_id' => 'id']],
            [['transaccion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Transacciones::className(), 'targetAttribute' => ['transaccion_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo_id' => 'Tipo ID',
            'cliente_id' => 'Cliente ID',
            'tarjeta_id' => 'Tarjeta ID',
            'transaccion_id' => 'Transaccion ID',
            'fecha_pago' => 'Fecha Pago',
            'total' => 'Total',
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
     * Gets query for [[Tarjeta]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTarjeta()
    {
        return $this->hasOne(Tarjetas::className(), ['id' => 'tarjeta_id']);
    }

    /**
     * Gets query for [[Transaccion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransaccion()
    {
        return $this->hasOne(Transacciones::className(), ['id' => 'transaccion_id']);
    }
}
