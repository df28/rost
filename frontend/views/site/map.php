<?php

use yii\helpers\ArrayHelper;
use \common\modules\advert\models\Advert;
use \common\modules\advert\models\City;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\advert\models\AdvertSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tutors on map');
$this->params['breadcrumbs'][] = $this->title;

$thisView = $this;


function getAdvertDataForTemplate(Advert $advert)
{
    $advert_price = $advert->advertPrice;
    return [
        "city" => $advert->getCityName(),
        "tutorName" => $advert->getTutorName(),
        "address" => $advert->address,//TODO: address string must be in AdvertAddress model??

        "studentPlacePrice" => $advert_price?$advert_price->studentplace:'',
        "tutorPlacePrice" => $advert_price?$advert_price->tutorplace:'',
        "remotePlacePrice" => $advert_price?$advert_price->remote:'',

        "subjects" => implode(", ", ArrayHelper::getColumn($advert->advertSubjects, 'name')),
        "goals" => implode(", ", ArrayHelper::getColumn($advert->advertGoals, 'name')),
        "grade" => $advert->getTutorGradeName(),
        "experience" => $advert->experience,

        "avatar" => $advert->tutor->getImageUrl()
    ];
}

function getAdvertCaptionForMap(Advert $advert_model)
{
    return implode(', ', [$advert_model->getTutorName(), $advert_model->getTutorGradeName(), $advert_model->experience]);
}

function getAdvertAsMapConfig(Advert $advert_model)
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
            "balloonContentLayout" => "advert#default",
            "balloonPanelMaxMapArea" => 0,
            //"hintContent" => getAdvertCaptionForMap($advert_model),
            "tplVars" => getAdvertDataForTemplate($advert_model),
        ],
        "options" => ["balloonContentLayout" => "advert#default",]
    ];
    return $advert;
}

function getAdvertContentTemplateString(yii\web\View $view)
{
    $html = $view->render("templates/advert_content_template");

    $html = preg_replace("/\r|\n|\s{2,}/", "", $html);

    $html = addslashes($html);

    return $html;
}

function getAdvertMarksList($dataProvider)
{
    $search_results = $dataProvider->getModels();
    $advertsMarksList = [
        "type" => "FeatureCollection",
        "features" => []
    ];

    foreach ($search_results as $item) {
        $advertsMarksList["features"][] = getAdvertAsMapConfig($item);
    }

    return $advertsMarksList;
}

function getCityCoords(City $city = null)
{
    if (isset($city)) {
        if (
            isset($city->latitude) &&
            intval($city->latitude) != 0 &&
            isset($city->longitude) &&
            intval($city->longitude) != 0
        ) {
            return ["lat" => $city->latitude, "long" => $city->longitude];
        }
    }
    return false;
}

?>

<div class="site-about">

    <div id="tutor_on_map" style="width:700px;height:500px"></div>

    <script>var advertsList = <?= json_encode(getAdvertMarksList($dataProvider)) ?>;</script>
    <script>var AdvertContentTemplate = "<?php echo getAdvertContentTemplateString($thisView) ?>";</script>

    <?php
    $mapCenter = getCityCoords($searchModel->city);
    if ($mapCenter) { ?>
        <script>var mapCenter = <?= json_encode($mapCenter) ?>;</script>
    <?php } ?>

</div>
