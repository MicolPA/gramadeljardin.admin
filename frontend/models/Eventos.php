<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "eventos".
 *
 * @property int $id
 * @property string|null $nombre
 * @property int|null $cliente_id
 * @property string|null $event_date
 * @property int|null $user_id
 * @property string|null $hora
 * @property string|null $date
 */
class Eventos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'eventos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cliente_id', 'user_id'], 'integer'],
            [['event_date', 'hora', 'date'], 'safe'],
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
            'cliente_id' => 'Cliente ID',
            'event_date' => 'Event Date',
            'user_id' => 'User ID',
            'hora' => 'Hora',
            'date' => 'Date',
        ];
    }
}
