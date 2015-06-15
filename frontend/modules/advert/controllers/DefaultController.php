<?php

namespace backend\modules\advert\controllers;

use yii\web\Controller;
use yii\helpers\Url;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new AdvertSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
