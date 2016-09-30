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
        protected function tearDown()
        {
            Store::deleteAll();
            Brand::deleteAll();
        }

        function testSetBrandName()
        {
            // Assemble
            $brand_name = "Nike";
            $id = 1;
            $price = 10.99;
            $available = true;
            $test_brand = new Brand($brand_name, $price, $available, $id);
            $test_brand->setBrandName("Reebok");

            // Act
            $result = $test_brand->getBrandName();

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
            $test_brand = new Brand($brand_name, $price, $available, $id);
            $test_brand->setPrice(19.99);

            // Act
            $result = $test_brand->getPrice();

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
            $test_brand = new Brand($brand_name, $price, $available, $id);
            $test_brand->setAvailable(false);

            // Act
            $result = $test_brand->getAvailable();

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
            $test_brand = new Brand($brand_name, $price, $available, $id);

            // Act
            $result = $test_brand->getId();

            // Assert
            $this->assertEquals(1, $result);
        }

        function testSave()
        {
            // Assemble
            $brand_name = "Nike";
            $id = null;
            $price = 10.99;
            $available = true;
            $test_brand = new Brand($brand_name, $price, $available, $id);
            $test_brand->save();

            // Act
            $result = Brand::getAll();

            // Assert
            $this->assertEquals($test_brand, $result[0]);
        }

        function testGetAll()
        {
            // Assemble
            $brand_name = "Nike";
            $id = null;
            $price = 10.99;
            $available = true;
            $test_brand = new Brand($brand_name, $price, $available, $id);
            $test_brand->save();

            $brand_name = "Converse";
            $id = null;
            $price = 22.95;
            $available = true;
            $test_brand2 = new Brand($brand_name, $price, $available, $id);
            $test_brand2->save();

            // Act
            $result = Brand::getAll();

            // Assert
            $this->assertEquals([$test_brand, $test_brand2], $result);
        }

        function updateBrandName()
        {
            // Assemble
            $brand_name = "Nike";
            $id = null;
            $price = 10.99;
            $available = true;
            $test_brand = new Brand($brand_name, $price, $available, $id);
            $test_brand->save();

            $new_brand_name = "Converse";
            $new_price = 22.95;
            $new_available = false;

            // Act
            $test_brand->update($new_brand_name, $new_price, $new_available);

            // Assert
            $this->assertEquals("Converse", $test_brand->getBrandName());
        }

        function updatePrice()
        {
            // Assemble
            $brand_name = "Nike";
            $id = null;
            $price = 10.99;
            $available = true;
            $test_brand = new Brand($brand_name, $price, $available, $id);
            $test_brand->save();

            $new_brand_name = "Converse";
            $new_price = 22.95;
            $new_available = false;

            // Act
            $test_brand->update($new_brand_name, $new_price, $new_available);

            // Assert
            $this->assertEquals(22.95, $test_brand->getPrice());
        }

        function updateAvailable()
        {
            // Assemble
            $brand_name = "Nike";
            $id = null;
            $price = 10.99;
            $available = true;
            $test_brand = new Brand($brand_name, $price, $available, $id);
            $test_brand->save();

            $new_brand_name = "Converse";
            $new_price = 22.95;
            $new_available = false;

            // Act
            $test_brand->update($new_brand_name, $new_price, $new_available);

            // Assert
            $this->assertEquals(false, $test_brand->getAvailable());
        }

        function testDeleteAll()
        {
            // Assemble
            $brand_name = "Nike";
            $id = null;
            $price = 10.99;
            $available = true;
            $test_brand = new Brand($brand_name, $price, $available, $id);
            $test_brand->save();

            $brand_name2 = "Converse";
            $id2 = null;
            $price2 = 21.95;
            $available2 = true;
            $test_brand2 = new Brand($brand_name2, $price2, $available2, $id2);
            $test_brand2->save();

            // Act
            Brand::deleteAll();
            $result = Brand::getAll();

            // Assert
            $this->assertEquals([], $result);
        }
    }

    function find()
    {
        // Assemble
        $brand_name = "Nike";
        $id = null;
        $price = 10.99;
        $available = true;
        $test_brand = new Brand($brand_name, $price, $available, $id);
        $test_brand->save();

        $brand_name2 = "Converse";
        $id2 = null;
        $price2 = 21.95;
        $available2 = true;
        $test_brand2 = new Brand($brand_name2, $price2, $available2, $id2);
        $test_brand2->save();

        // Act
        $result = Brand::find($test_brand2->getId());

        // Assert
        $this->assertEquals($test_brand2, $result);
    }

?>
