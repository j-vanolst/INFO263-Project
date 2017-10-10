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
    echo $trip . ",";
}
$vehicles_json = json_decode(runApiCall($trip_ids)[0], true);
echo "<br><b>START OF TEST DATA!!!!!!!!!!!!</b><br>";
$json = "{
 \"status\": \"OK\",
 \"response\": {
 \"entity\": [{
 \"id\": \"8422d102-18ee-553e-4ba0-2cf2e18f2558\",
 \"is_deleted\": false,
 \"vehicle\": {
 \"trip\": {
 \"trip_id\": \"1080095214-20170928152758_v59.3\",
 \"route_id\": \"01804-20170928152758_v59.3\",
 \"start_time\": \"06:15:00\",
 \"schedule_relationship\": 0
 },
 \"vehicle\": {
 \"id\": \"2CC1\"
 },
 \"position\": {
 \"latitude\": -36.90927667,
 \"longitude\": 174.683935
 },
 \"timestamp\": 1507657619
 }
 }, {
 \"id\": \"6aa0f4ab-6dad-4667-34a2-64419cc87013\",
 \"is_deleted\": false,
 \"vehicle\": {
 \"trip\": {
 \"trip_id\": \"1080095252-20170928152758_v59.3\",
 \"route_id\": \"01804-20170928152758_v59.3\",
 \"start_time\": \"06:30:00\",
 \"schedule_relationship\": 0
 },
 \"vehicle\": {
 \"id\": \"2CBA\"
 },
 \"position\": {
 \"latitude\": -36.870233,
 \"longitude\": 174.71125,
 \"bearing\": \"235\"
 },
 \"timestamp\": 1507657815
 }
 }, {
 \"id\": \"286b4272-f5df-b46d-86b9-6ccec4b4c0b4\",
 \"is_deleted\": false,
 \"vehicle\": {
 \"trip\": {
 \"trip_id\": \"1080095299-20170928152758_v59.3\",
 \"route_id\": \"01804-20170928152758_v59.3\",
 \"start_time\": \"06:45:00\",
 \"schedule_relationship\": 0
 },
 \"vehicle\": {
 \"id\": \"2C9D\"
 },
 \"position\": {
 \"latitude\": -36.85575,
 \"longitude\": 174.75885,
 \"bearing\": \"171\"
 },
 \"timestamp\": 1507657830.872
 }
 }],
 \"header\": {
 \"gtfs_realtime_version\": \"1.0\",
 \"incrementality\": 1,
 \"timestamp\": 1507657834.393
 }
 },
 \"error\": null
}";

require_once 'include/classes.php';

$test = json_decode($json, true);
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
