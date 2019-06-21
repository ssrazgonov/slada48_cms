<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $title
 * @property int $cat_id
 * @property double $price
 * @property string $description
 * @property string $prod_img
 * @property string $prod_slug
 * @property string $article
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cat_id'], 'integer'],
            [['price'], 'number'],
            [['title', 'description', 'prod_img', 'prod_slug', 'article'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'cat_id' => 'Cat ID',
            'price' => 'Price',
            'description' => 'Description',
            'prod_img' => 'Prod Img',
            'prod_slug' => 'Prod Slug',
            'article' => 'Артикуль',
        ];
    }

    public function getProductOption() {
        return $this->hasMany(ProductOption::className(), ['id' => 'product_option_id'])
            ->viaTable('product_option_rel', ['product_id' => 'id']);
    }
}
