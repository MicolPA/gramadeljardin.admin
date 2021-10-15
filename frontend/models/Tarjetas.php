<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tarjetas".
 *
 * @property int $id
 * @property string|null $nombre
 * @property string|null $dinero_total
 * @property int|null $user_id
 * @property string|null $date
 * @property string|null $color
 * @property string|null $icon
 *
 * @property TransaccionesDetalle[] $transaccionesDetalles
 */
class Tarjetas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tarjetas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['date', 'numeracion', 'representante_nombre'], 'safe'],
            [['nombre', 'dinero_total', 'color', 'icon'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Alias',
            'numeracion' => 'Numeración',
            'representante_nombre' => 'Nombre del Representante',
            'dinero_total' => 'Saldo actual',
            'user_id' => 'User ID',
            'date' => 'Date',
            'color' => 'Color',
            'icon' => 'Icon',
        ];
    }

    /**
     * Gets query for [[TransaccionesDetalles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransaccionesDetalles()
    {
        return $this->hasMany(TransaccionesDetalle::className(), ['tarjeta_id' => 'id']);
    }
}
