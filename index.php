<?php
$active = "home";
require_once 'include/header.php';
?>
<link href="css/map.css" type="text/css" rel="stylesheet">
<link href="css/chosen.css" type="text/css" rel="stylesheet">
<script src="scripts/map.js"></script>
<script src="scripts/chosen.jquery.js"></script>
<script src="ajax.js"></script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgDsjTAoG9ylNSKi3X_6T2hANiuHkDmQE&callback=initMap">
</script>
<div id="map">
</div>
<?php
require_once 'include/functions.php';
$routes = get_routes();
?>
<form>
    <label for="route_list"><h3>List of Routes</h3></label>
    <select id="route_list" class="">
        <option selected="selected"></option>
        <?php
            for ($j = 0; $j < count($routes); ++$j) { ?>
                <option value="<?= $routes[$j]?>"><?= $routes[$j]?></option>
                <?php
            }
        ?>
    </select>
</form>
<?php
require_once 'include/footer.php';
?>