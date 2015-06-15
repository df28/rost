<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use \common\modules\advert\models\Advert;

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

        "studentPlacePrice" => $advert_price->studentplace,
        "tutorPlacePrice" => $advert_price->tutorplace,
        "remotePlacePrice" => $advert_price->remote,

        "subjects" => implode(", ", ArrayHelper::getColumn($advert->advertSubjects, 'name')),
        "goals" => implode(", ", ArrayHelper::getColumn($advert->advertGoals, 'name')),
        "grade" => $advert->getTutorGradeName(),
        "experience" => $advert->experience
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
        "balloonContentLayout" => "advert#default",
        "geometry" => [
            "type" => "Point",
            "coordinates" => $coords
        ],
        "properties" => [
            "balloonContentLayout" => "advert#default",
            //"balloonContent" => getAdvertCaptionForMap($advert_model),
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

    $html = preg_replace( "/\r|\n|\s{2,}/", "", $html );

    $html = addslashes($html);

    return $html;
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
    }

    ?>

    <div id="tutor_on_map" style="width:600px;height:400px">
    </div>

    <script>var advertsList =<?= json_encode($advertsMarksList) ?></script>
    <script>var AdvertContentTemplate = "<?php echo getAdvertContentTemplateString($thisView) ?>";</script>

</div>
