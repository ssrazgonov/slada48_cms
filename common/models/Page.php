<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "page".
 *
 * @property int $id
 * @property string $title
 * @property string $keywords
 * @property string $description
 * @property string $content
 * @property int $parent_id
 * @property int $sort
 */
class Page extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'keywords', 'description', 'content'], 'required'],
            [['content'], 'string'],
            [['parent_id', 'sort'], 'integer'],
            [['title', 'keywords', 'description'], 'string', 'max' => 255],
            ['page_slug', 'unique']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок страницы',
            'keywords' => 'Ключевые слова',
            'description' => 'Описание (мета)',
            'content' => 'Контент',
            'parent_id' => 'ID родительской категории',
            'sort' => 'Сортировка внутри категории',
        ];
    }

    public function getPageCategory()
    {
        return $this->hasOne(PageCategory::className(), ['id' => 'parent_id']);
    }
}
