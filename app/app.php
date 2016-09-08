</<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Car.php";

    session_start();

    if (empty($_SESSION['cars'])) {
        $_SESSION['cars'] = array();
        $porsche = new Car("2014 Porsche 911", 114991, 7864, "img/porsche911.jpg");

        $ford = new Car("2011 Ford F450", 55995, 14241, "img/fordf450.jpg");

        $lexus = new Car("2013 Lexus RX 350", 44700, 20000, "img/lexus350.jpg");

        $mercedes = new Car("Mercedes Benz CLS550", 39900, 37979, "img/mercedescls550.jpg");
        $_SESSION['cars'] = array($porsche, $ford, $lexus, $mercedes);
    }



    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('search_car.html.twig');
    });

    $app->post('/car', function() use ($app) {

        $cars_matching_search = array();

        foreach ($_SESSION['cars'] as $car) {
            if ($car->worthBuying($_POST['price'], $_POST['mileage'])) {
                array_push($cars_matching_search, $car);
            }
        }

        return $app['twig']->render('cars.html.twig', array('cars' => $cars_matching_search));
    });

    $app->post('/addcar', function() use($app) {
        $newCar = new Car($_POST['make'], $_POST['newPrice'], $_POST['newMiles'], $_POST['picture']);
        $newCar->save();
        return $app['twig']->render('add_car.html.twig', array('newcar' => $newCar));
    });

    return $app;
 ?>
