<?php

use yii\db\Migration;

/**
 * Class m210730_020043_add_new_field
 */
class m210730_020043_add_new_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%facturas}}', 'factura_code', $this->string()->defaultValue(null));
        $this->addColumn('{{%facturas}}', 'factura_url', $this->string()->defaultValue(null));
        $this->addColumn('{{%facturas}}', 'pdf_generated', $this->integer()->defaultValue(null));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210730_020043_add_new_field cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210730_020043_add_new_field cannot be reverted.\n";

        return false;
    }
    */
}
