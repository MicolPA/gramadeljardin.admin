<?php

use yii\db\Migration;

/**
 * Class m210614_201853_add_field_date
 */
class m210614_201853_add_field_date extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%facturas}}', 'fecha_pagada', $this->date()->defaultValue(null));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210614_201853_add_field_date cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210614_201853_add_field_date cannot be reverted.\n";

        return false;
    }
    */
}
