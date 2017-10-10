<?php
    class Route
    {
        //Properties
        public $route_id, $route_short_name, $route_long_name, $route_type, $agency_id, $route_text_color, $route_color, $route_url, $route_desc;
    }
    class Vehicle
    {
        //Properties
        public $vehicle_id, $latitude, $longitude;

        /**
         * @return mixed
         */
        public function getCoordinates()
        {
            echo "Latitude: " . $this->latitude . "<br>" . "Longitude: " . $this->longitude . "<br>";
            return $this->latitude;
        }
    }
?>;