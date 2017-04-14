<?php

namespace frontend\controllers;

use Yii;
use backend\models\Item;
use backend\models\ItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


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
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
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
