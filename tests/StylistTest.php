<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Stylist.php";
    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);
    class StylistTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Stylist::deleteAll();
            Client::deleteAll();
        }

       function test_save()
        {
            //Arrange
            $name = "Jose Ebert";
            $test_Stylist = new Stylist($name);
            //Act
            $executed = $test_Stylist->save();
            // Assert
            $this->assertTrue($executed, "Stylist not successfully saved to database");
        }

        function test_getName()
        {
            //Arrange
            $name = "Jose Ebert";
            $test_Stylist = new Stylist($name);
            //Act
            $result = $test_Stylist->getName();
            //Assert
            $this->assertEquals($name, $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Jose Ebert";
            $test_Stylist = new Stylist($name);
            $test_Stylist->save();
            //Act
            $result = $test_Stylist->getId();
            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_getAll()
        {
             //Arrange
            $name = "Jose Ebert";
            $name2 = "Sally Hanson";
            $test_Stylist = new Stylist($name);
            $test_Stylist->save();
            $test_Stylist2 = new Stylist($name2);
            $test_Stylist2->save();
            //Act
            $result = Stylist::getAll();
            //Assert
            $this->assertEquals([$test_Stylist, $test_Stylist2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Jose Ebert";
            $name2 = "Sally Hanson";
            $test_Stylist = new Stylist($name);
            $test_Stylist->save();
            $test_Stylist2 = new Stylist($name2);
            $test_Stylist2->save();
            //Act
            Stylist::deleteAll();
            $result = Stylist::getAll();
            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $name = "Jose Ebert";
            $name2 = "Sally Hanson";
            $test_Stylist = new Stylist($name);
            $test_Stylist->save();
            $test_Stylist2 = new Stylist($name2);
            $test_Stylist2->save();
            //Act
            $result = Stylist::find($test_Stylist->getId());
            //Assert
            $this->assertEquals($test_Stylist, $result);
        }
    }
?>
