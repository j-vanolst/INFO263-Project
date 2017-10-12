<?php
    function get_routes()
    {
        include 'config.php';
        $conn = new mysqli($hostname, $username, $password, $database);
        if ($conn->connect_error)
            die($conn->connect_error);
        $query = "SELECT DISTINCT route_short_name FROM routes";
        $result = $conn->query($query);
        if (!$result)
            die($conn->error);
        $rows = $result->num_rows;
        $routes = [];
        for ($j = 0 ; $j < $rows ; ++$j) {
            $result->data_seek($j);
            $row = $result->fetch_array(MYSQLI_ASSOC);
            array_push($routes,$row['route_short_name']);
        }
        $result->close();
        $conn->close();
        return $routes;
    }
    function get_route_ids($route_short_name)
    {
        include 'config.php';
        $conn = new mysqli($hostname, $username, $password, $database);
        if ($conn->connect_error)
            die($conn->connect_error);
        $query = "SELECT route_id FROM routes WHERE route_short_name = '$route_short_name'";
        $result = $conn->query($query);
        if (!$result)
            die($conn->error);
        $rows = $result->num_rows;
        $route_ids = [];
        for ($j = 0 ; $j < $rows ; ++$j) {
            $result->data_seek($j);
            $row = $result->fetch_array(MYSQLI_ASSOC);
            array_push($route_ids,$row['route_id']);
        }
        $result->close();
        $conn->close();
        return $route_ids;
    }
    function get_trip_ids($route_ids)
    {
        include 'config.php';
        $conn = new mysqli($hostname, $username, $password, $database);
        if ($conn->connect_error)
            die($conn->connect_error);
        $trip_ids = [];
        foreach ($route_ids as $route_id)
        {
            $query = "SELECT trip_id FROM trips WHERE route_id = '$route_id'";
            $result = $conn->query($query);
            if (!$result)
                die($conn->error);
            $rows = $result->num_rows;
            for ($j = 0 ; $j < $rows ; ++$j) {
                $result->data_seek($j);
                $row = $result->fetch_array(MYSQLI_ASSOC);
                array_push($trip_ids, $row['trip_id']);
            }
            $result->close();
        }
        $conn->close();
        return $trip_ids;
    }
    function vehicle_json_parser($json)
    {
        $vehicles = [];
        $vehicle_objects = [];
        foreach ($json['response']['entity'] as $vehicle)
        {
            array_push($vehicles, $vehicle);
        }
        for ($i = 0; $i < count($vehicles); ++$i)
        {
            $id_string = $vehicles[$i]['vehicle']['vehicle']['id'];
            $lat_string = $vehicles[$i]['vehicle']['position']['latitude'];
            $lng_string = $vehicles[$i]['vehicle']['position']['longitude'];
            $start_time_string = $vehicles[$i]['vehicle']['trip']['start_time'];
            $timestamp_string = $vehicles[$i]['vehicle']['timestamp'];
            $vehicle_objects[$i] = [];
            array_push($vehicle_objects[$i], $id_string);
            array_push($vehicle_objects[$i], $lat_string);
            array_push($vehicle_objects[$i], $lng_string);
            array_push($vehicle_objects[$i], $start_time_string);
            array_push($vehicle_objects[$i], $timestamp_string);
        }
        return ($vehicle_objects);
    }
?>