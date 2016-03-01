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

        function test_getAll()
        {
            //Arrange
            $name = "Bob Morley";
            $enroll_date = "2014-08-20";
            $id = null;
            $test_student = new Student ($name, $enroll_date, $id);
            $test_student->save();

            $name2 = "Octavia Blake";
            $enroll_date2 = "2015-08-20";
            $id = null;
            $test_student2 = new Student ($name2, $enroll_date2, $id);
            $test_student2->save();

            //Act
            $result = Student::getAll();

            //Assert
            $this->assertEquals([$test_student, $test_student2], $result);
        }

        function test_update()
        {
            //Arrange
            $name = "Bob Morley";
            $enroll_date = "2014-08-20";
            $id = null;
            $test_student = new Student ($name, $enroll_date, $id);
            $test_student->save();

            $new_name = "Bellamy Blake";

            //Act
            $test_student->updateStudentName($new_name);

            //Assert
            $this->assertEquals("Bellamy Blake", $test_student->getName());
        }

    }

?>
