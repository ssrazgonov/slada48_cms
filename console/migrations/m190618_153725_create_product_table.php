<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m190618_153725_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'article' => $this->string(255),
            'cat_id' => $this->integer(),
            'price' => $this->float(),
            'description' => $this->string(255),
            'prod_img' => $this->string(255),
            'prod_slug' => $this->string(255)->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}
