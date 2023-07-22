/*
maps v3 init

let map;
$centerMap = [55.76, 37.64];

main();
async function main() {
    await ymaps3.ready;

    map = new ymaps3.YMap(document.getElementById('map'), {
        location: {
            center: $centerMap,
            zoom: 7,
            controls: ['searchControl']
        }
    },
    {
        searchControlProvider: 'yandex#search'
    });
}
*/


ymaps.ready(init);
let myMap;
$centerMap = [55.76, 37.64];

function init(){
    myMap = new ymaps.Map("map", {
        center: $centerMap,
        zoom: 4,
        controls: ['searchControl']
    },
    {
        // Будет производиться поиск по топонимам и организациям.
        // Работает только с ключами
        searchControlProvider: 'yandex#search',
        maxAnimationZoomDifference: Infinity
    });


    $(".item").each(function() {
        $coord = $( this ).attr('data-coord').replace(' ', '').split(',');
        $name = $( this ).attr('data-name');
        $phone = $( this ).attr('data-phone');
        $email = $( this ).attr('data-email');
        
        myMap.geoObjects.add(new ymaps.Placemark([parseInt($coord[0],10), parseInt($coord[1],10)], {
            balloonContent: '<strong>'+ $name +'</strong><br><a href="tel:' + $phone + '">' + $phone + '</a><br><a href="mailto:' + $email + '">' + $email + '</a>'
        }, {
            preset: 'islands#icon',
            iconColor: '#0095b6'
        }));
    });
    
    $(".item").on( "click", function() {
        $coord = $( this ).attr('data-coord').replace(' ', '').split(',');
        
        moveMap(parseInt($coord[0],10), parseInt($coord[1],10));
    });
}
// Изменить центр карты
function setCenter() {
    myMap.setCenter($centerMap);
}
//Смена положения
function moveMap(coord_x,coord_y) {
    myMap.setZoom(7);

    myMap.panTo([coord_x, coord_y], {flying: true});
    //скрол страницы вверх
    //window.scrollTo({top: 0, behavior: 'smooth'});
}
// Получаем center
function getGlobalPixelCenter() {
    let result = myMap.getGlobalPixelCenter();
}

