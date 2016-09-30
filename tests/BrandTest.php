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

    class BrandTest extends PHPUnit_Framework_TestCase
    {
        function testSetBrandName()
        {
            // Assemble
            $brand_name = "Nike";
            $id = 1;
            $test_store = new Store($brand_name, $id);
            $test_store->setBrandName("Reebok");

            // Act
            $result = $test_store->getBrandName();

            // Assert
            $this->assertEquals("Reebok", $result);
        }
    }



?>
