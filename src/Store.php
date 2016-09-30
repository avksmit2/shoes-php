<?php
class Store
{
    private $store_name;
    private $id;

    function __construct($store_name, $id=null)
    {
        $this->store_name = $store_name;
        $this->id = $id;
    }

    function setStoreName($new_store_name)
    {
        $this->store_name = $new_store_name;
    }

    function getStoreName()
    {
        return $this->store_name;
    }

    function getId()
    {
        return $this->id;
    }

    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO stores (store_name) VALUES ('{$this->getStoreName()}');");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    static function getAll()
    {
        $stores = array();
        $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
        foreach($returned_stores as $store) {
            $store_name = $store['store_name'];
            $id = $store['id'];
            $new_store = new Store($store_name, $id);
            array_push($stores, $new_store);
        }
        return $stores;
    }

    function updateStore($new_store_name)
    {
        $GLOBALS['DB']->exec("UPDATE stores SET store_name = '{$new_store_name}';");
        $this->setStoreName($new_store_name);
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM stores;");
    }

    static function find($search_id)
    {
        $found_store = null;
        $stores = Store::getAll();
        foreach($stores as $store) {
            $store_id = $store->getId();
            if ($store_id = $search_id)
            {
                $found_store = $store;
            }
        }
        return $found_store;
    }

    function addBrand($brand)
    {
        $GLOBALS['DB']->exec("INSERT INTO stores_brands (store_id, brand_id) VALUES ({$this->getId()}, {$brand->getId()});");
    }

    function getBrands()
    {
        $brands = array();
        $returned_brands = $GLOBALS['DB']->query("SELECT brands.* FROM stores JOIN stores_brands ON (stores_brands.store_id = stores.id) JOIN brands ON (brands.id = stores_brands.brand_id) WHERE stores.id = {$this->getId()};");
        foreach($returned_brands as $brand) {
            $brand_name = $brand['brand_name'];
            $price = $brand['price'];
            $available = $brand['available'];
            $id = $brand['id'];
            $new_brand = new Brand($brand_name, $price, $available, $id);
            array_push($brands, $new_brand);
        }
        return $brands;
    }

    function deleteStore()
    {
        $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
        $GLOBALS['DB']->exec("DELETE FROM stores_brands WHERE store_id = {$this->getId()};");
    }
}
?>
