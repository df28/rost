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