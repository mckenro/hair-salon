<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Client.php";
    require_once "src/Stylist.php";
    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);
    class ClientTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
          Stylist::deleteAll();
          Client::deleteAll();
        }

        // function test_getId()
        // {
        //     //Arrange
        //     $name = "Jose Ebert";
        //     $test_category = new Category($name);
        //     $test_category->save();
        //     $description = "Wash the dog";
        //     $category_id = $test_category->getId();
        //     $test_task = new Task($description, $category_id);
        //     $test_task->save();
        //     //Act
        //     $result = $test_task->getId();
        //     //Assert
        //     $this->assertEquals(true, is_numeric($result));
        // }
        //
        // function test_getDescription()
        // {
        //     //Arrange
        //     $name = "Jose Ebert";
        //     $test_category = new Category($name);
        //     $test_category->save();
        //     $category_id = $test_category->getId();
        //     $description = "Watch the new Thor movie.";
        //     $test_task = new Task($description, $category_id);
        //     //Act
        //     $result = $test_task->getDescription();
        //     //Assert
        //     $this->assertEquals($description, $result);
        // }
        //
        // function test_setDescription()
        // {
        //     //Arrange
        //     $name = "Jose Ebert";
        //     $test_category = new Category($name);
        //     $test_category->save();
        //     $category_id = $test_category->getId();
        //     $description = "Watch the new Thor movie.";
        //     $test_task = new Task($description, $category_id);
        //     $new_description = "Watch the new Star Wars movie.";
        //     //Act
        //     $test_task->setDescription($new_description);
        //     $result = $test_task->getDescription();
        //     //Assert
        //     $this->assertEquals($new_description, $result);
        // }
        //
        function test_getStylistId()
        {
            //Arrange
            $name = "Jose Ebert";
            $test_stylist = new Stylist($name);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();
            $client_name = "Watch the new Thor movie.";
            $test_client = new Client($client_name, $stylist_id);
            //Act
            $result = $test_client->getStylistId();
            //Assert
            $this->assertEquals($stylist_id, $result);
        }

        function test_setStylistId()
        {
            //Arrange
            $name = "Jose Ebert";
            $test_stylist = new Stylist($name);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $name2 = "Sally Hanson";
            $test_stylist2 = new Stylist($name2);
            $test_stylist2->save();
            $stylist_id2 = $test_stylist2->getId();
            $client_name = "Watch the new Thor movie.";
            $test_client = new Client($client_name, $stylist_id);
            //Act
            $test_client->setStylistId($stylist_id2);
            $result = $test_client->getStylistId();
            //Assert
            $this->assertEquals($stylist_id2, $result);
        }

        function test_save()
        {
            //Arrange
            $name = "Jose Ebert";
            $test_stylist = new Stylist($name);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();
            $client_name = "Mary Poppins";
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();
            //Act
            $result = Client::getAll();
            //Assert
            $this->assertEquals($test_client, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Jose Ebert";
            $test_stylist = new Stylist($name);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $client_name = "Mary Poppins";
            $client_name2 = "Pippi Longstocking";
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();
            $test_client2 = new Client($client_name2, $stylist_id);
            $test_client2->save();
            //Act
            $result = Client::getAll();
            //Assert
            $this->assertEquals([$test_client, $test_client2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Jose Ebert";
            $test_stylist = new Stylist($name);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();
            // create more than one task
            $client_name = "Mary Poppins";
            $client_name2 = "Pippi Longstocking";
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();
            $test_client2 = new Client($client_name2, $stylist_id);
            $test_client2->save();
            //Act
            Client::deleteAll();
            $result = Client::getAll();
            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $name = "Jose Ebert";
            $test_stylist = new Stylist($name);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();
            $client_name = "Mary Poppins";
            $client_name2 = "Pippi Longstocking";
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();
            $test_client2 = new Client($client_name2, $stylist_id);
            $test_client2->save();
            //Act
            $result = Client::find($test_client->getId());
            //Assert
            $this->assertEquals($test_client, $result);
        }
    }
?>
