<?php

namespace backend\controllers;

use Yii;
use backend\models\Item;
use backend\models\ItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use kartik\growl\Growl;

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
     * Lists all Item models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // echo '<pre>';
        // var_dump($searchModel);
        // die(1);

        if ($searchModel->name == "" && $searchModel->active == 1){
           $sql ="SELECT * FROM item WHERE status = $searchModel->active";
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
        } else if ($searchModel->name == "" && $searchModel->active == "") {
            $sql ="SELECT * FROM item";
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
        } else if ($searchModel->name == "" && $searchModel->active == 0){
            $sql ="SELECT * FROM item WHERE status = $searchModel->active";
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
            $sql ="SELECT * FROM item WHERE status = $searchModel->active AND name = $searchModel->name";
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
     * Displays a single Item model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $sql ="SELECT * FROM item WHERE id = $id";
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
     * Creates a new Item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Item();

        if ($model->load(Yii::$app->request->post())) {

            //get the instance of the uploaded file
            $imageName = $model->name;
            $model->file = UploadedFile::getInstance($model, 'file');

            //save the path to the db column
            $model->picture = 'uploads/'. $imageName . '.' . $model->file->extension;

            if ($model->save()) {
                $model->file->saveAs('uploads/'. $imageName . '.' . $model->file->extension);
                
                $sql ="INSERT INTO item(id,name,\npicture,quantity_remaining,\nsize,gross_price,\nproduction_cost,description,\nitem_category_id,\nitem_sub_category_id,\nactive) VALUES \n($model->id,$model->name, \n$model->picture, \n$model->quantity_remaining,$model->size, \n$model->gross_price,$model->production_cost, \n$model->description,\n$model->item_category_id, $model->item_sub_category_id, $model->active)";
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
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Item model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $sql ="SELECT * FROM item WHERE id = $model->id";
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

        if ($model->load(Yii::$app->request->post())) {

            //get the instance of the uploaded file
            $imageName = $model->name;
            $model->file = UploadedFile::getInstance($model, 'file');

            //save the path to the db column
            $model->picture = 'uploads/'. $imageName . '.' . $model->file->extension;

            if ($model->save()) {
                $model->file->saveAs('uploads/'. $imageName . '.' . $model->file->extension);

                $sql ="UPDATE item SET name = $model->name,\nsize = $model->size,\n quantity_remaining = $model->quantity_remaining, \ngross_price = $model->gross_price, \nproduction_cost = $model->production_cost, \nitem_category_id = $model->item_category_id,\nitem_sub_category_id = $model->item_sub_category_id,\npicture = $model->picture,\ndescription = $model->description,\n WHERE id = $model->id";
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
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Item model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->active = Item::DELETED;
        $model->save(false);

        $sql ="UPDATE item SET active = $model->active WHERE id = $model->id";
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
     * Restores an existing Item model.
     * If restore is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionRestore($id)
    {
        $model = $this->findModel($id);
        $model->active = Item::ACTIVE;
        $model->save(false);

         $sql ="UPDATE item SET active = $model->active WHERE id = $model->id";
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
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
