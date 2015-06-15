<?php
use yii\helpers\Html;
use yii\helpers\VarDumper;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\advert\models\AdvertSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tutors on map');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php

function getAdvertDetailsFromMap(\common\modules\advert\models\Advert $advert_model)
{
    return [
        'city' => '',

    ];
}

function getAdvertCaptionForMap(\common\modules\advert\models\Advert $advert_model)
{
    return implode(', ', [$advert_model->getTutorName(), $advert_model->getTutorGradeName(), $advert_model->experience]);
}

function getAdvertAsMapConfig(\common\modules\advert\models\Advert $advert_model)
{
    if (!empty($advert_model->advertAddress)
        && $advert_model->advertAddress->longitude != ''
        && $advert_model->advertAddress->latitude != ''
    ) {
        $coords = [$advert_model->advertAddress->latitude, $advert_model->advertAddress->longitude];
    } else {
        $coords = [0, 0];
    }


    $advert = [
        "type" => "Feature",
        "id" => $advert_model->id,
        "geometry" => [
            "type" => "Point",
            "coordinates" => $coords
        ],
        "properties" => [
            "balloonContent" => getAdvertCaptionForMap($advert_model),
            "hintContent" => getAdvertCaptionForMap($advert_model)
        ]
    ];
    return $advert;
}

?>

<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php

    $search_results = $dataProvider->getModels();
    $advertsMarksList = [
        "type" => "FeatureCollection",
        "features" => []
    ];

    $advertsDetailsList = [];

    foreach ($search_results as $item) {
        $advertsMarksList["features"][] = getAdvertAsMapConfig($item);

        $advertsDetailsList[$item->id] = getAdvertDetailsFromMap($item);
    }

    ?>

    <div id="tutor_on_map" style="width:600px;height:400px">
    </div>

    <script>var advertsList =<?= json_encode($advertsMarksList) ?></script>
    <script>var advertsDetailsList =<?= json_encode($advertsDetailsList) ?></script>

</div>
