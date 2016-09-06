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

    $porsche = new Car("2014 Porsche 921", 7864, 114991, "porsche.jpg");
    $ford = new Car("2011 Ford F450", 14241, 55995, "ford.jpg");
    $lexus = new Car("2013 Lexus RX 350", 20000, 44700, "lexus.jpg");
    $mercedes = new Car("Mecredes Benz CLS550", 37979, 39900, "mercedes.jpg");

    $cars = array($porsche, $ford, $lexus, $mercedes);
    $cars_matching_search = array();

    foreach ($cars as $car) {
        if ($car->worthBuyingPrice($_GET['price']) && $car->worthBuyingMiles($_GET['miles'])) {
            array_push($cars_matching_search, $car);
        } elseif (empty($cars_matching_search)) {
            echo "<h3>Your search did not match up</h3>";
            return;
        }
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <title></title>
    </head>
    <body>
        <div class="container">
            <h1>Cars matching your search</h1>
            <?php
                foreach($cars_matching_search as $aCar) {
                    $car_price = $aCar->getPrice();
                    $car_miles = $aCar->getMiles();
                    $car_make = $aCar->getMake();
                    echo "<h3>$car_make</h3>";
                    echo "<ul>";
                    echo "<li>Miles: $car_miles</li>";
                    echo "<li>Price: $$car_price</li>";
                    echo "</ul>";
                    echo "<img src='$aCar->picture'>";
                }
            ?>

        </div>
    </body>
</html>
