/**
 * Created by df28 on 18.4.15.
 */

ymaps.ready(init);

var mapDefaultCenter = {lat: 53.8968830, long: 27.5508090};

var AdvertsMap;

var AdvertContentLayoutClass = ymaps.templateLayoutFactory.createClass(
    '<div>' +
        '{{ tutor_name }}' +
        '{{ prices_html }}' +
    '</div>'
);


function init () {
    initMap();
}


function initMap()
{
    AdvertsMap  = new ymaps.Map('tutor_on_map', {
        center: [mapDefaultCenter.lat, mapDefaultCenter.long],
        zoom: 10
    });

    var objectManager = new ymaps.ObjectManager({
        clusterize: true
    });

    objectManager.add(advertsList);

    AdvertsMap.geoObjects.add(objectManager);
}