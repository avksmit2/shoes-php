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
        $this->price = (float)round($new_price,2);
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

    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO brands (brand_name, price, available) VALUES ('{$this->getBrandName()}', {$this->getPrice()}, {$this->getAvailable()});");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    static function getAll()
    {
        $brands = array();
        $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands ORDER BY price;");
        foreach($returned_brands as $brand) {
            $brand_name = $brand['brand_name'];
            $price = $brand['price'];
            $available = $brand['available'];
            $id = $brand['id'];
            $new_brand = new Brand($brand_name, (float)$price, (bool)$available, (int)$id);
            array_push($brands, $new_brand);
        }
        return $brands;
    }

    function updateBrand($new_brand_name, $new_price, $new_available)
    {
        $GLOBALS['DB']->exec("UPDATE brands SET brand_name = '{$new_brand_name}', price = {$new_price}, available = {$new_available};");
        $this->setBrandName($new_brand_name);
        $this->setPrice($new_price);
        $this->setAvailable($new_available);
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM brands;");
    }

    static function find($search_id)
    {
        $found_brand = null;
        $brands = Brand::getAll();
        foreach($brands as $brand) {
            $brand_id = $brand->getId();
            if ($brand_id == $search_id)
            {
                $found_brand = $brand;
            }
        }
        return $found_brand;
    }

    function addStore($store)
    {
        $GLOBALS['DB']->exec("INSERT INTO stores_brands (store_id, brand_id) VALUES ({$store->getId()}, {$this->getId()});");
    }

    function getStores()
    {
        $stores = array();
        $returned_stores = $GLOBALS['DB']->query("SELECT stores.* FROM brands JOIN stores_brands ON (stores_brands.brand_id = brands.id) JOIN stores ON (stores.id = stores_brands.store_id) WHERE brands.id = {$this->getId()};");
        foreach ($returned_stores as $store) {
            $store_name = $store['store_name'];
            $id = $store['id'];
            $new_store = new Store($store_name, $id);
            array_push($stores, $new_store);
        }
        return $stores;
    }

    function deleteBrand()
    {
        $GLOBALS['DB']->exec("DELETE FROM brands WHERE id = {$this->getId()};");
        $GLOBALS['DB']->exec("DELETE FROM stores_brands WHERE brand_id = {$this->getId()};");
    }
}
?>
