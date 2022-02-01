<?php

use yii\db\Migration;

/**
 * Class m220201_170701_add_field_nfc
 */
class m220201_170701_add_field_nfc extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%facturas}}', 'ncf', $this->string()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220201_170701_add_field_nfc cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220201_170701_add_field_nfc cannot be reverted.\n";

        return false;
    }
    */
}
