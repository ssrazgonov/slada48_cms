<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $title
 * @property string $vendor_code
 * @property int $cat_id
 * @property double $price
 * @property int $price_type_id
 * @property string $description
 * @property string $prod_img
 * @property string $prod_slug
 * @property int $qty_type
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
            [['cat_id', 'price_type_id'], 'integer'],
            [['price'], 'number'],
//            ['prod_img', 'required'],
            [['title', 'vendor_code', 'description', 'prod_img'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Тайтл',
            'vendor_code' => 'Артикль',
            'cat_id' => 'ID категории',
            'price' => 'Цена',
            'price_type_id' => 'Тип цены',
            'description' => 'Описание',
            'prod_img' => 'Картинка',
        ];
    }

    public function getProductOption() {
        return $this->hasMany(ProductOption::className(), ['id' => 'product_option_id'])
            ->viaTable('product_option_rel', ['product_id' => 'id']);
    }

    public function getCategory()
    {
        return $this->hasOne(ProductCategory::className(), ['id' => 'cat_id']);
    }

    public function getPriceType()
    {
        return $this->hasOne(PriceType::className(), ['id' => 'price_type_id']);
    }
}
