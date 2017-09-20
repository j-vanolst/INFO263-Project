<?php
$active = "home";
require_once 'include/header.php';
?>
<link href="css/map.css" type="text/css" rel="stylesheet">
<link href="css/chosen.css" type="text/css" rel="stylesheet">
<script src="scripts/map.js"></script>
<script src="scripts/chosen.jquery.js"></script>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgDsjTAoG9ylNSKi3X_6T2hANiuHkDmQE&callback=initMap">
</script>

<script>
    $(document).ready(function() {
        $(".chosen-select").chosen()

    });
</script>

<div id="map">
</div>

<?php
require_once 'include/get_routes.php';
$routes = get_routes();
?>
<form method="post" action="index.php">
    <select name="route_list" id="route_list" class="chosen-select">
        <option selected="selected"></option>
        <?php
            for ($j = 0; $j < count($routes); ++$j) { ?>
                <option value="<?= $routes[$j]->route_id ?>"><?= $routes[$j]->route_long_name ?></option>
                <?php
            }
        ?>
    </select>
    <input type="submit" value="Submit">
</form>

<?php
require_once 'example_request.php';
$route_id = $_POST['route_list'];
$trip_ids = get_trip_ids($route_id);
echo "<b>TRIP IDS</b>" . "<br>";
foreach ($trip_ids as $trip)
{
    echo "Trip ID: " . $trip . "<br>";
}
foreach ($trip_ids as $trip)
{
    echo '"' . $trip . ",";
}
runApiCall($trip_ids);
?>

<?php
require_once 'include/footer.php';
?>
