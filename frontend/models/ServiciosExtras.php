<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "servicios_extras".
 *
 * @property int $id
 * @property string|null $nombre
 * @property string|null $precio
 *
 * @property Transacciones[] $transacciones
 */
class ServiciosExtras extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'servicios_extras';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'precio'], 'string', 'max' => 255],
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
            'precio' => 'Precio',
        ];
    }

    /**
     * Gets query for [[Transacciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransacciones()
    {
        return $this->hasMany(Transacciones::className(), ['servicio_extra_id' => 'id']);
    }
}
