<?php

namespace backend\controllers;

use Yii;
use backend\models\Item;
use backend\models\Order;
use backend\models\OrderSearch;
use backend\models\Contains;
use backend\models\ContainsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\growl\Growl;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
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
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // echo '<pre>';
        // var_dump($searchModel);
        // die(1);

        if($searchModel->order_number == "" && !$searchModel->order_status == ""){
            $sql ="SELECT * FROM order WHERE order_status = $searchModel->order_status";
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
        } else if( $searchModel->order_number == "" && $searchModel->order_status == ""){
            $sql ="SELECT * FROM order";
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
        } else if(!$searchModel->order_number == "" && $searchModel->order_status == ""){
           $sql ="SELECT * FROM order WHERE order_number = $searchModel->order_number";
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
        } else if($searchModel->order_number == "" && $searchModel->order_status == 0){
            $sql ="SELECT * FROM order WHERE order_status = $searchModel->order_status";
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
        } else if(!$searchModel->order_number == "" && $searchModel->order_status == 0){
            $sql ="SELECT * FROM order WHERE order_number = $searchModel->order_number AND order_status = $searchModel->order_status";
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
        } else if(!$searchModel->order_number == "" && !$searchModel->order_status =="" ){
            $sql ="SELECT * FROM order WHERE order_number = $searchModel->order_number AND order_status = $searchModel->order_status";
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



        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $order = $this->findModel($id);

        $searchModel = new ContainsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $order->order_number);

        $sql ="SELECT * FROM order WHERE id = $id\n\nSELECT * FROM contains WHERE order_number = $id";
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

        return $this->render('view', [
            'model' => $order,
            'order_items' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->order_number]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $sql ="UPDATE order SET \norder_status = $model->order_status\n WHERE id = $model->order_number";
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

            if ($model->order_status == Order::SHIPPED) {
                $orderItems = Contains::find(['order_number' => $model->order_number])->all();
                foreach($orderItems as $sticker) {
                    //decrease inventory quantity
                    $item = Item::findOne($sticker->item_id);
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
                }
            }

            return $this->redirect(['view', 'id' => $model->order_number]);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Order model.
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
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
