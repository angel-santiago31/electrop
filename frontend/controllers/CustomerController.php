<?php

namespace frontend\controllers;

use Yii;
use common\models\Customer;
use common\models\CustomerSearch;
use backend\models\CustomerCreate;
use frontend\models\CustomerAccountForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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

    ** View User Account 
    
    **/
    public function actionAccount() {  

       $model = Yii::$app->user->identity;
       return $this->render('account',
       ['model' => $model]);
    }

    public function actionUpdateInfo()
    {
        $id = Yii::$app->user->identity->id;
        $model = $this->findModel($id);

        Yii::$app->session->setFlash('success', 'Hola');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['account', 'id' => $model->id]);
        } else {
            return $this->renderAjax('updateinfo', [
                'model' => $model,
            ]);
        }
    }

    protected function findModel($id)
    {
        if (($model = Customer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
