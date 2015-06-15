<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\advert\models\AdvertSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Adverts';
$this->params['breadcrumbs'][] = Yii::t('app',$this->title);
?>
<div class="advert-index">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
<!---->
<!--    --><?//= GridView::widget([
//        'dataProvider' => $dataProvider,
////        'filterModel' => $searchModel,
//        'columns' => [
//            //['class' => 'yii\grid\SerialColumn'],
//
//            'tutorName',
//            'advertSubjects.Subject.name',
//            'cityName',
//            'experience',
//            'address',
//
//            //['class' => 'yii\grid\ActionColumn'],
//        ],
//    ]); ?>

    <?php
        echo ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_search_result_item',
            'layout' => "{sorter}<br />{summary}\n{items}\n{pager}",
            'sorter' => array('attributes' => ['experience', 'tutor_grade_id']),
        ]);
    ?>

</div>
