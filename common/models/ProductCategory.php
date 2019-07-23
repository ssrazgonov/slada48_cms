<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_category".
 *
 * @property int $id
 * @property string $title
 * @property int $parent_id
 * @property string $cat_img
 * @property string $description
 * @property string $cat_slug
 */
class ProductCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['description'], 'string'],
            [['title', 'cat_img', 'cat_slug'], 'string', 'max' => 255],
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
            'parent_id' => 'ID Родительской категории',
            'cat_img' => 'Изображение',
            'description' => 'Описание',
            'cat_slug' => 'Ярлык',
        ];
    }

    public function getProductCount()
    {
        return count(Product::find()->where(['cat_id' => $this->id])->asArray()->all());
    }

    public function getCategory()
    {
        return $this->hasOne(ProductCategory::className(), ['id' => 'parent_id']);
    }
}
