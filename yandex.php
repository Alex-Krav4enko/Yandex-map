<?php
$api = new \Yandex\Geo\Api();

$api->setQuery(isset($_POST['address']));

$api
  ->setLimit(100)
  ->setLang(\Yandex\Geo\Api::LANG_RU)
  ->load();

$response = $api->getResponse();

$foundCount = $response->getFoundCount();

$addresses = $response->getList();

function echoMap($address, $width, $length) {
echo <<<JS
<script type="text/javascript">
  ymaps.ready(init);
  var myMap, myPlacemark;

  function init() {
    myMap = new ymaps.Map("map", {
        center: [$width, $length],
        zoom: 7
    });

    myPlacemark = new ymaps.Placemark([$width, $length], {
        hintContent: '$address',
        balloonContent: '$address'
    });

    myMap.geoObjects.add(myPlacemark);
  }
</script>
JS;
}