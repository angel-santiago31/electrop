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
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**

    ** PDF Creator

    */

    public function actionPdf($id, $fromDate, $toDate)
    {
          $model = $this->findModel($id);

          $orders = new Order();
          $allOrders = Order::find()->where([ '>', 'order_date', $fromDate])->andWhere(['<', 'order_date', $toDate])->all();

          if($allOrders != null) {
          $ordersInfo = $allOrders[0]->find()->joinWith('contains', 'item')->all();

          //Sum of the quantities
          $sumQty = $ordersInfo[0]->find()->sum('amount_stickers');

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
                          'allOrders' => $allOrders
                        ]),
                          'methods' => [
                                  'SetHeader' => ['Report Name: ' . $model->title],
                                ]
                          ]);

            return $pdf->render();
          } else {
              $pdf = new Pdf(['mode' => Pdf::MODE_CORE,
                          'format' => Pdf::FORMAT_A4,
                          'orientation' => Pdf::ORIENT_PORTRAIT,
                          'content' => $this->renderPartial('pdf', [
                          'model' => $model,
                          'allOrders' => $allOrders
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
