<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Handles the creation of table `Languages`.
 */
class m171116_191100_create_Languages_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('Languages', [
            'id' => $this->primaryKey(),
			'name' => Schema::TYPE_STRING . ' NOT NULL',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('Languages');
    }
}
