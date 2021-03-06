<?php

namespace backend\controllers;

use Yii;
use backend\models\Reports;
use backend\models\ReportsSearch;
use backend\models\Order;
use backend\models\Item;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;
use kartik\growl\Growl;
use yii\helpers\ArrayHelper;

/**
 * ReportsController implements the CRUD actions for Reports model.
 */
class ReportsController extends Controller
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
     * Lists all Reports models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReportsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setSort([
            'defaultOrder' => ['id'=>SORT_DESC],
        ]);

        if($searchModel->title == "" && !$searchModel->type == ""){
            $sql ="SELECT * FROM reports WHERE type = $searchModel->type";
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
        } else if( $searchModel->title == "" && $searchModel->type == ""){
            $sql ="SELECT * FROM reports";
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
        } else if(!$searchModel->title == "" && $searchModel->type == ""){
           $sql ="SELECT * FROM reports WHERE title = $searchModel->title";
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
        } else if(!$searchModel->title == "" && !$searchModel->type =="" ){
            $sql ="SELECT * FROM reports WHERE title = $searchModel->title AND type = $searchModel->type";
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
     * Displays a single Reports model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $sql ="SELECT * FROM reports WHERE id = $id";
        Yii::$app->getSession()->setFlash('success', [
            'type' => 'success',
            'duration' => 5000,
            'icon' => 'glyphicon glyphicon-ok-sign',
            'title' => 'Query',
            'message' => $sql,
            'positonY' => 'top',
            'positonX' => 'right'
            ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Reports model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Reports();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $sql ="INSERT INTO reports (id,title,description,\ntype,from_date,\nto_date,refers_to,item_selected) VALUES \n($model->id, \n$model->title, \n$model->description, \n$model->type, \n$model->from_date, \n$model->to_date, \n$model->refers_to, \n$model->item_selected)";
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
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**

    ** PDF Creator

    */

    public function actionPdf($id, $fromDate, $toDate, $groupedBy, $itemSelected)
    {
          $model = $this->findModel($id);

          $orders = new Order();
          $allOrders = Order::find()->where([ '>', 'order_date', $fromDate])->andWhere(['<', 'order_date', $toDate])->all();

          if($allOrders && $groupedBy == 'All')
          {
            $sql = 'SELECT *
                        FROM `order` INNER JOIN `contains` INNER JOIN `item` INNER JOIN `item_category`
                        WHERE `contains`.item_id = `item`.item_id AND `order`.order_number = `contains`.order_number AND `item`.item_category_id = `item_category`.id
                        ';
            $ordersInfo = $allOrders[0]->findBySql($sql)->all();

            //Sum of the quantities
                $sumAllQty = 'SELECT SUM(`contains`.quantity_in_order) AS amount_sum
                            FROM `order` INNER JOIN `contains` INNER JOIN `item` INNER JOIN `item_category`
                            WHERE `contains`.item_id = `item`.item_id AND `order`.order_number = `contains`.order_number AND `item`.item_category_id = `item_category`.id
                            ';
                $sumQty = $ordersInfo[0]->findBySql($sumAllQty)->all();
            //Sum of Total Sales
            $sumSales = $ordersInfo[0]->find()->sum('total_price');



            $pdf = new Pdf(['mode' => Pdf::MODE_CORE,
                            'format' => Pdf::FORMAT_A4,
                            'orientation' => Pdf::ORIENT_PORTRAIT,
                            'content' => $this->renderPartial('pdf', [
                            'model' => $model,
                            'ordersInfo' => $ordersInfo,
                            'sumQty' => $sumQty,
                            'sumSales' => $sumSales,
                            'allOrders' => $allOrders,
                            'groupedBy' => $groupedBy,
                            'sql' => $sql,
                            'sumAllQty' => $sumAllQty,
                            'fromDate' => $fromDate,
                            'toDate' => $toDate
                            ]),
                            'methods' => [
                                    'SetHeader' => ['Report Name: ' . $model->title],
                                    ]
                            ]);

                return $pdf->render();
          }
          else if($allOrders && $groupedBy == 4)
          {
              $sql = 'SELECT *
                        FROM `order` INNER JOIN `contains` INNER JOIN `item` INNER JOIN `item_category`
                        WHERE `contains`.item_id = `item`.item_id AND `order`.order_number = `contains`.order_number AND `item`.item_category_id = `item_category`.id
                        AND `item`.item_id = ' .  $itemSelected;
              $ordersInfo = $allOrders[0]->findBySql($sql)->all();

              if($ordersInfo != null)
              {

                //Sum of the quantities grouped by the item category selected.
                $sqlGroupByQty = 'SELECT SUM(`contains`.quantity_in_order) AS amount_sum
                            FROM `order` INNER JOIN `contains` INNER JOIN `item` INNER JOIN `item_category`
                            WHERE `contains`.item_id = `item`.item_id AND `order`.order_number = `contains`.order_number AND `item`.item_category_id = `item_category`.id
                            AND `item`.item_id = ' .  $itemSelected;
                $sumQty = $ordersInfo[0]->findBySql($sqlGroupByQty)->all();

                //Sum of Total Sales grouped by the item category selected.
                $sqlGroupByPrice = 'SELECT SUM(`item`.gross_price) AS total_sum
                            FROM `order` INNER JOIN `contains` INNER JOIN `item` INNER JOIN `item_category`
                            WHERE `contains`.item_id = `item`.item_id AND `order`.order_number = `contains`.order_number AND `item`.item_category_id = `item_category`.id
                            AND `item`.item_id = ' .  $itemSelected;
                $sumSales = $ordersInfo[0]->findBySql($sqlGroupByPrice)->all();

                $pdf = new Pdf(['mode' => Pdf::MODE_CORE,
                                'format' => Pdf::FORMAT_A4,
                                'orientation' => Pdf::ORIENT_PORTRAIT,
                                'content' => $this->renderPartial('pdf', [
                                'model' => $model,
                                'ordersInfo' => $ordersInfo,
                                'sumQty' => $sumQty,
                                'sumSales' => $sumSales,
                                'allOrders' => $allOrders,
                                'groupedBy' => $groupedBy,
                                'sql' => $sql,
                                'sqlGroupByQty' => $sqlGroupByQty,
                                'sqlGroupByPrice' => $sqlGroupByPrice,
                                'fromDate' => $fromDate,
                                'toDate' => $toDate
                                ]),
                                'methods' => [
                                        'SetHeader' => ['Report Name: ' . $model->title],
                                        ]
                                ]);

                    return $pdf->render();
            } else
              {
                  $pdf = new Pdf(['mode' => Pdf::MODE_CORE,
                            'format' => Pdf::FORMAT_A4,
                            'orientation' => Pdf::ORIENT_PORTRAIT,
                            'content' => $this->renderPartial('pdf', [
                            'model' => $model,
                            'allOrders' => $allOrders,
                            'ordersInfo' => $ordersInfo,
                            'fromDate' => $fromDate,
                            'toDate' => $toDate
                            ]),
                            'methods' => [
                                    'SetHeader' => ['Report Name: ' . $model->title],
                                    ]
                            ]);

                  return $pdf->render();
              }
          }
          else if($allOrders)
          {
              $sql = 'SELECT *
                        FROM `order` INNER JOIN `contains` INNER JOIN `item` INNER JOIN `item_category`
                        WHERE `contains`.item_id = `item`.item_id AND `order`.order_number = `contains`.order_number AND `item`.item_category_id = `item_category`.id
                        AND `item`.item_category_id = ' .  $groupedBy;
              $ordersInfo = $allOrders[0]->findBySql($sql)->all();

              if($ordersInfo != null)
              {

                //Sum of the quantities grouped by the item category selected.
                $sqlGroupByQty = 'SELECT SUM(`contains`.quantity_in_order) AS amount_sum
                            FROM `order` INNER JOIN `contains` INNER JOIN `item` INNER JOIN `item_category`
                            WHERE `contains`.item_id = `item`.item_id AND `order`.order_number = `contains`.order_number AND `item`.item_category_id = `item_category`.id
                            GROUP BY item_category_id
                            HAVING item_category_id = ' . $groupedBy;
                $sumQty = $ordersInfo[0]->findBySql($sqlGroupByQty)->all();

                //Sum of Total Sales grouped by the item category selected.
                $sqlGroupByPrice = 'SELECT SUM(`item`.gross_price * `contains`.quantity_in_order) AS total_sum
                            FROM `order` INNER JOIN `contains` INNER JOIN `item` INNER JOIN `item_category`
                            WHERE `contains`.item_id = `item`.item_id AND `order`.order_number = `contains`.order_number AND `item`.item_category_id = `item_category`.id
                            GROUP BY item_category_id
                            HAVING item_category_id = ' . $groupedBy;
                $sumSales = $ordersInfo[0]->findBySql($sqlGroupByPrice)->all();

                $pdf = new Pdf(['mode' => Pdf::MODE_CORE,
                                'format' => Pdf::FORMAT_A4,
                                'orientation' => Pdf::ORIENT_PORTRAIT,
                                'content' => $this->renderPartial('pdf', [
                                'model' => $model,
                                'ordersInfo' => $ordersInfo,
                                'sumQty' => $sumQty,
                                'sumSales' => $sumSales,
                                'allOrders' => $allOrders,
                                'groupedBy' => $groupedBy,
                                'sql' => $sql,
                                'sqlGroupByQty' => $sqlGroupByQty,
                                'sqlGroupByPrice' => $sqlGroupByPrice,
                                'fromDate' => $fromDate,
                                'toDate' => $toDate
                                ]),
                                'methods' => [
                                        'SetHeader' => ['Report Name: ' . $model->title],
                                        ]
                                ]);

                    return $pdf->render();
              }
              else
              {
                  $pdf = new Pdf(['mode' => Pdf::MODE_CORE,
                            'format' => Pdf::FORMAT_A4,
                            'orientation' => Pdf::ORIENT_PORTRAIT,
                            'content' => $this->renderPartial('pdf', [
                            'model' => $model,
                            'allOrders' => $allOrders,
                            'ordersInfo' => $ordersInfo,
                            'groupedBy' => $groupedBy,
                            'fromDate' => $fromDate,
                            'toDate' => $toDate
                            ]),
                            'methods' => [
                                    'SetHeader' => ['Report Name: ' . $model->title],
                                    ]
                            ]);

                  return $pdf->render();
              }
          }
          {
                $pdf = new Pdf(['mode' => Pdf::MODE_CORE,
                            'format' => Pdf::FORMAT_A4,
                            'orientation' => Pdf::ORIENT_PORTRAIT,
                            'content' => $this->renderPartial('pdf', [
                            'model' => $model,
                            'allOrders' => $allOrders,
                            'groupedBy' => $groupedBy,
                            'fromDate' => $fromDate,
                            'toDate' => $toDate
                            ]),
                            'methods' => [
                                    'SetHeader' => ['Report Name: ' . $model->title],
                                    ]
                            ]);

                return $pdf->render();
          }
    }

    /**
     * Updates an existing Reports model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Reports model.
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
     * Finds the Reports model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Reports the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Reports::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
