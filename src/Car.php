<?php
class Car
{
    private $make_model;
    private $price;
    private $miles;
    private $picture;

    function __construct($make, $price, $miles, $image)
    {
        $this->make_model = $make;
        $this->price = $price;
        $this->miles = $miles;
        $this->picture = $image;
    }

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

    function save()
    {
        array_push($_SESSION['cars'], $this);
    }

    static function getAll()
    {
        return $_SESSION['cars'];
    }

    static function deleteAll()
    {
        $_SESSION['cars'] = array();
    }
}
?>
