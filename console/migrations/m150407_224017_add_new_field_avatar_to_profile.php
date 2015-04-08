<?php

use yii\db\Schema;
use yii\db\Migration;

class m150407_224017_add_new_field_avatar_to_profile extends Migration
{
    public function up()
    {
	    $this->addColumn('{{%profile}}', 'avatar', Schema::TYPE_STRING);
    }

    public function down()
    {
	    $this->dropColumn('{{%profile}}', 'field');
    }
    
    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }
    
    public function safeDown()
    {
    }
    */
}
