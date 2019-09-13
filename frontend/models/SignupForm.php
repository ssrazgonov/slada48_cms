<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $policy;
    public $phone;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required', 'message' => 'Введите ваше Имя'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['policy', 'compare', 'compareValue' => 1, 'message' => 'Ознакомьтесь с политикой конфиденциальности и дайте согласие на обработку ваших персональных данных.'],

            ['phone', 'required', 'message' => 'Введите ваш номер телефона'],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Данный email уже зарегистрирован на сайте'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
		$user->status = 10;
        $user->generateEmailVerificationToken();
        $user->phone = $this->phone;
        return $user->save() && $this->sendEmail($user);

    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom(Yii::$app->params['supportEmail'])
            ->setTo($this->email)
            ->setSubject('Слада 48. Успешная регистрация ' . Yii::$app->name)
            ->send();
    }
}
