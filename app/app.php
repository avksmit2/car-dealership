</<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Car.php";

    $app = new Silex\Application();

    $app->get("/", function() {
        return
        "<!DOCTYPE html>
        <html>
        <head>
            <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css'>
            <title>Find a Car</title>
        </head>
        <body>
            <div class='container'>
                <h1>Find a Car!</h1>
                <form action='/car'>
                    <div class='form-group'>
                        <label for='price'>Enter Maximum Price:</label>
                        <input id='price' name='price' class='form-control' type='number'>
                    </div>
                    <div class='form-group'>
                      <label for='mileage'>Enter Maximum Mileage:</label>
                      <input id='mileage' name='mileage' class='form-control' type='number'>
                    <button type='submit' class='btn-success'>Submit</button>
                </form>
            </div>
        </body>
        </html>";
    });

    $app->get("car", function() {
        $porsche = new Car("2014 Porsche 911", 114991, 7864, "img/porsche911.jpg");

        $ford = new Car("2011 Ford F450", 55995, 14241, "img/fordf450.jpg");

        $lexus = new Car("2013 Lexus RX 350", 44700, 20000, "img/lexus350.jpg");

        $mercedes = new Car("Mercedes Benz CLS550", 39900, 37979, "img/mercedescls550.jpg");
        $cars = array($porsche, $ford, $lexus, $mercedes);
        $cars_matching_search = array();

        foreach ($cars as $car) {
            if ($car->worthBuying($_GET['price'], $_GET['mileage'])) {
                array_push($cars_matching_search, $car);
            }

        }
        $randomName = "<!DOCTYPE html>
        <html>
        <head>
            <title>Your Car Dealership's Homepage</title>
        </head>
        <body>
            <h1>Your Car Dealership</h1>
            <ul>";
        if (empty($cars_matching_search)) {
            $randomName = $randomName."Enter a higher number you cheap bastard.";
        }
        foreach ($cars_matching_search as $car) {

            $randomName = $randomName."<li>".$car->getMakeModel()."</li>".
            "<ul>".
                '<li> $'.$car->getPrice().'</li>'.
                '<li> Miles: '.$car->getMiles().'</li>'.
                "<li> <img src='".$car->getPicture()."'                     > </li>".
            '</ul>';
        }
        $randomName = $randomName."</ul>
        </body>
        </html>";

        return $randomName;
    });

    return $app;
 ?>
