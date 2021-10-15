<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tipos_importes".
 *
 * @property int $id
 * @property string|null $nombre
 *
 * @property Transacciones[] $transacciones
 * @property TransaccionesDetalle[] $transaccionesDetalles
 */
class TiposImportes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipos_importes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * Gets query for [[Transacciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransacciones()
    {
        return $this->hasMany(Transacciones::className(), ['tipo_id' => 'id']);
    }

    /**
     * Gets query for [[TransaccionesDetalles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransaccionesDetalles()
    {
        return $this->hasMany(TransaccionesDetalle::className(), ['tipo_id' => 'id']);
    }
}
