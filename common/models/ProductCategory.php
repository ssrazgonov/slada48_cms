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
            'title' => 'Title',
            'parent_id' => 'Parent ID',
            'cat_img' => 'Cat Img',
            'description' => 'Description',
            'cat_slug' => 'Cat Slug',
        ];
    }
}
