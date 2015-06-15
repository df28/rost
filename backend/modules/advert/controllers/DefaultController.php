<?php

namespace backend\modules\advert\controllers;

use yii\web\Controller;
use yii\helpers\Url;

class DefaultController extends Controller
{
    public function actionIndex()
    {

        $urls = [
            'City' => '/advert/city',
            'Role' => '/advert/role',
            'Study Goal' => '/advert/study-goal',
        ];
        return $this->render('index', ['urls' => $urls]);
    }
}
