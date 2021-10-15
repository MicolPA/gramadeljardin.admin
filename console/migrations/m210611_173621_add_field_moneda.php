<?php

use yii\db\Migration;

/**
 * Class m210611_173621_add_field_moneda
 */
class m210611_173621_add_field_moneda extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%facturas}}', 'moneda', $this->string()->defaultValue('RD'));
        $this->addColumn('{{%facturas}}', 'pagada', $this->integer()->defaultValue(0));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210611_173621_add_field_moneda cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210611_173621_add_field_moneda cannot be reverted.\n";

        return false;
    }
    */
}
