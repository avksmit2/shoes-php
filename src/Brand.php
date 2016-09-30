<?php
class
{
    private $brand_name;
    private $price;
    private $available;
    private $id;

    function __construct($brand_name, $price, $available=1, $id=null)
    {
        $this->brand_name = $brand_name;
        $this->price = $price;
        $this->available = $available;
        $this->id = $id;
    }

    function setBrandName($new_brand_name)
    {
        $this->brand_name = $new_brand_name;
    }

    function getBrandName()
    {
        return $this->brand_name;
    }
}
?>
