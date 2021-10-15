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
    public $role_id;
    public $first_name;
    public $last_name;
    public $photo_url;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este nombre de usuario ya existe'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            [['first_name', 'last_name'], 'required'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este correo ya existe'],

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

        // if (!$this->validateUser) {
        //     return null;
        // }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->photo_url = $this->photo_url;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->role_id = 1;
        $user->status = 10;
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        return $user->save();
        //&& $this->sendEmail($user);

    }

    public function validateUser(){
        $user = User::find()->where(['username' => $this->username])->one();
        if ($user) {
            Yii::$app->session->setFlash('error', 'Este nombre de usuario ya existe');
            return false;
        }
        $user = User::find()->where(['username' => $this->username])->one();
        if ($user) {
            Yii::$app->session->setFlash('error', 'Este correo ya existe');
            return false;
        }
        return true;
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
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
