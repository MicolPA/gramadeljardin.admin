<?php

use yii\db\Migration;

/**
 * Class m210619_213443_add_new_table_colaboradores
 */
class m210619_213443_add_new_table_colaboradores extends Migration
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

        $this->createTable('{{%colaboradores}}', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(),
            'apellido' => $this->string(),
            'celular' => $this->string(),
            'email' => $this->string(),
            'fecha_nacimiento' => $this->date(),
            'fecha_ingreso' => $this->date(),
            'resumen' => $this->text(),
            'cuenta' => $this->string(),
            'cuenta_banco' => $this->string(),
            'portafolio_url' => $this->string(),
            'photo_url' => $this->string(),
            'date' => $this->dateTime(),
        ], $tableOptions);

        // $this->addColumn('{{%transacciones}}', 'colaborador', $this->integer()->defaultValue(0));
        $this->addColumn('{{%transacciones_detalle}}', 'colaborador_id', $this->integer()->defaultValue(null));
        $this->addColumn('{{%transacciones}}', 'colaborador', $this->integer()->defaultValue(0));
        $this->addForeignKey('colaboradorInfo', '{{%transacciones_detalle}}', 'colaborador_id', '{{%colaboradores}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210619_213443_add_new_table_colaboradores cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210619_213443_add_new_table_colaboradores cannot be reverted.\n";

        return false;
    }
    */
}
