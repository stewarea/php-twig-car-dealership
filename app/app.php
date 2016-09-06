<?php
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/car.php';

    $app = new Silex\Application();

    $app->get("/", function() {
        return "
        <!DOCTYPE html>
        <html>
        <head>
            <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css'>
            <title>Find a Car</title>
        </head>
        <body>
            <div class='container'>
                <h1>Find a Car!</h1>
                <form action='/view_car'>
                    <div class='form-group'>
                        <label for='price'>Enter Maximum Price:</label>
                        <input id='price' name='price' class='form-control' type='number'>
                    </div>
                    <div class='form-group'>
                        <label for='miles'>Enter Maximum Miles:</label>
                        <input id='miles' name='miles' class='form-control' type='number'>
                    </div>
                    <button type='submit' class='btn btn-success'>Search</button>
                </form>

            </div>
        </body>
        </html>
        ";
    });
$app->get("/view_car", function(){

    $porsche = new Car('2014 Porsche 921', 7864, 114991, 'img/porsche.jpg');
    $ford = new Car("2011 Ford F450", 14241, 55995, "img/ford.jpg");
    $lexus = new Car("2013 Lexus RX 350", 20000, 44700, "img/lexus.jpg");
    $mercedes = new Car("Mecredes Benz CLS550", 37979, 39900, "img/mercedes.jpg");

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

    $output = "<h1>Find a Car!</h1>";
    foreach($cars_matching_search as $aCar) {
        $car_price = $aCar->getPrice();
        $car_miles = $aCar->getMiles();
        $car_make = $aCar->getMake();
        $output = $output . "
        <h3>$car_make</h3>
        <ul>
        <li>Miles: $car_miles</li>
        <li>Price: $$car_price</li>
        </ul>
        <img src='$aCar->picture'>";
    }
    return $output;
    });

    return $app;
?>
