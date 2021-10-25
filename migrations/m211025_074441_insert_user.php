<?php

use yii\db\Migration;

/**
 * Class m211025_074441_insert_user
 */
class m211025_074441_insert_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('user',[
            'username' => "admin",
            'password' => "admin",
            'auth_key' => "test100key",
            'access_token' => "100-token"
        ]);

        $this->insert('user',[
            'username' => "demo",
            'password' => "demo",
            'auth_key' => "test101key",
            'access_token' => "101-token"
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211025_074441_insert_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211025_074441_insert_user cannot be reverted.\n";

        return false;
    }
    */
}
