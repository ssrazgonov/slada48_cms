<?php


namespace frontend\models;


use common\models\Product;
use common\models\ProductOption;
use yii\base\Model;

class Cart extends Model
{
    public static function getProducts($cart) {

        $products = [];
        $i = 0;
        foreach ($cart as $item) {
            $product['product'] = Product::find()->where(['id' => $item['product_id']])->asArray()->one();
            $product['option'] = isset($item['product_option']) ? ProductOption::find()->where(['id' => $item['product_option']])->asArray()->one() : null;
            $product['quantity'] = $item['product_quantity'];
            $product['id'] = $i;
            $products[] = $product;
            $i++;
        }

        return $products;
    }
}