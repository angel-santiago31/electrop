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
use backend\models\PaymentMethod;
use backend\models\PaymentMethodSearch;
use common\models\Customer;
use backend\models\ShippingAddress;
use backend\models\ShippingAddressSearch;
use yii\helpers\ArrayHelper;
use backend\models\Order;
use backend\models\Contains;
use backend\models\Shipper;

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
                    'title' => 'Query Featured',
                    'showSeparator' => true,
                    'body' => $sql,
                    'pluginOptions' => [
                            'placement' => [
                                'from' => 'top',
                                'align' => 'right',
                            ]
                        ]
                ]);

        $carousel = Item::find()->limit(5)->offset(10)->where(['active' => Item::ACTIVE])->all();
        $sql_query = "SELECT * FROM item WHERE active = 1 LIMIT 5 OFFSET 10";
         Yii::$app->getSession()->setFlash('carousel', [
                    'type' => 'success',
                    'duration' => 5000,
                    'icon' => 'glyphicon glyphicon-ok-sign',
                    'title' => 'Query Carousel',
                    'message' => $sql_query,
                    'positonY' => 'top',
                    'positonX' => 'right'
                    ]);

        return $this->render('index', [
            'stickerList' => $stickerList,
            'carousel' => $carousel,
        ]);
    }

     /**
     * Action to show the payment method and shipping address selection before placing order.
     */

    public function actionPlaceorder()
    {

        $card = '';

        /*
            Get the current customer.
        */
        $customer = $this->findModel(Yii::$app->user->identity->getId());

        /*
            Get the current customer's payment methods (credit cards).
        */
        $customer_payment_method = $this->findPaymentMethod($customer->id);
        $searchModelPay = new PaymentMethodSearch();

        $cards = $searchModelPay->search(Yii::$app->request->queryParams, $customer->id);

        $query_statement ="SELECT * FROM payment_method WHERE customer_id = $customer->id";
        Yii::$app->getSession()->setFlash('payment_success', [
            'type' => 'success',
            'duration' => 5000,
            'icon' => 'glyphicon glyphicon-ok-sign',
            'title' => 'Query',
            'message' => $query_statement,
            'positonY' => 'top',
            'positonX' => 'right'
            ]);

         /*
            Get the current customer's shipping addresses.
        */

        $customer_shipping_address = $this->findShippingAddress($customer->id);
        $sql = "SELECT *
                FROM `shipping_address`
                WHERE customer_id = " . $customer->id;

        $address = ShippingAddress::findBySql($sql)->all();

        $value = ArrayHelper::map($address, 'street_name', 'street_name');

        $sql_statement ="SELECT * FROM shipping_address WHERE customer_id = $customer->id";
        Yii::$app->getSession()->setFlash('shipping_success', [
            'type' => 'success',
            'duration' => 5000,
            'icon' => 'glyphicon glyphicon-ok-sign',
            'title' => 'Query',
            'message' => $sql_statement,
            'positonY' => 'top',
            'positonX' => 'right'
            ]);

         /*
            Create a new Order.
        */

        //create order
        $order = new Order();

        if($order->load(Yii::$app->request->post()))
        {
            $order->amount_stickers = Yii::$app->cart->getCount();
            $order->total_price = Yii::$app->cart->getCost();
            $order->order_status = Order::PENDING;
            $order->customer_id = Yii::$app->user->identity->id;
            $order->shipper_company_name = Shipper::UPS;
            $order->tracking_number = rand(1000,9000);

            $sql_statement ="INSERT INTO order(order_number, order_date, \namount_stickers, total_price, \norder_status, customer_id, \nshipper_company_name, tracking_number, \npayment_method, shipping_address) VALUES($order->order_number, $order->order_date, \n$order->amount_stickers, $order->total_price, \n$order->order_status, $order->customer_id, \n$order->shipper_company_name, $order->tracking_number, $order->payment_method, $order->shipping_address)";
                 Yii::$app->getSession()->setFlash('creating', [
                    'type' => 'success',
                    'duration' => 5000,
                    'icon' => 'glyphicon glyphicon-ok-sign',
                    'title' => 'Query',
                    'showSeparator' => true,
                    'message' => $sql_statement,
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);

            if ($order->save()) {
              //asociate items to created order
              $positions = Yii::$app->cart->positions;

              foreach($positions as $position) {
                  $sticker = new Contains();
                  $sticker->order_number = $order->order_number;
                  $sticker->item_id = $position->id;
                  $sticker->price_sold = $position->gross_price;
                  $sticker->quantity_in_order = $position->quantity;

                  $sql_query ="INSERT INTO contains(order_number, item_id, \nprice_sold, quantity_in_order) VALUES($sticker->order_number, $sticker->item_id , \n$sticker->price_sold , $sticker->quantity_in_order)";
                  Yii::$app->getSession()->setFlash('created', [
                     'type' => 'success',
                     'duration' => 5000,
                     'icon' => 'glyphicon glyphicon-ok-sign',
                     'title' => 'Query',
                     'showSeparator' => true,
                     'message' => $sql_query,
                     'positonY' => 'top',
                     'positonX' => 'right'
                  ]);
                  $sticker->save();
              }

              Yii::$app->cart->removeAll();
              Yii::$app->getSession()->setFlash('success', [
                    'type' => 'success',
                    'duration' => 5000,
                    'icon' => 'glyphicon glyphicon-ok-sign',
                    'title' => 'YASS!',
                    'message' => 'Your order was placed successfully!',
                    'positonY' => 'top',
                    'positonX' => 'right'
                    ]);
              return $this->redirect(['customer/view-order', 'id' => $order->order_number, 'user' => $customer->id]);
          }

          Yii::$app->getSession()->setFlash('warning', [
                    'type' => 'warning',
                    'duration' => 5000,
                    'icon' => 'glyphicon glyphicon-ok-sign',
                    'title' => 'WARNING',
                    'message' => 'Your order could not be placed. Please try again or contact our administrators.',
                    'positonY' => 'top',
                    'positonX' => 'right'
                    ]);
            return $this->redirect(['placeorder']);
        }


        return $this->render('placeorder', ['payment_method' => $customer_payment_method, 'cards' => $cards, 'model' => $order, 'shipping_address' => $customer_shipping_address, 'address' => $address, 'value' => $value]);
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
     * Search items by name.
     */

    public function actionStickersSearch()
    {
        $model = new Item();

        // echo '<pre>';
        // var_dump($searchModel);
        // die(1);

        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->nameSearch == ""){

            $stickerList = Item::find()->where(['>=', 'quantity_remaining', 1])->all();
            $sql ="SELECT * FROM item WHERE quantity_remaining >= 1";
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
            } else {
                $stickerList = Item::find()->where([ 'like', 'name', $model->nameSearch])->andWhere(['>=', 'quantity_remaining', 1])->all();
                $sql ="SELECT * FROM item WHERE name LIKE %$model->nameSearch% AND quantity_remaining >= 1";
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
            }
        }

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

    /**
     * Finds the Customer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Customer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the Customer's payment method model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customer's phone number the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findPaymentMethod($id)
    {
        // $sql = PaymentMethod::find()->where([ '==', 'customer_id', $id])->andWhere([ '==', 'card_last_digits', $numbers])->One();
        // echo '<pre>';
        // var_dump($id);
        // die("f i n d i n g  . . . ");
        if (($model = PaymentMethod::findOne($id)) !== null) {

            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the Customer's payment method model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customer's phone number the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findShippingAddress($id)
    {
        if (($model = ShippingAddress::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
