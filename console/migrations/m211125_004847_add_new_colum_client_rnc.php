<?php

use yii\db\Migration;

/**
 * Class m211125_004847_add_new_colum_client_rnc
 */
class m211125_004847_add_new_colum_client_rnc extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%facturas}}', 'cliente_rnc', $this->string()->defaultValue(null));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211125_004847_add_new_colum_client_rnc cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211125_004847_add_new_colum_client_rnc cannot be reverted.\n";

        return false;
    }
    */
}
