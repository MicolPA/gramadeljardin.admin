<?php

use yii\db\Migration;

/**
 * Class m210106_231757_add_column_nombre_tarjetas
 */
class m210106_231757_add_column_nombre_tarjetas extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%tarjetas}}', 'representante_nombre', $this->string()->defaultValue(null));
        $this->addColumn('{{%tarjetas}}', 'numeracion', $this->string()->defaultValue(null));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210106_231757_add_column_nombre_tarjetas cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210106_231757_add_column_nombre_tarjetas cannot be reverted.\n";

        return false;
    }
    */
}
