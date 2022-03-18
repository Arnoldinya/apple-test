<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'password_hash' => $this->string()->notNull(),
        ], $tableOptions);

        $this->createTable('apple', [
            'id' => $this->primaryKey(),
            'color' => $this->string()->notNull(),
            'percent' => $this->float()->defaultValue(true),
            'create_at' => $this->integer()->notNull(),
            'drop_at' => $this->integer(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('apple');
        $this->dropTable('user');
    }
}
