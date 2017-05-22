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
use backend\models\ShippingAddressSearch;
use backend\models\PaymentMethod;
use backend\models\PaymentMethodSearch;
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
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
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
        // echo '<pre>';
        // var_dump($customer);
        //die(1);
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
        // echo '<pre>';
        // var_dump($customer_phone);
        //die(2);
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
        // echo '<pre>';
        // var_dump($customer_shipping_address);
        //die(3);

        $searchModelAddress = new ShippingAddressSearch();

        $address = $searchModelAddress->search(Yii::$app->request->queryParams, $customer->id);
        $address->query->andWhere(['active' => ShippingAddress::STATUS_ACTIVE]);

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
        // echo '<pre>';
        // var_dump($customer_payment_method);
        // die(4);
        $searchModelPay = new PaymentMethodSearch();

        $cards = $searchModelPay->search(Yii::$app->request->queryParams, $customer->id);
        $cards->query->andWhere(['active' => PaymentMethod::STATUS_ACTIVE]);

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
            'cards' => $cards,
            'address' => $address,
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
     * If update is successful, the browser will be redirected to the 'account' page.
     * @param integer $id, $numbers
     * @return mixed
     */
    public function actionUpdatePayment($id, $numbers)
    {
        $model = $this->findPaymentMethod2($id, $numbers);
        // echo '<pre>';
        // var_dump($model);
        // die("f i n d i n g  . . . ");

        $sql ="SELECT * FROM payment_method WHERE customer_id = $id AND WHERE card_last_digits = $numbers";
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

       if ($model->load(Yii::$app->request->post())&& $model->save()) {

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
     * Inactives an existing Payment Method model.
     * If deletion is successful, the browser will be redirected to the 'account' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDeleteCard($id, $numbers)
    {
        $model = $this->findPaymentMethod2($id, $numbers);
        $model->active = PaymentMethod::STATUS_DELETED;
        // echo '<pre>';
        // var_dump($model);
        // die("f i n d i n g  . . . ");
        $model->save();

        $sql ="UPDATE paymet_method SET active = $model->active WHERE customer_id = $id AND WHERE card_last_digits = $numbers";
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

        return $this->redirect(['account', 'id' => $model->customer_id]);
    }


    /**
     * Creates a new Customer Payment Method model.
     * If create is successful, the browser will be redirected to the 'account' page.
     * @param integer $id
     * @return mixed
     */
    public function actionAddPayment($id)
    {
        $customer = $this->findModel($id);

        $sql ="SELECT * FROM customer WHERE id = $id";
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

        $newCard = new PaymentMethod();


        if ($newCard->load(Yii::$app->request->post())) {
            $newCard->customer_id = $customer->id;

            if($newCard->save()) {
                return $this->redirect(['account', 'id' => $newCard->customer_id]);
            } 

            $que ="INSERT INTO payment_method(customer_id,card_last_digits,\nexp_date,\ncard_type) VALUES \n($newCard->customer_id,$newCard->card_last_digits, \n$newCard->exp_date, \n$newCard->card_type)";
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

            return $this->redirect(['account', 'id' => $newCard->customer_id]);
        } else {

            return $this->renderAjax('_addPayment', [
                'newCard' => $newCard,
            ]);
        }
    }

    /**
     * Updates an existing Customer Shipping Address model.
     * If update is successful, the browser will be redirected to the 'account' page.
     * @param integer $id, $street
     * @return mixed
     */
    public function actionUpdateAddress($id, $street)
    {
        $model = $this->findShippingAddress2($id, $street);

        $sql ="SELECT * FROM shipping_address WHERE customer_id = $id AND WHERE street_name = $street";
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
     * Inactives an existing Shipping Address model.
     * If deletion is successful, the browser will be redirected to the 'account' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDeleteAddress($id, $street)
    {
        $model = $this->findShippingAddress2($id, $street);
        
        $model->active = ShippingAddress::STATUS_DELETED;
        $model->save(false);

        $sql ="UPDATE shipping_address SET active = $model->active WHERE customer_id = $id AND WHERE street_name = $street";
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

        return $this->redirect(['account', 'id' => $model->customer_id]);
    }

    /**
     * Creates a new Shipping Address Method model.
     * If create is successful, the browser will be redirected to the 'account' page.
     * @param integer $id
     * @return mixed
     */
    public function actionAddAddress($id)
    {
        $customer = $this->findModel($id);

        $sql ="SELECT * FROM customer WHERE id = $id";
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
            
        $newAddress = new ShippingAddress();


        if ($newAddress->load(Yii::$app->request->post())) {
            $newAddress->customer_id = $customer->id;

            if($newAddress->save()) {
                return $this->redirect(['account', 'id' => $newAddress->customer_id]);
            } 

            $que ="INSERT INTO shipping_address(customer_id,street_name,\napt_number,\nzipcode,\nstate) VALUES \n($newAddress->customer_id,$newAddress->street_name, \n$newAddress->apt_number, \n$newAddress->zipcode, \n$newAddress->state)";
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

            return $this->redirect(['account', 'id' => $newAddress->customer_id]);
        } else {

            return $this->renderAjax('_addAddress', [
                'newAddress' => $newAddress,
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
    protected function findShippingAddress2($id, $street)
    {
        if (($model = ShippingAddress::find()->where([ '=', 'customer_id', $id])->andWhere([ '=', 'street_name', $street])->andWhere([ '=', 'active', ShippingAddress::STATUS_ACTIVE])->One()) !== null) {
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
    protected function findPaymentMethod2($id, $numbers)
    {
   
        if (($model = PaymentMethod::find()->where([ '=', 'customer_id', $id])->andWhere([ '=', 'card_last_digits', $numbers])->andWhere([ '=', 'active', PaymentMethod::STATUS_ACTIVE])->One()) !== null) {
            // echo '<pre>';
            // var_dump($model);
            // die("f i n d i n g  . . . ");
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
