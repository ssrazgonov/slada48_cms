<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "auction".
 *
 * @property int $id
 * @property int $product_id
 * @property string $start_date
 * @property string $end_date
 * @property int $active
 * @property int $winner_bid_id
 * @property int $bid_current
 * @property int $bid_step
 */
class Auction extends \yii\db\ActiveRecord
{

    public static $STATUS_INACTIVE = 0;
    public static $STATUS_ACTIVE = 1;
    public static $STATUS_END = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auction';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['start_date', 'end_date', 'active', 'bid_step', 'auc_title', 'auc_text'], 'required'],
            [['auc_img'], 'file', 'extensions' => 'png, jpg'],
            [['product_id', 'active', 'winner_bid_id', 'bid_current', 'bid_step'], 'integer'],
            [['start_date', 'end_date', 'winner_bid_id', 'bid_current', 'product_option_id', 'auc_img'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'start_date' => 'Дата старта',
            'end_date' => 'Дата окончания',
            'active' => 'Актвность',
            'winner_bid_id' => 'Победившая ставка',
            'bid_current' => 'Текущая цена',
            'bid_step' => 'Шаг аукциона',
            'auc_img' => 'Картинка товара'
        ];
    }

    public function getBids() {
        return $this->hasMany(Bid::className(), ['auc_id' => 'id']);
    }

    public function getProduct() {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    public function getProductOption() {
        return $this->hasOne(ProductOption::className(), ['id' => 'product_option_id']);
    }

    public function getWinner() {
        return $this->hasOne(User::className(), ['id' => 'bidder_id'])->viaTable('bid', ['id' => 'winner_bid_id']);
    }

    public function getWinBid() {
        return $this->hasOne(Bid::className(), ['id' => 'winner_bid_id']);
    }

    public static function sendEmail($user) {

        $result = Yii::$app->mailer->compose()
            ->setFrom('from@domain.com')
            ->setTo($user->email)
            ->setSubject('Слада48, ваша ставка перебита')
            ->setTextBody('Ваша ставка перебита')
//            ->setHtmlBody('<b>текст сообщения в формате HTML</b>')
            ->send();

        return $result;
    }
}
