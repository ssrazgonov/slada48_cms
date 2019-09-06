<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_option_rel".
 *
 * @property int $id
 * @property int $product_id
 * @property int $product_option_id
 */
class ProductOptionRel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_option_rel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id'], 'integer'],
            [['product_option_id'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'product_option_id' => 'Product Option ID',
        ];
    }
}
