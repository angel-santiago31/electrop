<?php

namespace backend\controllers;

use Yii;
use common\models\Customer;
use common\models\CustomerSearch;
use backend\models\CustomerCreate;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
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
        // echo '<pre>';
        // var_dump($searchModel);
        // die(1);
        if ($searchModel->status == 10){
           $sql ="SELECT * FROM customer WHERE status = $searchModel->status";
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
        } else if ($searchModel->status == "") {
            $sql ="SELECT * FROM customer";
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
            $sql ="SELECT * FROM customer WHERE status = $searchModel->status";
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
     * Displays a single Customer model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $sql ="SELECT * FROM customer WHERE id = $id";
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
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CustomerCreate();

        if ($model->load(Yii::$app->request->post()) && $model->customerCreate()) {
            // Falta modificar query para que sea legitimo a lo que se está haciendo, pero hay que arreglar base de datos antes de 
             $sql ="INSERT INTO customer(id,email,password_hash,first_name,\nmiddle_name,fathers_last_name,mothers_last_name,\ndate_of_birth,\nauth_key,status,created_at,updated_at) VALUES \n($model->id,\n$model->email, \n$model->password_hash, \n$model->first_name, \n$model->middle_name, \n$model->fathers_last_name, \n$model->mothers_last_name,\n$model->date_of_birth, \n$model->auth_key,\n$model->created_at, \n$model->updated_at)";
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

            return $this->redirect(['customer/index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
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

        $sql ="SELECT * FROM customer WHERE id = $model->id";
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

             $sql ="UPDATE customer SET password_hash = $model->password_hash,\npassword_reset_token = $model->password_reset_token,\n email = $model->email\n,updated_at= $model->updated_at \n WHERE id = $model->id";
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

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
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
        $model = $this->findModel($id);
        $model->status = Customer::STATUS_DELETED;
        $model->save(false);

         $sql ="UPDATE customer SET status = $model->status WHERE id = $model->id";
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
    }

    /**
     * Restores an existing Customer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionRestore($id)
    {
        $model = $this->findModel($id);
        $model->status = Customer::STATUS_ACTIVE;
        $model->save(false);

         $sql ="UPDATE customer SET status = $model->status WHERE id = $model->id";
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
}
