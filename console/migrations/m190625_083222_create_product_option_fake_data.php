<?php

use yii\db\Migration;

/**
 * Class m190625_083222_create_product_option_fake_data
 */
class m190625_083222_create_product_option_fake_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $products = \common\models\Product::find()->all();

        $product_options = [
            [
                "title" => "0",
                "description" => "Слои медового полуфабриката соединены между собой кремом сливочным с вареным сгущенным молоком.",
                "img" => '/img/nachinka1.png'
            ],
            [
                "title" => "1",
                "description" => "Слои бисквитного полуфабриката поочередно соединены между собой суфле, черносмородиновым конфитюром и дробленым арахисом.",
                "img" => '/img/nachinka2.jpg'
            ],
            [
                "title" => "2",
                "description" => "Слои медового полуфабриката соединены между собой сметанным кремом с добавлением чернослива и грецкого ореха.",
                "img" => '/img/nachinka3.jpg'
            ],
        ];

        foreach ($product_options as $product_option) {
            $model = new \common\models\ProductOption();
            $model->title = $product_option['title'];
            $model->description = $product_option['description'];
            $model->img = $product_option['img'];
            $model->save();
        }

        foreach ($products as $product) {
            for ($i = 1; $i <= 3; $i++) {
                $product_option_rel = new \common\models\ProductOptionRel();
                $product_option_rel->product_id = $product->id;
                $product_option_rel->product_option_id = $i;
                $product_option_rel->save();
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190625_083222_create_product_option_fake_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190625_083222_create_product_option_fake_data cannot be reverted.\n";

        return false;
    }
    */
}
