<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m220328_075349_api_data
 */
class m220328_075349_api_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('api_data', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'content' => Schema::TYPE_TEXT,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // echo "m220328_075349_api_data cannot be reverted.\n";

        // return false;
        $this->dropTable('api_data');
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('api_data', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'content' => Schema::TYPE_TEXT,
        ]);
    }

    public function down()
    {
        echo "m220328_075349_api_data cannot be reverted.\n";

        return false;
    }

}
