<?php

use yii\db\Migration;

/**
 * Class m201224_203824_add_user_id
 */
class m201224_203824_add_user_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%clientes}}', 'user_id', $this->integer()->defaultValue(null));
        $this->addColumn('{{%tarjetas}}', 'user_id', $this->integer()->defaultValue(null));
        $this->addColumn('{{%tarjetas}}', 'date', $this->dateTime()->defaultValue(null));
        $this->addColumn('{{%transacciones}}', 'user_id', $this->integer()->defaultValue(null));
        $this->addColumn('{{%transacciones_detalle}}', 'user_id', $this->integer()->defaultValue(null));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201224_203824_add_user_id cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201224_203824_add_user_id cannot be reverted.\n";

        return false;
    }
    */
}
