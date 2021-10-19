<?php

use yii\db\Migration;

/**
 * Class m211019_163337_agregar_columna_cantidad_factura
 */
class m211019_163337_agregar_columna_cantidad_factura extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%facturas_detalle}}', 'cantidad', $this->integer()->defaultValue(null));
        $this->addColumn('{{%facturas_detalle}}', 'total', $this->integer()->defaultValue(null));
        $this->addColumn('{{%facturas}}', 'comprobante', $this->string()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211019_163337_agregar_columna_cantidad_factura cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211019_163337_agregar_columna_cantidad_factura cannot be reverted.\n";

        return false;
    }
    */
}
