<?php
    class Car
    {
        private $make;
        private $miles;
        private $price;
        public $picture;

        function __construct($carMake, $carMiles, $carPrice, $image_path) {
            $this->make = $carMake;
            $this->miles = $carMiles;
            $this->price = $carPrice;
            $this->picture = $image_path;
        }
        // Getters and Setters
        function setPrice($new_price)
        {
            $float_price = (float) $new_price;
            if ($float_price != 0) {
                $formatted_price = number_format($float_price, 2);
                $this->price = $formatted_price;
            }
        }

        function getPrice()
        {
            return $this->price;
        }

        function setMiles($new_miles)
        {
            $float_miles = (float) $new_miles;
                if ($float_miles != 0) {
                    $this->miles = $float_miles;
                }
        }

        function getMiles()
        {
            return $this->miles;
        }

        function setMake($new_make)
        {
            $this->make = $new_make;
        }

        function getMake()
        {
            return $this->make;
        }

        function worthBuyingPrice($max_price)
        {
            return $this->price < ($max_price);
        }

        function worthBuyingMiles($max_miles)
        {
            return $this->miles < ($max_miles);
        }

    }
?>
