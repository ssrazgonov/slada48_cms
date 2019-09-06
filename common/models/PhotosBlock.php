<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "photos_block".
 *
 * @property int $id
 * @property string $created
 * @property int $qitems
 * @property int $qmax
 * @property int $owner_id
 * @property int $use_selecting
 * @property int $use_enabling
 * @property int $use_pubdating
 * @property int $use_keywords
 * @property int $blocked
 * @property string $ordfield
 * @property string $orddir
 * @property int $def_enabled
 * @property int $def_selected
 * @property int $use_title
 * @property int $use_anonce
 * @property int $use_content
 * @property int $use_url2
 * @property int $use_ord
 */
class PhotosBlock extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'photos_block';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created'], 'required'],
            [['created'], 'safe'],
            [['qitems', 'qmax', 'owner_id', 'use_selecting', 'use_enabling', 'use_pubdating', 'use_keywords', 'blocked', 'def_enabled', 'def_selected', 'use_title', 'use_anonce', 'use_content', 'use_url2', 'use_ord'], 'integer'],
            [['ordfield', 'orddir'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created' => 'Created',
            'qitems' => 'Qitems',
            'qmax' => 'Qmax',
            'owner_id' => 'Owner ID',
            'use_selecting' => 'Use Selecting',
            'use_enabling' => 'Use Enabling',
            'use_pubdating' => 'Use Pubdating',
            'use_keywords' => 'Use Keywords',
            'blocked' => 'Blocked',
            'ordfield' => 'Ordfield',
            'orddir' => 'Orddir',
            'def_enabled' => 'Def Enabled',
            'def_selected' => 'Def Selected',
            'use_title' => 'Use Title',
            'use_anonce' => 'Use Anonce',
            'use_content' => 'Use Content',
            'use_url2' => 'Use Url2',
            'use_ord' => 'Use Ord',
        ];
    }
}
