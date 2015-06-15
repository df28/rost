<?php

namespace backend\modules\advert\controllers;

use Yii;
use common\modules\advert\models\Advert;
use backend\modules\advert\models\AdvertSearch;
use common\modules\advert\models\AdvertPrice;
use common\modules\advert\models\AdvertAddress;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdvertController implements the CRUD actions for Advert model.
 */
class AdvertController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Advert models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdvertSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Advert model.
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
     * Creates a new Advert model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Advert();
        $advertPriceModel = new AdvertPrice();
        $advertAddressModel = new AdvertAddress();

        if ($model->load(Yii::$app->request->post())
            && $advertPriceModel->load(Yii::$app->request->post())
            && $advertAddressModel->load(Yii::$app->request->post())
            && $model->save()
        ) {

            $advertPriceModel->advertid = $model->id;
            $advertAddressModel->advertid = $model->id;
            if ($advertPriceModel->save() && $advertAddressModel->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'advertPriceModel' => $advertPriceModel
                ]);
            }

        } else {
            return $this->render('create', [
                'model' => $model,
                'advertPriceModel' => $advertPriceModel
            ]);
        }
    }

    /**
     * Updates an existing Advert model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (empty($model->advertPrice)) {
            $advertPriceModel = new AdvertPrice();
        } else {
            $advertPriceModel = $model->advertPrice;
        }


        if (empty($model->advertAddress)) {
            $advertAddressModel = new AdvertAddress();
        } else {
            $advertAddressModel = $model->advertAddress;
        }


        if ($model->load(Yii::$app->request->post())
            && $advertPriceModel->load(Yii::$app->request->post())
            && $advertAddressModel->load(Yii::$app->request->post())
            && $model->save()
        ) {

            $advertPriceModel->advertid = $model->id;
            $advertAddressModel->advertid = $model->id;
            if ($advertPriceModel->save() && $advertAddressModel->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'advertPriceModel' => $advertPriceModel
                ]);
            }

        } else {
            return $this->render('update', [
                'model' => $model,
                'advertPriceModel' => $advertPriceModel
            ]);
        }
    }

    /**
     * Deletes an existing Advert model.
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
     * Finds the Advert model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Advert the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Advert::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
