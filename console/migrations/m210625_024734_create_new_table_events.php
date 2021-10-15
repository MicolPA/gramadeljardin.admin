<?php

use yii\db\Migration;

/**
 * Class m210625_024734_create_new_table_events
 */
class m210625_024734_create_new_table_events extends Migration
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

        $this->createTable('{{%eventos}}', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(),
            'cliente_id' => $this->integer(),
            'user_id' => $this->integer(),
            'event_date' => $this->date(),
            'hora' => $this->time(),
            'date' => $this->dateTime(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210625_024734_create_new_table_events cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210625_024734_create_new_table_events cannot be reverted.\n";

        return false;
    }
    */
}
