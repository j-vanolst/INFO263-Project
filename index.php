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


require_once 'include/classes.php';

$test = json_decode(runApiCall($trip_ids), true);
$vehicles = [];
$vehicle_objects = [];
foreach ($test['response']['entity'] as $vehicle)
{
    array_push($vehicles, $vehicle);
}
for ($i = 0; $i < count($vehicles); ++$i)
{
    $vehicle_objects[$i] = new Vehicle;
    $vehicle_objects[$i]->vehicle_id = $vehicles[$i]['vehicle']['vehicle']['id'];
    $vehicle_objects[$i]->latitude = $vehicles[$i]['vehicle']['position']['latitude'];
    $vehicle_objects[$i]->longitude = $vehicles[$i]['vehicle']['position']['longitude'];
}
foreach ($vehicle_objects as $vehicle)
{
    $vehicle->getVehicleInfo();
    echo "<br>";
}
//START OF XML SECTION

require_once "include/xml_generator.php";
generate_xml($vehicle_objects);

?>

<?php
require_once 'include/footer.php';
?>
