<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $user_id
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property double $amount
 * @property int $payment_method
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'status', 'payment_method'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['amount'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'ID пользователя',
            'status' => 'Статус',
            'created_at' => 'Когда создан',
            'updated_at' => 'Когда редактировался',
            'amount' => 'Общая сумма заказа',
            'payment_method' => 'Выбранный метод оплаты',
        ];
    }

    public function getOrderProduct()
    {
        return $this->hasMany(OrderProduct::className(), ['order_id' => 'id']);
    }

    public function getOrderStatus()
    {
        return $this->hasOne(OrderStatus::className(), ['code' => 'status']);

    }

    public function getPaymentMethod()
    {
        return $this->hasOne(PaymentMehtod::className(), ['id' => 'payment_method']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(),['id' => 'user_id']);
    }
}
