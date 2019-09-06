<?php


namespace frontend\controllers;

use common\models\Auction;
use common\models\Product;
use common\models\Bid;
use common\models\User;
use yii\web\Controller;
use Yii;

class AuctionController extends Controller
{
    public function actionIndex() {

        $auction = Auction::find()->where(['active' => 1])->one();
        $active = true;

        if (time() >= strtotime($auction->end_date)) {
            $active = false;
        }

        return $this->render('index', compact('auction','active'));
    }

    public function actionGetExpired() {
        $auction = Auction::find()->where(['active' => 1])->one();
        $active = true;
        return $this->renderPartial('_expired', compact('auction', 'active'));
    }

    public function actionMakeBid() {

        if (!Yii::$app->user->isGuest) {

            $bid = new Bid();
            $auction = Auction::findOne(Yii::$app->request->post('Auction'));
            $prev_winner = $auction->winner;

            if (time() >= strtotime($auction->end_date)) {
                Yii::$app->session->setFlash('error', 'Аукцион закончен');
                return $this->redirect(['auction/index']);
            }

            if($auction->winner->id == Yii::$app->user->id) {
                Yii::$app->session->setFlash('error', 'Вы уже сделали ставку');
                return $this->redirect(['auction/index']);
            }

            $bid->auc_id = $auction->id;
            $bid->bid = $auction->bid_current + $auction->bid_step;
            $bid->bidder_id = Yii::$app->user->id;

            if (!$bid->save()) {
                Yii::$app->session->setFlash('error', $bid->errors);
                return $this->redirect(['auction/index']);
            }

            $auction->winner_bid_id = $bid->id;
            $auction->bid_current = $bid->bid;

            if(!$auction->save()) {
                Yii::$app->session->setFlash('error', $auction->errors);
                return $this->redirect(['auction/index']);
            }

            Auction::sendEmail($prev_winner);
            Yii::$app->session->setFlash('success', 'Ваша ставка принята');
            return $this->redirect(['auction/index']);
        } else {
            Yii::$app->session->setFlash('error', 'Только зарегистрированный пользователь может учавствовать в аукционе');
            return $this->redirect(['auction/index']);
        }
    }
}