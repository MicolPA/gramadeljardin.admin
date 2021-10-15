<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "clientes".
 *
 * @property int $id
 * @property string $empresa
 * @property string|null $dominio
 * @property string|null $logo_url
 * @property string|null $representante_nombre
 * @property string|null $representante_telefono
 * @property string|null $representante_correo
 * @property int|null $tipo_servicio_id
 * @property int|null $importe_base
 * @property string|null $fecha_comienzo
 * @property string|null $tiempo_estimado
 * @property int|null $status
 * @property string|null $date
 *
 * @property Servicios $tipoServicio
 * @property ClientesEstatus $status0
 * @property Transacciones[] $transacciones
 * @property TransaccionesDetalle[] $transaccionesDetalles
 */
class Clientes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clientes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['empresa'], 'required'],
            [['tipo_servicio_id', 'importe_base', 'status', 'pago_mensual'], 'integer'],
            [['fecha_comienzo', 'date', 'fecha_finalizacion'], 'safe'],
            [['empresa', 'dominio', 'logo_url', 'representante_nombre', 'representante_telefono', 'representante_correo', 'tiempo_estimado'], 'string', 'max' => 255],
            [['tipo_servicio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Servicios::className(), 'targetAttribute' => ['tipo_servicio_id' => 'id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => ClientesEstatus::className(), 'targetAttribute' => ['status' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pago_mensual' => 'Pago Mensual',
            'empresa' => 'Empresa',
            'dominio' => 'Dominio',
            'logo_url' => 'Imagen del Logo',
            'representante_nombre' => 'Nombre del representante',
            'representante_telefono' => 'Tel. del representante ',
            'representante_correo' => 'Correo del representante ',
            'tipo_servicio_id' => 'Tipo servicio',
            'importe_base' => 'Importe base',
            'fecha_comienzo' => 'Fecha comienzo',
            'tiempo_estimado' => 'Tiempo estimado',
            'status' => 'Status',
            'date' => 'Date',
        ];
    }

    /**
     * Gets query for [[TipoServicio]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoServicio()
    {
        return $this->hasOne(Servicios::className(), ['id' => 'tipo_servicio_id']);
    }

    /**
     * Gets query for [[Status0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(ClientesEstatus::className(), ['id' => 'status']);
    }

    /**
     * Gets query for [[Transacciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransacciones()
    {
        return $this->hasMany(Transacciones::className(), ['cliente_id' => 'id']);
    }

    /**
     * Gets query for [[TransaccionesDetalles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransaccionesDetalles()
    {
        return $this->hasMany(TransaccionesDetalle::className(), ['cliente_id' => 'id']);
    }
}
