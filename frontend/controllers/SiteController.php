<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use backend\models\Item;
use backend\models\ItemSearch;
use kartik\growl\Growl;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
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
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
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

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $stickerList = Item::find()->limit(6)->offset(0)->where(['active' => Item::ACTIVE])->all();
         $sql ="SELECT * FROM item WHERE active = 1 LIMIT 6";
           echo Growl::widget([
                    'type' => Growl::TYPE_SUCCESS,
                    'icon' => 'glyphicon glyphicon-ok-sign',
                    'title' => 'Query',
                    'showSeparator' => true,
                    'body' => $sql,
                    'pluginOptions' => [
                            'placement' => [
                                'from' => 'top',
                                'align' => 'right',
                            ]
                        ]
                ]);  
        return $this->render('index', [
            'stickerList' => $stickerList,
        ]);
    }

    public function actionStickers($category = NULL, $subcategory = NULL)
    {
        $model = new Item();

        if ($model->load(Yii::$app->request->post()) && $category == NULL && $subcategory == NULL) {
            
            $stickerList = Item::find()->where(['item_category_id' => $model->item_category_id,
                                                'item_sub_category_id' => $model->item_sub_category_id,
                                                'active' => Item::ACTIVE])->andWhere(['>=', 'quantity_remaining', 1])->all();

             $sql ="SELECT * FROM item WHERE item_category_id = '$model->item_category_id' and item_sub_category_id = '$model->item_sub_category_id' and active = 1 and quantity_remaining >= 1";
            echo Growl::widget([
                    'type' => Growl::TYPE_SUCCESS,
                    'icon' => 'glyphicon glyphicon-ok-sign',
                    'title' => 'Query',
                    'showSeparator' => true,
                    'body' => $sql,
                    'pluginOptions' => [
                            'showProgressbar' => true,
                            'placement' => [
                                'from' => 'top',
                                'align' => 'right',
                            ]
                        ]
                ]);

             return $this->render('stickers', [
                 'model' => $model,
                 'stickerList' => $stickerList,
             ]);
        } else if ($category != NULL && $subcategory != NULL) {
            $stickerList = Item::find()->where(['item_category_id' => $category,
                                                'item_sub_category_id' => $subcategory,
                                                'active' => Item::ACTIVE])->andWhere(['>=', 'quantity_remaining', 1])->all();
            $sql ="SELECT * FROM item WHERE item_category_id = '$category' and item_sub_category_id = '$subcategory' and active = '1'";
            echo Growl::widget([
                    'type' => Growl::TYPE_SUCCESS,
                    'icon' => 'glyphicon glyphicon-ok-sign',
                    'title' => 'Query',
                    'showSeparator' => true,
                    'body' => $sql,
                    'pluginOptions' => [
                            'showProgressbar' => true,
                            'placement' => [
                                'from' => 'top',
                                'align' => 'right',
                            ]
                        ]
                ]);
             return $this->render('stickers', [
                 'model' => $model,
                 'stickerList' => $stickerList,
             ]);
        }


        $stickerList = Item::find()->where(['active' => Item::ACTIVE])->andWhere(['>=', 'quantity_remaining', 1])->all();
        $sqlQuery = "SELECT * FROM item WHERE active = 1 AND quantity_remaining >= 1";
        //$stickerList = Yii::$app->db->createCommand($sqlQuery)->queryAll();
         echo Growl::widget([
                'type' => Growl::TYPE_SUCCESS,
                'icon' => 'glyphicon glyphicon-ok-sign',
                'title' => 'Query',
                'showSeparator' => true,
                'body' => $sqlQuery,
                 'pluginOptions' => [
                        'showProgressbar' => true,
                        'placement' => [
                            'from' => 'top',
                            'align' => 'right',
                        ]
                    ]
            ]);

        return $this->render('stickers', [
            'model' => $model,
            'stickerList' => $stickerList,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
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

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
            
                Yii::$app->getSession()->setFlash('success', [
                    'type' => 'success',
                    'duration' => 5000,
                    'icon' => 'glyphicon glyphicon-ok-sign',
                    'title' => 'MADE IT',
                    'message' => 'Thank you for contacting us. We will respond to you as soon as possible.',
                    'positonY' => 'top',
                    'positonX' => 'right'
                    ]);
            } else {
                Yii::$app->getSession()->setFlash('error', [
                    'type' => 'error',
                    'duration' => 5000,
                    'icon' => 'glyphicon glyphicon-ok-sign',
                    'title' => 'Oh Oh...',
                    'message' => 'There was an error sending your message.',
                    'positonY' => 'top',
                    'positonX' => 'right'
                    ]);
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
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
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
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', [
                    'type' => 'success',
                    'duration' => 5000,
                    'icon' => 'glyphicon glyphicon-ok-sign',
                    'title' => 'MADE IT',
                    'message' => 'Check your email for further instructions.',
                    'positonY' => 'top',
                    'positonX' => 'right'
                    ]);

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', [
                    'type' => 'error',
                    'duration' => 5000,
                    'icon' => 'glyphicon glyphicon-ok-sign',
                    'title' => 'Oh Oh...',
                    'message' => 'Sorry, we are unable to reset password for the provided email address.',
                    'positonY' => 'top',
                    'positonX' => 'right'
                    ]);
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
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', [
                    'type' => 'success',
                    'duration' => 5000,
                    'icon' => 'glyphicon glyphicon-ok-sign',
                    'title' => 'MADE IT',
                    'message' => 'New password saved.',
                    'positonY' => 'top',
                    'positonX' => 'right'
                    ]);

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

}
