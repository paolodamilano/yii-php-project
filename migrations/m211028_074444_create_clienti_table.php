<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%clienti}}`.
 */
class m211028_074444_create_clienti_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%clienti}}', [
            'id' => $this->primaryKey(),
            'nome' => $this->string(255)->notNull(),
            'cognome' => $this->string(255)->notNull(),
            'codice_fiscale' => $this->string(16)->notNull()->unique(),
            'note' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%clienti}}');
    }
}
