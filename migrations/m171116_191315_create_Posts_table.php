<?php

use yii\db\Migration;

/**
 * Handles the creation of table `Posts`.
 */
class m171116_191315_create_Posts_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('Posts', [
            'id' => $this->primaryKey(),
			'language' => $this->integer()->notNull(),
			'author' => $this->integer()->notNull(),
			'date' => 'date DEFAULT NOW()',
			'title' => $this->string(64)->notNull(),
			'content' => $this->text(),
			'likes' => $this->integer()->defaultValue(0),
        ]);
		
		$this->addForeignKey(
            'Posts_language_fkey',
            "Posts",
            'language',
            "Languages",
            'id',
            'CASCADE'
        );
		
		$this->addForeignKey(
            'Posts_author_fkey',
            "Posts",
            'author',
            "Authors",
            'id',
            'CASCADE'
        );

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('Posts');
    }
}
