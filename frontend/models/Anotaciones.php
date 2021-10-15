<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "anotaciones".
 *
 * @property int $id
 * @property string|null $text
 * @property int|null $user_id
 * @property int|null $cliente_id
 * @property string|null $ultima_modificacion
 * @property string|null $date
 */
class Anotaciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'anotaciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text'], 'string'],
            [['user_id', 'cliente_id'], 'integer'],
            [['ultima_modificacion', 'date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'user_id' => 'User ID',
            'cliente_id' => 'Cliente ID',
            'ultima_modificacion' => 'Ultima Modificacion',
            'date' => 'Date',
        ];
    }
}
