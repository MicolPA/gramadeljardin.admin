<?php

use yii\db\Migration;

/**
 * Class m210108_223550_add_new_table_anotaciones
 */
class m210108_223550_add_new_table_anotaciones extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%anotaciones}}', [
            'id' => $this->primaryKey(),
            'text' => $this->text(),
            'user_id' => $this->integer(),
            'cliente_id' => $this->integer(),
            'ultima_modificacion' => $this->dateTime(),
            'date' => $this->dateTime(),
        ], $tableOptions);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210108_223550_add_new_table_anotaciones cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210108_223550_add_new_table_anotaciones cannot be reverted.\n";

        return false;
    }
    */
}
