<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Handles the creation of table `Authors`.
 */
class m171116_191019_create_Authors_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('Authors', [
            'id' => $this->primaryKey(),
			'name' => Schema::TYPE_STRING . ' NOT NULL',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('Authors');
    }
}
