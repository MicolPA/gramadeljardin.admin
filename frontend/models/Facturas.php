<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "facturas".
 *
 * @property int $id
 * @property int|null $cliente_id
 * @property string|null $cliente_nombre
 * @property int|null $total
 * @property int|null $user_id
 * @property int|null $cotizacion
 * @property string|null $date
 *
 * @property Clientes $cliente
 * @property FacturasDetalle[] $facturasDetalles
 */
class Facturas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'facturas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cliente_id', 'total', 'user_id', 'cotizacion', 'pagada'], 'integer'],
            [['date', 'fecha_pagada', 'comprobante'], 'safe'],
            [['cliente_nombre', 'asunto', 'moneda'], 'string', 'max' => 255],
            [['cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clientes::className(), 'targetAttribute' => ['cliente_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cliente_id' => 'Empresa',
            'cliente_nombre' => 'Dirigida a:',
            'asunto' => 'Por concepto de:',
            'total' => 'Total',
            'user_id' => 'Usuario',
            'date' => 'Fecha',
            'cotizacion' => 'Cotización',
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
     * Gets query for [[FacturasDetalles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFacturasDetalles()
    {
        return $this->hasMany(FacturasDetalle::className(), ['factura_id' => 'id']);
    }
}
