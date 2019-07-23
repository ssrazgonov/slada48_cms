<?php


namespace frontend\models;


use common\models\Product;
use common\models\ProductOption;
use yii\base\Model;

class Cart extends Model
{
    public static function getProducts($cart, $total = false) {

        if(!isset($cart['products'])) return 0;

        $products = [];
        $i = 0;
        foreach ($cart['products'] as $item) {
            $product['product'] = Product::find()->where(['id' => $item['id']])->with(['productOption'])->asArray()->one();
            $product['option'] = isset($item['product_option']) ? ProductOption::find()->where(['id' => $item['product_option']])->asArray()->one() : null;
            $product['quantity'] = $item['qty'];
            $product['price'] = $item['price'];
            $product['sum'] = $item['sum'];
            $product['id'] = $i; //id для удаления товара из корзины
            $products[] = $product;
            $i++;
        }
        if ($total) {
            return count($products);
        }

        return $products;
    }
}