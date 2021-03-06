<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "menu_item".
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property int $parent_id
 * @property int $menu_id
 */
class MenuItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'menu_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['name', 'url'], 'required',],
            [['url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'url' => 'Url',
            'parent_id' => 'Parent ID',
            'menu_id' => 'Menu ID',
        ];
    }
}
