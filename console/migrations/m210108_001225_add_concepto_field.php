<?php

use yii\db\Migration;

/**
 * Class m210108_001225_add_concepto_field
 */
class m210108_001225_add_concepto_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%transacciones}}', 'concepto', $this->string()->defaultValue(null));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210108_001225_add_concepto_field cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210108_001225_add_concepto_field cannot be reverted.\n";

        return false;
    }
    */
}
