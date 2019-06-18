<?php

use yii\db\Migration;

/**
 * Class m190618_210424_create_product_fake_data
 */
class m190618_210424_create_product_fake_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $categories = \common\models\ProductCategory::find()->asArray()->all();

        foreach ($categories as $cat) {
            for ($i = 0; $i < 10; $i++) {
                $faker = \Faker\Factory::create();
                $prod_model = new \common\models\Product();
                $prod_model->title = $faker->unique()->text(50);
                $prod_model->article = "art.".$faker->text(10);
                $prod_model->price = $faker->biasedNumberBetween(1000, 2000);
                $prod_model->cat_id = $cat['id'];
//                $prod_model->prod_img = 'https://picsum.photos/600?random=1';
                $prod_model->prod_img = 'http://lorempixel.com/600/600/food/'.$i;
                $prod_model->description = $faker->text;
                $prod_model->prod_slug = $prod_model->title;
                $prod_model->save();
            }

        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190618_210424_create_product_fake_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190618_210424_create_product_fake_data cannot be reverted.\n";

        return false;
    }
    */
}
