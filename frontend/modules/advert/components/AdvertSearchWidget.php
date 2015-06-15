<?php
/**
 * Created by PhpStorm.
 * User: df28
 * Date: 8.4.15
 * Time: 23.33
 */

namespace frontend\modules\advert\components;

use yii\base\Widget;
use frontend\modules\advert\models\AdvertSearch;
use Yii;

class AdvertSearchWidget extends Widget
{
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $searchModel = new AdvertSearch();
        $searchModel->load(Yii::$app->request->get());

//        print_r(Yii::$app->request->get());
//        print_r($searchModel->attributes);

        return $this->render('_search', [
            'model' => $searchModel,
            'target_action' => (Yii::$app->controller->action->id == "map"?"map":"index")
        ]);
    }
}