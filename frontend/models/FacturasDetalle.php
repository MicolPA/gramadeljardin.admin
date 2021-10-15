<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "facturas_detalle".
 *
 * @property int $id
 * @property int|null $factura_id
 * @property string|null $descripcion
 * @property int|null $precio
 * @property string|null $date
 *
 * @property Facturas $factura
 */
class FacturasDetalle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'facturas_detalle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['factura_id', 'precio'], 'integer'],
            [['date'], 'safe'],
            [['descripcion'], 'string', 'max' => 255],
            [['factura_id'], 'exist', 'skipOnError' => true, 'targetClass' => Facturas::className(), 'targetAttribute' => ['factura_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'factura_id' => 'Factura ID',
            'descripcion' => 'Descripcion',
            'precio' => 'Precio',
            'date' => 'Date',
        ];
    }

    /**
     * Gets query for [[Factura]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFactura()
    {
        return $this->hasOne(Facturas::className(), ['id' => 'factura_id']);
    }
}
