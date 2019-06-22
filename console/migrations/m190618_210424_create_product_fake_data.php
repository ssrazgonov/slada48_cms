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
        $cat[0]['count'] = 15;
        $cat[1]['count'] = 9;
        $cat[2]['count'] = 25;
        $i = 0;
        $b = 10;
        foreach ($categories as $cat) {
            for ($i = $i; $i < $b; $i++) {
                $faker = \Faker\Factory::create();
                $prod_model = new \common\models\Product();
                $prod_model->title = $faker->unique()->text(50);
                $prod_model->price = $faker->biasedNumberBetween(1000, 2000);
                $prod_model->price_type_id = 1;
                $prod_model->cat_id = $cat['id'];
//                $prod_model->prod_img = 'https://picsum.photos/600?random=1';
                $prod_model->prod_img = "/upload/images/product/test{$i}.jpg";
                $prod_model->description = $faker->text;
                $prod_model->prod_slug = $prod_model->title;
                $prod_model->save();
            }
            $b +=10;
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
