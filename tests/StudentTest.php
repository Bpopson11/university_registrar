<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Student.php";

    $server = 'mysql:host=localhost;dbname=university';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class StudentTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Student::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "Bob Morley";
            $enroll_date = "2014-8-20";
            $id = null;
            $test_student = new Student ($name, $enroll_date, $id);

            //Act
            $result = $test_student->getName();

            //Assert
            $this->assertEquals("Bob Morley", $result);
        }

        function test_getEnroll_date()
        {
            //Arrange
            $name = "Bob Morley";
            $enroll_date = "2014-8-20";
            $id = null;
            $test_student = new Student ($name, $enroll_date, $id);

            //Act
            $result = $test_student->getEnroll_date();

            //Assert
            $this->assertEquals("2014-8-20", $result);
        }

    }

?>
