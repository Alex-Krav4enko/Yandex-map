<?php
require __DIR__ . '/vendor/autoload.php';
require 'yandex.php';
?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Address</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://api-maps.yandex.ru/2.1/?lang=tr_TR" type="text/javascript"></script>
</head>
<body>

<p>Адрес:</p>

<form method="POST">
  <input type="text" name="address" placeholder="Адрес">
  <input type="submit" name="search" value="Найти">
</form>

<?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
  <?php if ($foundCount === 1): ?>
    <?php foreach ($addresses as $number => $address): ?>
      <?php echoMap($address->getAddress(), $address->getLatitude(), $address->getLongitude()); ?>
    <?php endforeach; ?>
    <div id="map" style="width: 600px; height: 400px; margin: 50px auto;"></div>
  <?php elseif ($foundCount > 1): ?>
    <table>
      <tr>
        <th></th>
        <th>Адрес</th>
      </tr>
      <?php foreach ($addresses as $number => $address): ?>
        <tr>
          <td><?= $number + 1; ?></td>
          <td><a href="?adr=<?= $address->getAddress(); ?>&width=<?= $address->getLatitude(); ?>&length=<?= $address->getLongitude(); ?>"><?= $address->getAddress(); ?></a></td>
        </tr>
      <?php endforeach; ?>
    </table>
  <?php endif; ?>
<?php endif; ?>

<?php if (!empty($_GET['adr'])): ?>
  <?php echoMap($_GET['adr'], $_GET['width'], $_GET['length']); ?>
  <div id="map" style="width: 600px; height: 400px; margin: 50px auto;"></div>
<?php endif; ?>

</body>
</html>
