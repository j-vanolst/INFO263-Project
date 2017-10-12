<?php
if (isset($_POST['route_short_name']))
{
    require_once "include/functions.php";
    require_once "example_request.php";
    $route_short_name = $_POST['route_short_name'];
    $trip_ids = get_trip_ids(get_route_ids($route_short_name));
/*    $json = json_decode(runApiCall($trip_ids), true);*/
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
    $vehicles = vehicle_json_parser(json_decode($json, true));
    print_r(json_encode($vehicles));
}
?>