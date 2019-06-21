<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_option}}`.
 */
class m190621_073427_create_product_option_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_option}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'description' => $this->text(),
            'img' => $this->string()
        ]);

        $this->createTable('{{%product_option_rel}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'product_option_id' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product_option}}');
        $this->dropTable('{{%product_option_rel}}');
    }
}
