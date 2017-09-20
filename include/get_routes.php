<?php
    require 'classes.php';
    require 'config.php'
    function get_routes()
    {
        $conn = new mysqli($hostname, $username, $password, $database);
        if ($conn->connect_error)
            die($conn->connect_error);
        $query = "SELECT * FROM routes";
        $result = $conn->query($query);
        if (!$result)
            die($conn->error);
        $rows = $result->num_rows;
        $routes = [];
        for ($j = 0 ; $j < $rows ; ++$j) {
            $result->data_seek($j);
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $routes[$j] = new Route();
            $routes[$j]->route_id = $row['route_id'];
            $routes[$j]->route_short_name = $row['route_short_name'];
            $routes[$j]->route_long_name = $row['route_long_name'];
            $routes[$j]->route_type = $row['route_type'];
            $routes[$j]->agency_id = $row['agency_id'];
            $routes[$j]->route_text_color = $row['route_text_color'];
            $routes[$j]->route_color = $row['route_color'];
            $routes[$j]->route_url = $row['route_url'];
            $routes[$j]->route_desc = $row['route_desc'];
        }
        $result->close();
        $conn->close();
        return $routes;
    }
    function get_trip_ids($route_id)
    {
        $conn = new mysqli($hostname, $username, $password, $database);
        if ($conn->connect_error)
            die($conn->connect_error);
        $query = "SELECT trip_id FROM trips WHERE route_id = '$route_id'";
        $result = $conn->query($query);
        if (!$result)
            die($conn->error);
        $rows = $result->num_rows;
        $trip_ids = [];
        for ($j = 0 ; $j < $rows ; ++$j) {
            $result->data_seek($j);
            $row = $result->fetch_array(MYSQLI_ASSOC);
            array_push($trip_ids, $row['trip_id']);
        }
        $result->close();
        $conn->close();
        return $trip_ids;
    }
?>