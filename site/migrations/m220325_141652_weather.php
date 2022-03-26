<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m220325_141652_weather
 */
class m220325_141652_weather extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('weather', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'description' => Schema::TYPE_TEXT,
            'link' => Schema::TYPE_STRING,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // echo "m220325_141652_weather cannot be reverted.\n";
        $this->dropTable('weather');
        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220325_141652_weather cannot be reverted.\n";

        return false;
    }
    */
}
