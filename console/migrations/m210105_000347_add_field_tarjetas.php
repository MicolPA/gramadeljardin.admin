<?php

use yii\db\Migration;

/**
 * Class m210105_000347_add_field_tarjetas
 */
class m210105_000347_add_field_tarjetas extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%tarjetas}}', 'color', $this->string()->defaultValue(null));
        $this->addColumn('{{%tarjetas}}', 'icon', $this->string()->defaultValue(null));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210105_000347_add_field_tarjetas cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210105_000347_add_field_tarjetas cannot be reverted.\n";

        return false;
    }
    */
}
