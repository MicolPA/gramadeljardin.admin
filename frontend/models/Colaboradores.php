<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "colaboradores".
 *
 * @property int $id
 * @property string|null $nombre
 * @property string|null $apellido
 * @property string|null $celular
 * @property string|null $email
 * @property string|null $fecha_nacimiento
 * @property string|null $fecha_ingreso
 * @property string|null $resumen
 * @property string|null $cuenta
 * @property string|null $cuenta_banco
 * @property string|null $portafolio_url
 * @property string|null $photo_url
 * @property string|null $date
 *
 * @property TransaccionesDetalle[] $transaccionesDetalles
 */
class Colaboradores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'colaboradores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha_nacimiento', 'fecha_ingreso', 'date'], 'safe'],
            [['resumen'], 'string'],
            [['nombre', 'apellido', 'celular', 'email', 'cuenta', 'cuenta_banco', 'portafolio_url', 'photo_url'], 'string', 'max' => 255],
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
            'apellido' => 'Apellido',
            'celular' => 'Celular',
            'email' => 'Email',
            'fecha_nacimiento' => 'Fecha Nacimiento',
            'fecha_ingreso' => 'Fecha Ingreso',
            'resumen' => 'Resumen',
            'cuenta' => 'Cuenta bancaria',
            'cuenta_banco' => 'Banco',
            'portafolio_url' => 'Portafolio Url',
            'photo_url' => 'Photo Url',
            'date' => 'Date',
        ];
    }

    /**
     * Gets query for [[TransaccionesDetalles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransaccionesDetalles()
    {
        return $this->hasMany(TransaccionesDetalle::className(), ['colaborador_id' => 'id']);
    }
}
