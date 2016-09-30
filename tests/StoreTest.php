<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";
    require_once "src/Brand.php";

    $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        function testSetStoreName()
        {
            // Assemble
            $store_name = "Payless";
            $id = 1;
            $test_store = new Store($store_name, $id);
            $test_store->setStoreName("Payless Shoesource");

            // Act
            $result = $test_store->getStoreName();

            // Assert
            $this->assertEquals("Payless Shoesource", $result);
        }
    }



?>
