<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "shop_goodies".
 *
 * @property int $id
 * @property int $id2
 * @property int $id3
 * @property int $prov_id
 * @property string $title
 * @property string $model
 * @property string $image
 * @property string $anonce
 * @property string $content
 * @property int $vendor_id
 * @property string $ondate
 * @property string $pubdate
 * @property string $enddate
 * @property int $new
 * @property int $selected
 * @property int $stored
 * @property double $rate
 * @property double $price
 * @property string $price_comment
 * @property int $enabled
 * @property int $variant
 * @property int $custom
 * @property int $orderable
 * @property int $ord
 * @property int $inmain
 * @property int $sold
 * @property double $discount
 * @property double $price_add
 * @property int $views
 * @property string $lastorder
 * @property string $additional_tags
 */
class ShopGoodies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_goodies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id2', 'id3', 'prov_id', 'vendor_id', 'new', 'selected', 'stored', 'enabled', 'variant', 'custom', 'orderable', 'ord', 'inmain', 'sold', 'views'], 'integer'],
            [['prov_id'], 'required'],
            [['anonce', 'content', 'additional_tags'], 'string'],
            [['ondate', 'pubdate', 'enddate', 'lastorder'], 'safe'],
            [['rate', 'price', 'discount', 'price_add'], 'number'],
            [['title', 'model', 'image', 'price_comment'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id2' => 'Id2',
            'id3' => 'Id3',
            'prov_id' => 'Prov ID',
            'title' => 'Title',
            'model' => 'Model',
            'image' => 'Image',
            'anonce' => 'Anonce',
            'content' => 'Content',
            'vendor_id' => 'Vendor ID',
            'ondate' => 'Ondate',
            'pubdate' => 'Pubdate',
            'enddate' => 'Enddate',
            'new' => 'New',
            'selected' => 'Selected',
            'stored' => 'Stored',
            'rate' => 'Rate',
            'price' => 'Price',
            'price_comment' => 'Price Comment',
            'enabled' => 'Enabled',
            'variant' => 'Variant',
            'custom' => 'Custom',
            'orderable' => 'Orderable',
            'ord' => 'Ord',
            'inmain' => 'Inmain',
            'sold' => 'Sold',
            'discount' => 'Discount',
            'price_add' => 'Price Add',
            'views' => 'Views',
            'lastorder' => 'Lastorder',
            'additional_tags' => 'Additional Tags',
        ];
    }
}
