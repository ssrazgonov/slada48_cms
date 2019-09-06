<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bid".
 *
 * @property int $id
 * @property int $auc_id
 * @property int $bid
 * @property int $bidder_id
 */
class Bid extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bid';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['auc_id', 'bid', 'bidder_id'], 'required'],
            [['auc_id', 'bid', 'bidder_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'auc_id' => 'Auc ID',
            'bid' => 'Bid',
            'bidder_id' => 'Bidder ID',
        ];
    }

    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'bidder_id']);
    }
}
