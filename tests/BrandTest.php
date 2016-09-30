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
            $price = 10.99;
            $available = true;
            $test_store = new Brand($brand_name, $price, $available, $id);
            $test_store->setBrandName("Reebok");

            // Act
            $result = $test_store->getBrandName();

            // Assert
            $this->assertEquals("Reebok", $result);
        }

        function testSetPrice()
        {
            // Assemble
            $brand_name = "Nike";
            $id = 1;
            $price = 10.99;
            $available = true;
            $test_store = new Brand($brand_name, $price, $available, $id);
            $test_store->setPrice(19.99);

            // Act
            $result = $test_store->getPrice();

            // Assert
            $this->assertEquals(19.99, $result);
        }

        function testSetAvailable()
        {
            // Assemble
            $brand_name = "Nike";
            $id = 1;
            $price = 10.99;
            $available = true;
            $test_store = new Brand($brand_name, $price, $available, $id);
            $test_store->setAvailable(false);

            // Act
            $result = $test_store->getAvailable();

            // Assert
            $this->assertEquals(false, $result);
        }

        function testGetId()
        {
            // Assemble
            $brand_name = "Nike";
            $id = 1;
            $price = 10.99;
            $available = true;
            $test_store = new Brand($brand_name, $price, $available, $id);

            // Act
            $result = $test_store->getId();

            // Assert
            $this->assertEquals(1, $result);
        }
    }



?>
