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
            'password' => Yii::$app->getSecurity()->generatePasswordHash("admin"),
            'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
            'access_token' => Yii::$app->getSecurity()->generateRandomString()
        ]);

        $this->insert('user',[
            'username' => "demo",
            'password' => Yii::$app->getSecurity()->generatePasswordHash("demo"),
            'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
            'access_token' => Yii::$app->getSecurity()->generateRandomString()
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
