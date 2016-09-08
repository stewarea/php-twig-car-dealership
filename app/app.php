<?php
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/car.php';

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    session_start();
    if(empty($_SESSION['car_list'])) {
        $_SESSION['car_list'] = array();
        $porsche = new Car('2014 Porsche 921', 7864, 114991, 'img/porsche.jpg');
        $ford = new Car("2011 Ford F450", 14241, 55995, "img/ford.jpg");
        $lexus = new Car("2013 Lexus RX 350", 20000, 44700, "img/lexus.jpg");
        $mercedes = new Car("Mecredes Benz CLS550", 37979, 39900, "img/mercedes.jpg");
        array_push($_SESSION['car_list'], $porsche, $ford, $lexus, $mercedes);
    };

    $app->get("/", function() use ($app) {
        return $app['twig']->render('start.html.twig', array('cars'=>Car::getAll()));
    });

    $app->post("/view_car", function() use ($app) {

        $cars_matching_search = array();
        // $car = new Car($_GET['price'], $_GET['miles']);

        foreach ($_SESSION['car_list'] as $car) {
            if ($car->worthBuyingPrice($_POST['price']) && $car->worthBuyingMiles($_POST['miles'])) {
                array_push($cars_matching_search, $car);
            }
        };
            return $app['twig']->render('results.html.twig', array('results'=>$cars_matching_search));
    });

    // $app->post('/post', function() use ($app) {
    //     return $app['twig']->render('new_car.html.twig');
    // });

    $app->post("/postCar", function() use ($app) {
        $car = new Car($_POST['newMake'], $_POST['newMiles'], $_POST['newPrice'], $_POST['newPicture']);
        array_push($_SESSION['car_list'], $car);
        return $app['twig']->render('new_car.html.twig', array('results'=>$_SESSION['car_list']));
    });
    return $app;
?>
