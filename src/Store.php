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
}
?>
