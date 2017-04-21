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
              Yii::$app->getSession()->setFlash('info', [
                    'type' => 'info',
                    'duration' => 5000,
                    'icon' => 'glyphicon glyphicon-ok-sign',
                    'title' => 'REMINDER',
                    'message' => 'Your must be logged in before placing an order.',
                    'positonY' => 'top',
                    'positonX' => 'right'
                    ]);
              return $this->redirect(['site/login']);
          }

          //create order
          $order = new Order();
          $order->amount_stickers = Yii::$app->cart->getCount();
          $order->total_price = Yii::$app->cart->getCost();
          $order->order_status = Order::PENDING;
          $order->customer_id = Yii::$app->user->identity->id;
          $order->shipper_company_name = Shipper::UPS;
          $order->tracking_number = rand(1000,9000);

          $sql_statement ="INSERT INTO order(order_number, order_date, \namount_stickers, total_price, \norder_status, customer_id, \nshpper_company_name, tracking_number) VALUES($order->order_number, $order->order_date, \n$order->amount_stickers, $order->total_price, \n$order->order_status, $order->customer_id, \n$order->shipper_company_name, $order->tracking_number)";
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

                  //decrease inventory quantity
                  $item = $this->findModel($sticker->item_id);
                  $item->quantity_remaining -= $sticker->quantity_in_order;
                  $item->save();

                  $query ="UPDATE item SET quantity_remaining = $item->quantity_remaining WHERE id = $sticker->item_id";
                  Yii::$app->getSession()->setFlash('updated', [
                     'type' => 'success',
                     'duration' => 5000,
                     'icon' => 'glyphicon glyphicon-ok-sign',
                     'title' => 'Query',
                     'showSeparator' => true,
                     'message' => $query,
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
              return $this->redirect(['site/stickers']);
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

        Yii::$app->getSession()->setFlash('warning', [
                    'type' => 'warning',
                    'duration' => 5000,
                    'icon' => 'glyphicon glyphicon-ok-sign',
                    'title' => 'WARNING',
                    'message' => 'An error occured. Please try again or contact our administrators.',
                    'positonY' => 'top',
                    'positonX' => 'right'
                    ]);
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDetails($id)
    {
        $model = Item::findOne($id);

        $sql ="SELECT * FROM item WHERE id = $id";
        Yii::$app->getSession()->setFlash('success', [
            'type' => 'success',
            'duration' => 5000,
            'icon' => 'glyphicon glyphicon-ok-sign',
            'title' => 'Query',
            'message' => $sql,
            'positonY' => 'top',
            'positonX' => 'right'
            ]);
                

        if ($model->load(Yii::$app->request->post())) {
            $cart = Yii::$app->cart;
            $cart->put($model, $model->quantity);

            return $this->redirect(['cart-view']);
        }

        $model->quantity = 1;
        return $this->render('details', ['model' => $model]);
    }
}
