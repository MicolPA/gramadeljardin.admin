<?php

use yii\db\Migration;

/**
 * Class m201221_023704_add_new_tables_clientes
 */
class m201221_023704_add_new_tables_clientes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%clientes}}', [
            'id' => $this->primaryKey(),
            'empresa' => $this->string()->notNull(),
            'dominio' => $this->string(),
            'logo_url' => $this->string(),
            'representante_nombre' => $this->string(),
            'representante_telefono' => $this->string(),
            'representante_correo' => $this->string(),
            'tipo_servicio_id' => $this->integer(),
            'importe_base' => $this->integer(),
            'fecha_comienzo' => $this->date(),
            'tiempo_estimado' => $this->string(),
            'status' => $this->integer(),
            'pago_mensual' => $this->integer(),
            'date' => $this->dateTime(),
        ], $tableOptions);


        $this->createTable('{{%transacciones}}', [
            'id' => $this->primaryKey(),
            'tipo_id' => $this->integer()->notNull(),
            'servicio_extra_id' => $this->integer()->notNull(),
            'cliente_id' => $this->integer(),
            'total' => $this->integer(),
            'fecha_pago' => $this->date(),
            'date' => $this->dateTime(),
        ], $tableOptions);

        $this->createTable('{{%transacciones_detalle}}', [
            'id' => $this->primaryKey(),
            'tipo_id' => $this->integer()->notNull(),
            'cliente_id' => $this->integer(),
            'tarjeta_id' => $this->integer(),
            'transaccion_id' => $this->integer(),
            'fecha_pago' => $this->date(),
            'total' => $this->integer(),
            'date' => $this->dateTime(),
        ], $tableOptions);

        $this->createTable('{{%tarjetas}}', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(),
            'dinero_total' => $this->string(),
        ], $tableOptions);


        $this->createTable('{{%servicios}}', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(),
        ], $tableOptions);


        $this->createTable('{{%servicios_extras}}', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(),
            'precio' => $this->string(),
        ], $tableOptions);


        $this->createTable('{{%clientes_estatus}}', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(),
            'color' => $this->string(),
        ], $tableOptions);


        $this->createTable('{{%tipos_importes}}', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(),
        ], $tableOptions);

        $this->addForeignKey('servicio', '{{%clientes}}', 'tipo_servicio_id', '{{%servicios}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('status', '{{%clientes}}', 'status', '{{%clientes_estatus}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('transaccion', '{{%transacciones_detalle}}', 'transaccion_id', '{{%transacciones}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('cliente', '{{%transacciones_detalle}}', 'cliente_id', '{{%clientes}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('tarjeta', '{{%transacciones_detalle}}', 'tarjeta_id', '{{%tarjetas}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('clienteT', '{{%transacciones}}', 'cliente_id', '{{%clientes}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('servicioExtra', '{{%transacciones}}', 'servicio_extra_id', '{{%servicios_extras}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('importe', '{{%transacciones}}', 'tipo_id', '{{%tipos_importes}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('importeT', '{{%transacciones_detalle}}', 'tipo_id', '{{%tipos_importes}}', 'id', 'CASCADE', 'CASCADE');


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201221_023704_add_new_tables_clientes cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201221_023704_add_new_tables_clientes cannot be reverted.\n";

        return false;
    }
    */
}
