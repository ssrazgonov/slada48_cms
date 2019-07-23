<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "qty_preset".
 *
 * @property int $id
 * @property string $name
 */
class QtyPreset extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'qty_preset';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
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
        ];
    }

    public function getQtyItems()
    {
        return $this->hasMany(QtyValue::className(), ['id' => 'qty_value_id'])->viaTable('qty_rel', ['qty_preset_id' => 'id']);
    }

}
