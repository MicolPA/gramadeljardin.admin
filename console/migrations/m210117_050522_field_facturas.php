<?php

use yii\db\Migration;

/**
 * Class m210117_050522_field_facturas
 */
class m210117_050522_field_facturas extends Migration
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

        $this->createTable('{{%facturas}}', [
            'id' => $this->primaryKey(),
            'cliente_id' => $this->integer(),
            'cliente_nombre' => $this->string(),
            'asunto' => $this->string(),
            'total' => $this->integer(),
            'cliente_id' => $this->integer(),
            'user_id' => $this->integer(),
            'date' => $this->dateTime(),
        ], $tableOptions);



        $this->createTable('{{%facturas_detalle}}', [
            'id' => $this->primaryKey(),
            'factura_id' => $this->integer(),
            'descripcion' => $this->string(),
            'precio' => $this->integer(),
            'date' => $this->dateTime(),
        ], $tableOptions);

        $this->addForeignKey('factura', '{{%facturas_detalle}}', 'factura_id', '{{%facturas}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('clienteInfo', '{{%facturas}}', 'cliente_id', '{{%clientes}}', 'id', 'CASCADE', 'CASCADE');

        //servicio
        //precio
        //fecha
        //cliente
        //

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210117_050522_field_facturas cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210117_050522_field_facturas cannot be reverted.\n";

        return false;
    }
    */
}
