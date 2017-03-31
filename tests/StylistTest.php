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
            // Client::deleteAll();
        }

       function test_save()
        {
            //Arrange
            $name = "Mary Poppins";
            $test_Stylist = new Stylist($name);
            //Act
            $executed = $test_Stylist->save();
            // Assert
            $this->assertTrue($executed, "Stylist not successfully saved to database");
        }

        // function test_getName()
        // {
        //     //Arrange
        //     $name = "Work stuff";
        //     $test_Category = new Category($name);
        //     //Act
        //     $result = $test_Category->getName();
        //     //Assert
        //     $this->assertEquals($name, $result);
        // }
        //
        // function test_getId()
        // {
        //     //Arrange
        //     $name = "Work stuff";
        //     $test_Category = new Category($name);
        //     $test_Category->save();
        //     //Act
        //     $result = $test_Category->getId();
        //     //Assert
        //     $this->assertEquals(true, is_numeric($result));
        // }
        //
        function test_getAll()
        {
             //Arrange
            $name = "Mary Poppins";
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
            $name = "Mary Poppins";
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

        // function test_find()
        // {
        //     //Arrange
        //     $name = "Wash the dog";
        //     $name2 = "Home stuff";
        //     $test_Category = new Category($name);
        //     $test_Category->save();
        //     $test_Category2 = new Category($name2);
        //     $test_Category2->save();
        //     //Act
        //     $result = Category::find($test_Category->getId());
        //     //Assert
        //     $this->assertEquals($test_Category, $result);
        // }
    }
?>
