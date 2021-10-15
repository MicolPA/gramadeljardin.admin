<?php
namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\Clientes;
use frontend\models\Transacciones;
use yii\web\UploadedFile;
use frontend\models\ContactForm;
use frontend\models\Eventos;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    // [
                    //     'actions' => ['signup'],
                    //     'allow' => true,
                    //     'roles' => ['?'],
                    // ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    // 'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    function isLogin(){
        
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */

    public function actionIndex()
    {
        
        return $this->redirect(['/clientes']);
    }
    // public function actionIndex()
    // {

    //     $fecha = date("m",strtotime(date("d-m-Y")." - 30 days")); 
    //     $clientes = Clientes::find()->where(['>=', 'fecha_comienzo', $fecha])->count();
    //     $transacciones = Transacciones::find()->orderBy(['fecha_pago' => SORT_DESC, 'tipo_id' => SORT_DESC])->limit(5)->all();
    //     $servicios = \frontend\models\Servicios::find()->all();
    //     return $this->render('index',[
    //         'clientes' => $clientes,
    //         'servicios' => $servicios,
    //         'transacciones' => $transacciones,
    //     ]);
    // }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $this->layout = '@app/views/layouts/main-no-menu';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['/clientes']);
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(['login']);
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $this->isLogin();
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup($admin=0)
    {
        if ($admin) {
            $this->layout = '@app/views/layouts/main-no-menu';
        }
        //$this->isLogin();
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {

            // $path ='images/usuarios/';
            // $model->photo_url = UploadedFile::getInstance($model, 'photo_url');
            // $imagen = $path . 'usuario-' .$model->username . "." . $model->photo_url->extension;
            // $model->photo_url->saveAs($imagen);
            // $model->photo_url = $imagen;

            $model->signup();
            // print_r($model->errors);
            // exit;

            Yii::$app->session->setFlash('success', 'Usuario registrado correctamente');
            return $this->redirect(['/user']);
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $this->isLogin();
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }

    public function actionPoliticasPrivacidad(){
        $this->layout = '@app/views/layouts/main-no-menu';
        return $this->render('politicas_privacidad', [
        ]);
    }

    public function actionGuardarEvento(){

        // if (Yii::$app->request->isAjax) {

            $post = Yii::$app->request->get();
            $day = substr($post['fecha'], -2);
            $month = substr($post['fecha'], 4,6);
            $year = substr($post['fecha'], 4,6);
            $fecha = date("Y-m-d", strtotime($post['fecha']));

            $evento = new Eventos();
            $evento->cliente_id = $post['cliente_id'];
            $evento->nombre = $post['nombre'];
            // $evento->event_date = $fecha . $post['time'];
            $evento->event_date = $fecha;
            $evento->hora = $post['time'];
            $evento->user_id = Yii::$app->user->identity->id;
            $evento->date = date("Y-m-d H:i:s");
            $evento->save(false);

            
            $event_data['nombre'] = $evento->nombre;
            $event_data['fecha'] = $evento->event_date;
            return \yii\helpers\Json::encode($event_data);
        // }

    }

    public function actionBorrarEvento($id){
        $evento = Eventos::findOne($id);
        if ($evento) {
            $evento->delete();
        }
        return $this->redirect(Yii::$app->request->referrer); 
    }
}
