<?php
class Car
{
    private $make_model;
    private $price;
    private $miles;
    private $picture;

    function worthBuying($max_price, $max_miles)
    {
        if ($this->price < ($max_price + 100) && $this->miles < $max_miles) {
            return true;
        } else {
            return false;
        }
    }

    function getMakeModel()
    {
        return $this->make_model;
    }

    function setMakeModel($makeModel)
    {
        $this->make_model = $makeModel;
    }

    function getPrice()
    {
        return $this->price;
    }

    function setPrice($inputPrice)
    {
        $this->price = $inputPrice;
    }

    function getMiles()
    {
        return $this->miles;
    }

    function setMiles($inputMiles)
    {
        $this->miles = $inputMiles;
    }

    function getPicture()
    {
        return $this->picture;
    }

    function setPicture($inputPicture)
    {
        $this->picture = $inputPicture;
    }
}

$porsche = new Car();
$porsche->setMakeModel("2014 Porsche 911");
$porsche->setPrice(114991);
$porsche->setMiles(7864);
$porsche->setPicture("img/porsche911.jpg");

$ford = new Car();
$ford->setMakeModel("2011 Ford F450");
$ford->setPrice(55995);
$ford->setMiles(14241);
$ford->setPicture("img/fordf450.jpg");

$lexus = new Car();
$lexus->setMakeModel("2013 Lexus RX 350");
$lexus->setPrice(44700);
$lexus->setMiles(20000);
$lexus->setPicture("img/lexus350.jpg");

$mercedes = new Car();
$mercedes->setMakeModel("Mercedes Benz CLS550");
$mercedes->setPrice(39900);
$mercedes->setMiles(37979);
$mercedes->setPicture("img/mercedescls550.jpg");

$cars = array($porsche, $ford, $lexus, $mercedes);

$cars_matching_search = array();
foreach ($cars as $car) {
    if ($car->worthBuying($_GET['price'], $_GET['mileage'])) {
        array_push($cars_matching_search, $car);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Car Dealership's Homepage</title>
</head>
<body>
    <h1>Your Car Dealership</h1>
    <ul>
        <?php
            if (empty($cars_matching_search)) {
                echo "Enter a higher number you cheap bastard.";
            }
            foreach ($cars_matching_search as $car) {
                echo "<li>".$car->getMakeModel()."</li>";
                echo "<ul>";
                    echo "<li> $".$car->getPrice()."</li>";
                    echo "<li> Miles: ".$car->getMiles()."</li>";
                    echo "<li> <img src='".$car->getPicture()."'> </li>";
                echo "</ul>";
            }
        ?>
    </ul>
</body>
</html>
