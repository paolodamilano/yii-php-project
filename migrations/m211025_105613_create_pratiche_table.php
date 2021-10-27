<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pratiche}}`.
 */
class m211025_105613_create_pratiche_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pratiche}}', [
            'id' => $this->primaryKey(),
            'id_pratica' => $this->string(255)->notNull()->unique(),
            'data_creazione' => $this->dateTime()->notNull(),
            'stato' => "enum('open','close')",
            'note' => $this->text(),
            'id_cliente' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%pratiche}}');
    }
}
