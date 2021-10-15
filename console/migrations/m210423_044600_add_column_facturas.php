<?php

use yii\db\Migration;

/**
 * Class m210423_044600_add_column_facturas
 */
class m210423_044600_add_column_facturas extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%facturas}}', 'cotizacion', $this->integer()->defaultValue(0));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210423_044600_add_column_facturas cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210423_044600_add_column_facturas cannot be reverted.\n";

        return false;
    }
    */
}
