<?php
namespace frontend\models;

use common\models\Auction;
use yii\base\Model;

class AuctionForm extends Model {
    public $bid;
    public $aucId;

    public function rules()
    {
        return [
            ['aucId', 'integer'],
            ['bid', 'validateBid']
        ];
    }

    public function validateBid($attribute, $params, $validator)
    {
        $auction = Auction::findOne($this->aucId);

        if ($this->$attribute < ($auction->bid_current + $auction->bid_min)) {
            $this->addError($attribute, 'Ставка должна быть больше или равна ' . ($auction->bid_current + $auction->bid_min));
        }

        if ($this->$attribute > ($auction->bid_current + $auction->bid_max)) {
            $this->addError($attribute, 'Ставка должна быть меньше или равна ' . ($auction->bid_current + $auction->bid_max));
        }
    }

}