<?php

namespace frontend\controllers;

use Yii;
use backend\models\Item;
use backend\models\ItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use backend\models\Order;
use backend\models\Contains;
use backend\models\Shipper;
use common\models\Customer;

/**
 * ItemController implements the CRUD actions for Item model.
 */
class ItemController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    /**
     * Displays a single Item model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    /**
     * Finds the Item model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Item the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Item::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     *
     *
     * @return
     */
     public function actionCartView()
     {
        $itemsCount = \Yii::$app->cart->getCount();
        $total = \Yii::$app->cart->getCost();

        return $this->render('cart-view', [
            'itemsCount' => $itemsCount,
             'total' => $total,
             ]);
     }

     /**
     * Create order and asociate items to the created order
     */
     public function actionCheckout()
     {
          //if user is guest, redirect him/her to log in page
          if (Yii::$app->user->isGuest) {
              Yii::$app->getSession()->setFlash('info', 'Your must be logged in before placing an order.');

              return $this->redirect(['site/login']);
          }

          //if user has no payment method, redirect him/her to update page
          if (Yii::$app->user->identity->getPaymentMethod() == NULL) {
              Yii::$app->getSession()->setFlash('info', 'You must have a payment method before placing an order.');

              return $this->redirect(['customer/account', 'id' => Yii::$app->user->identity->id]);
          }

          //create order
          $order = new Order();
          $order->amount_stickers = Yii::$app->cart->getCount();
          $order->total_price = Yii::$app->cart->getCost();
          $order->order_status = Order::PENDING;
          $order->customer_id = Yii::$app->user->identity->id;
          $order->shipper_company_name = Shipper::UPS;
          $order->tracking_number = rand(1000,9000);

          if ($order->save()) {
              //asociate items to created order
              $positions = Yii::$app->cart->positions;

              foreach($positions as $position) {
                  $sticker = new Contains();
                  $sticker->order_number = $order->order_number;
                  $sticker->item_id = $position->id;
                  $sticker->price_sold = $position->gross_price;
                  $sticker->quantity_in_order = $position->quantity;
                  $sticker->save();
              }

              Yii::$app->cart->removeAll();
              Yii::$app->getSession()->setFlash('success', 'Your order was placed successfully!');
              return $this->redirect(['site/stickers']);
          }

          Yii::$app->getSession()->setFlash('warning', 'Your order could not be placed. Please try again or contact our administrators.');
          return $this->redirect(Yii::$app->request->referrer);
     }

     /**
     *
     *
     * @return
     */
     public function actionCartRemove($id)
     {
        $cart = Yii::$app->cart;

        $model = Item::findOne($id);

        if ($model) {
            $cart->remove($model);

            return $this->redirect(['cart-view']);
        }

        throw new NotFoundHttpException();
     }

    /**
     *
     *
     * @return
     */
     public function actionCartEmpty($id)
     {
        $cart = Yii::$app->cart;

        if ($cart) {
            $cart->removeAll();

            return $this->redirect(['cart-view']);
        }

        throw new NotFoundHttpException();
     }

   /**
    *
    *
    */
    public function actionAddToCart($id, $amount)
    {
        $cart = Yii::$app->cart;

        $model = Item::findOne($id);
        if ($model) {
            $cart->put($model, $amount);

            return $this->redirect(['cart-view']);
        }

        Yii::$app->getSession()->setFlash('warning', 'An error occured. Please try again or contact our administrators.');
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDetails($id)
    {
        $model = Item::findOne($id);

        if ($model->load(Yii::$app->request->post())) {
            $cart = Yii::$app->cart;
            $cart->put($model, $model->quantity);

            return $this->redirect(['cart-view']);
        }

        $model->quantity = 1;
        return $this->render('details', ['model' => $model]);
    }
}
