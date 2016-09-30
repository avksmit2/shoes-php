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
        protected function tearDown()
        {
            Store::deleteAll();
            Brand::deleteAll();
        }

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

        function testGetId()
        {
            // Assemble
            $store_name = "Payless";
            $id = 1;
            $test_store = new Store($store_name, $id);

            // Act
            $result = $test_store->getId();

            // Assert
            $this->assertEquals(1, $result);
        }

        function testSave()
        {
            // Assemble
            $store_name = "Payless";
            $id = null;
            $test_store = new Store($store_name, $id);
            $test_store->save();

            // Act
            $result = Store::getAll();

            // Assert
            $this->assertEquals($test_store, $result[0]);
        }

        function testGetAll()
        {
            // Assemble
            $store_name = "Payless";
            $id = null;
            $test_store = new Store($store_name, $id);
            $test_store->save();

            $store_name2 = "Famous Footwear";
            $id2 = null;
            $test_store2 = new Store($store_name2, $id2);
            $test_store2->save();

            // Act
            $result = Store::getAll();

            // Assert
            $this->assertEquals([$test_store, $test_store2], $result);
        }

        function testUpdate()
        {
            // Assemble
            $store_name = "Payless";
            $id = null;
            $test_store = new Store($store_name, $id);
            $test_store->save();

            $new_store_name = "Payless Shoesource";

            // Act
            $test_store->updateStore($new_store_name);

            // Assert
            $this->assertEquals("Payless Shoesource", $test_store->getStoreName());
        }

        function testDeleteAll()
        {
            // Assemble
            $store_name = "Payless";
            $id = null;
            $test_store = new Store($store_name, $id);
            $test_store->save();

            $store_name2 = "Famous Footwear";
            $id2 = null;
            $test_store2 = new Store($store_name2, $id2);
            $test_store2->save();

            // Act
            Store::deleteAll();
            $result = Store::getAll();

            // Assert
            $this->assertEquals([], $result);
        }

        function testFind()
        {
            // Assemble
            $store_name = "Payless";
            $id = null;
            $test_store = new Store($store_name, $id);
            $test_store->save();

            $store_name2 = "Famous Footwear";
            $id2 = null;
            $test_store2 = new Store($store_name2, $id2);
            $test_store2->save();

            // Act
            $result = Store::find($test_store2->getId());

            // Assert
            $this->assertEquals($test_store2, $result);
        }

        function testAddBrand()
        {
            // Assemble
            $store_name = "Payless";
            $id = null;
            $test_store = new Store($store_name, $id);
            $test_store->save();

            $brand_name = "Nike";
            $id = null;
            $price = 10.99;
            $available = true;
            $test_brand = new Brand($brand_name, $price, $available, $id);
            $test_brand->save();

            // Act
            $test_store->addBrand($test_brand);

            // Assert
            $this->assertEquals([$test_brand], $test_store->getBrands());
        }

        function testDeleteStore()
        {
            // Assemble
            $store_name = "Payless";
            $id = null;
            $test_store = new Store($store_name, $id);
            $test_store->save();

            $store_name2 = "Famous Footwear";
            $id2 = null;
            $test_store2 = new Store($store_name2, $id2);
            $test_store2->save();

            // Act
            $test_store2->deleteStore();
            $result = Store::getAll();

            // Assert
            $this->assertEquals([$test_store], $result);
        }

        function testDeleteStoreBrand()
        {
            // Assemble
            $store_name = "Payless";
            $id = null;
            $test_store = new Store($store_name, $id);
            $test_store->save();

            $brand_name = "Nike";
            $id = null;
            $price = 10.99;
            $available = true;
            $test_brand = new Brand($brand_name, $price, $available, $id);
            $test_brand->save();
            $test_store->addBrand($test_brand);

            // Act
            $test_store->deleteStore();
            $result = $test_store->getBrands();

            // Assert
            $this->assertEquals([], $result);
        }
    }
?>
