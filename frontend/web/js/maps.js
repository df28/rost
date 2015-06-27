/**
 * Created by df28 on 18.4.15.
 */

ymaps.ready(init);

var mapDefaultCenter = {lat: 53.8968830, long: 27.5508090};

var AdvertsMap;

function init() {
    initMap();
}


function initMap() {
    if (typeof mapCenter === 'undefined' || typeof mapCenter.lat === 'undefined' || typeof mapCenter.long === 'undefined') {
        mapCenter = mapDefaultCenter;
    }

    AdvertsMap = new ymaps.Map('tutor_on_map', {
        center: [mapCenter.lat, mapCenter.long],
        zoom: 10
    });


    var AdvertContentLayoutClass = ymaps.templateLayoutFactory.createClass(AdvertContentTemplate);
    ymaps.layout.storage.add('advert#default', AdvertContentLayoutClass);

    var objectManager = new ymaps.ObjectManager({
        clusterize: true,
        geoObjectBalloonContentLayout: AdvertContentLayoutClass,
        geoObjectBalloonMaxHeight: 550,
        geoObjectBalloonMaxWidth: 600
    });

    if (advertsList)
        objectManager.add(advertsList);

    AdvertsMap.geoObjects.add(objectManager);
}

function showAdvertFullInfo(advertId)
{
    var template = $.templates("#advertFullContentTemplate");

    var list = advertsList["features"];
    var advert = null;
    for(var i=0;i<list.length;i++)
    {
        if(list[i].id == advertId)
        {
            advert = list[i];
            break;
        }
    }

    if(advert == null)
        return;

    var htmlOutput = template.render(advert["properties"]["tplVars"]);
    $("#advertBalloonExtendedPopupContent").html(htmlOutput);
    $("#advertBalloonExtendedPopup").modal();
}