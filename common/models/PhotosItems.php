<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "photos_items".
 *
 * @property int $id
 * @property int $prov_id
 * @property int $owner_id
 * @property string $ondate
 * @property string $pubdate
 * @property int $enabled
 * @property int $selected
 * @property string $keywords
 * @property int $ord
 * @property string $title
 * @property string $anonce
 * @property string $content
 * @property string $url
 * @property string $url2
 * @property string $alt
 * @property string $options
 */
class PhotosItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'photos_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prov_id', 'title', 'url'], 'required'],
            [['prov_id', 'owner_id', 'enabled', 'selected', 'ord'], 'integer'],
            [['ondate', 'pubdate'], 'safe'],
            [['anonce', 'content', 'options'], 'string'],
            [['keywords', 'title', 'url', 'url2', 'alt'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'prov_id' => 'Prov ID',
            'owner_id' => 'Owner ID',
            'ondate' => 'Ondate',
            'pubdate' => 'Pubdate',
            'enabled' => 'Enabled',
            'selected' => 'Selected',
            'keywords' => 'Keywords',
            'ord' => 'Ord',
            'title' => 'Title',
            'anonce' => 'Anonce',
            'content' => 'Content',
            'url' => 'Url',
            'url2' => 'Url2',
            'alt' => 'Alt',
            'options' => 'Options',
        ];
    }
}
