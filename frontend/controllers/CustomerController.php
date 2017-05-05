<?php

namespace frontend\controllers;

use Yii;
use common\models\Customer;
use common\models\CustomerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\PhoneNumber;
use backend\models\ShippingAddress;
use backend\models\PaymentMethod;
use backend\models\Order;
use backend\models\OrderSearch;
use backend\models\Contains;
use backend\models\ContainsSearch;
use kartik\growl\Growl;

/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends Controller
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
     * Lists all Customer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Customer model.
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
     * Displays a single Customer model.
     * @param integer $id
     * @return mixed
     */
    public function actionAccount($id)
    {
        $customer = $this->findModel($id);

        $sql ="SELECT * FROM customer WHERE id = $id";
        Yii::$app->getSession()->setFlash('success', [
            'type' => 'success',
            'duration' => 5000,
            'icon' => 'glyphicon glyphicon-ok-sign',
            'title' => 'Query',
            'message' => $sql,
            'positonY' => 'top',
            'positonX' => 'right'
            ]);

        $customer_phone = $this->findPhone($customer->id);

        $statement ="SELECT * FROM phone_number WHERE customer_id = $customer->id";
        Yii::$app->getSession()->setFlash('phone_success', [
            'type' => 'success',
            'duration' => 5000,
            'icon' => 'glyphicon glyphicon-ok-sign',
            'title' => 'Query',
            'message' => $statement,
            'positonY' => 'top',
            'positonX' => 'right'
            ]);

        $customer_shipping_address = $this->findShippingAddress($customer->id);

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
        $customer_payment_method = $this->findPaymentMethod($customer->id);

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

        $searchModel = new OrderSearch();

        $orders = $searchModel->search(Yii::$app->request->queryParams, $customer->id);

        $another_query ="SELECT * FROM order WHERE customer_id = $customer->id";
        Yii::$app->getSession()->setFlash('order_success', [
            'type' => 'success',
            'duration' => 5000,
            'icon' => 'glyphicon glyphicon-ok-sign',
            'title' => 'Query',
            'message' => $another_query,
            'positonY' => 'top',
            'positonX' => 'right'
            ]);

        $orders->pagination->pageSize = 4;

        return $this->render('account', [
            'model' => $customer,
            'phone' => $customer_phone,
            'shipping_address' => $customer_shipping_address,
            'payment_method' => $customer_payment_method,
            'orders' => $orders,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     */
    public function actionViewOrder($id, $user)
    {
        $order = $this->findOrder($id);
        $dataProvider = Contains::find()->where(['order_number' => $order->order_number])->all();

        $sql ="SELECT * FROM contains WHERE order_number = $order->order_number";
             Yii::$app->getSession()->setFlash('success', [
                'type' => 'success',
                'duration' => 5000,
                'icon' => 'glyphicon glyphicon-ok-sign',
                'title' => 'Query',
                'showSeparator' => true,
                'message' => $sql,
                'positonY' => 'top',
                'positonX' => 'right'
            ]);

        return $this->render('order', [
            'model' => $order,
            'order_items' => $dataProvider,
            'user' => $user,
        ]);
    }

    /**
     * Updates an existing Customer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $sql ="SELECT * FROM customer WHERE id = $id";
                 Yii::$app->getSession()->setFlash('updating', [
                    'type' => 'success',
                    'duration' => 5000,
                    'icon' => 'glyphicon glyphicon-ok-sign',
                    'title' => 'Query',
                    'showSeparator' => true,
                    'message' => $sql,
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $query ="UPDATE customer SET email = $model->email,\nfirst_name = $model->first_name,\n middle_name = $model->middle_name,\nfathers_last_name= $model->fathers_last_name, \nmothers_last_name= $model->mothers_last_name, \ndate_of_birth = $model->date_of_birth\n WHERE id = $id";
                 Yii::$app->getSession()->setFlash('updated_success', [
                    'type' => 'success',
                    'duration' => 5000,
                    'icon' => 'glyphicon glyphicon-ok-sign',
                    'title' => 'Query',
                    'showSeparator' => true,
                    'message' => $query,
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);

            return $this->redirect(['account', 'id' => $model->id]);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Customer Phone Number model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdatePhone($id)
    {
        $model = $this->findPhone($id);

         $sql ="SELECT number FROM phone_number WHERE customer_id = $id";
         Yii::$app->getSession()->setFlash('updating', [
                'type' => 'success',
                'duration' => 5000,
                'icon' => 'glyphicon glyphicon-ok-sign',
                'title' => 'Query',
                'showSeparator' => true,
                'message' => $sql,
                'positonY' => 'top',
                'positonX' => 'right'
            ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

             $que ="UPDATE phone_number SET number = $model->number\n WHERE customer_id = $id";
                 Yii::$app->getSession()->setFlash('phone', [
                    'type' => 'success',
                    'duration' => 5005,
                    'icon' => 'glyphicon glyphicon-ok-sign',
                    'title' => 'Query',
                    'showSeparator' => true,
                    'message' => $que,
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);

            return $this->redirect(['account', 'id' => $model->customer_id]);
        } else {
            return $this->renderAjax('_updatePhone', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Customer Payment Method model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdatePayment($id)
    {
        $model = $this->findPaymentMethod($id);

        $sql ="SELECT * FROM payment_method WHERE customer_id = $id";
         Yii::$app->getSession()->setFlash('searching', [
                'type' => 'success',
                'duration' => 5000,
                'icon' => 'glyphicon glyphicon-ok-sign',
                'title' => 'Query',
                'showSeparator' => true,
                'message' => $sql,
                'positonY' => 'top',
                'positonX' => 'right'
            ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $que ="UPDATE payment_method SET card_last_digits = $model->card_last_digits, \nexp_date = $model->exp_date, \ncard_type = $model->card_type\n WHERE customer_id = $id";
                 Yii::$app->getSession()->setFlash('payment', [
                    'type' => 'success',
                    'duration' => 5005,
                    'icon' => 'glyphicon glyphicon-ok-sign',
                    'title' => 'Query',
                    'showSeparator' => true,
                    'message' => $que,
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);

            return $this->redirect(['account', 'id' => $model->customer_id]);
        } else {

            return $this->renderAjax('_updatePayment', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Customer Shipping Address model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdateAddress($id)
    {
        $model = $this->findShippingAddress($id);

        $sql ="SELECT * FROM shipping_address WHERE customer_id = $id";
         Yii::$app->getSession()->setFlash('searching', [
                'type' => 'success',
                'duration' => 5000,
                'icon' => 'glyphicon glyphicon-ok-sign',
                'title' => 'Query',
                'showSeparator' => true,
                'message' => $sql,
                'positonY' => 'top',
                'positonX' => 'right'
            ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $que ="UPDATE shipping_address SET street_name = $model->street_name, \napt_number = $model->apt_number, \nzipcode = $model->zipcode, \nstate = $model->state\n WHERE customer_id = $id";
            Yii::$app->getSession()->setFlash('address', [
                'type' => 'success',
                'duration' => 5005,
                'icon' => 'glyphicon glyphicon-ok-sign',
                'title' => 'Query',
                'showSeparator' => true,
                'message' => $que,
                'positonY' => 'top',
                'positonX' => 'right'
            ]);

            return $this->redirect(['account', 'id' => $model->customer_id]);
        } else {
            return $this->renderAjax('_updateAdress', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Customer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
     * Finds the Customer's phone number model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customer's phone number the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findPhone($id)
    {
        if (($model = PhoneNumber::findOne($id)) !== null) {
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

    /**
     * Finds the Customer's payment method model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customer's phone number the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findPaymentMethod($id)
    {
        if (($model = PaymentMethod::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the Customer's ordermodel based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customer's phone number the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findOrder($id)
    {
        if (($model = Order::findOne($id)) !== null) {

            $sql ="SELECT * FROM order WHERE order_number = $id";
            Yii::$app->getSession()->setFlash('searching', [
                    'type' => 'success',
                    'duration' => 5000,
                    'icon' => 'glyphicon glyphicon-ok-sign',
                    'title' => 'Query',
                    'showSeparator' => true,
                    'message' => $sql,
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);

            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
