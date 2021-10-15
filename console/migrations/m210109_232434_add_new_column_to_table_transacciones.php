<?php

use yii\db\Migration;

/**
 * Class m210109_232434_add_new_column_to_table_transacciones
 */
class m210109_232434_add_new_column_to_table_transacciones extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%transacciones}}', 'publicidad', $this->integer()->defaultValue(0));
        $this->addColumn('{{%clientes}}', 'fecha_finalizacion', $this->date()->defaultValue(null));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210109_232434_add_new_column_to_table_transacciones cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210109_232434_add_new_column_to_table_transacciones cannot be reverted.\n";

        return false;
    }
    */
}
