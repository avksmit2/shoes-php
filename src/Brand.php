<?php
class Brand
{
    private $brand_name;
    private $price;
    private $available;
    private $id;

    function __construct($brand_name, $price, $available=true, $id=null)
    {
        $this->brand_name = $brand_name;
        $this->price = $price;
        $this->available = $available;
        $this->id = $id;
    }

    function setBrandName($new_brand_name)
    {
        $this->brand_name = (string)ucwords($new_brand_name);
    }

    function getBrandName()
    {
        return $this->brand_name;
    }

    function setPrice($new_price)
    {
        $this->price = (float)$new_price;
    }

    function getPrice()
    {
        return $this->price;
    }

    function setAvailable($new_available)
    {
        $this->available = (bool)$new_available;
    }

    function getAvailable()
    {
        return $this->available;
    }

    function getId()
    {
        return $this->id;
    }


}
?>
