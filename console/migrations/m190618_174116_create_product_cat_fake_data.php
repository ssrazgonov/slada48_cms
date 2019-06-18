<?php

use yii\db\Migration;

/**
 * Class m190618_174116_create_product_fake_data
 */
class m190618_174116_create_product_cat_fake_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $categories = [
            [
                'title' => "Детские торты",
                'parent_id' => 0,
                'cat_img' => '1.jpg',
                'description' => 'Детские торты любых видов',
                'cat_slug' => 'det-tort'
            ],
            [
                'title' => "Праздничные торты торты",
                'parent_id' => 0,
                'cat_img' => '1.jpg',
                'description' => 'Праздничные торты любых видов',
                'cat_slug' => 'prazd-tort'
            ],
            [
                'title' => "Свадебные торты",
                'parent_id' => 0,
                'cat_img' => '1.jpg',
                'description' => 'Свадебные торты любых видов',
                'cat_slug' => 'svad-tort'
            ]
        ];


        foreach ($categories as $cat) {
            $cat_model = new \common\models\ProductCategory();
            $cat_model->title = $cat['title'];
            $cat_model->parent_id = $cat['parent_id'];
            $cat_model->cat_img = $cat['cat_img'];
            $cat_model->description = $cat['description'];
            $cat_model->cat_slug = $cat['cat_slug'];
            $cat_model->save();
        }



    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190618_174116_create_product_fake_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190618_174116_create_product_fake_data cannot be reverted.\n";

        return false;
    }
    */
}
