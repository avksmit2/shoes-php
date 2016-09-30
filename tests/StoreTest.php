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
    }



?>
