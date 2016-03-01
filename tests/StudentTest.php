<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Student.php";

    $server = 'mysql:host=localhost;dbname=university_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class StudentTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Student::deleteAll();
            Course::deleteAll();
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

        function test_delete()
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
            $test_student->deleteStudent();

            //Assert
            $this->assertEquals([$test_student2], Student::getAll());
        }

        function test_findStudent()
        {
            //Arrange
            $name = "Bob Morley";
            $enroll_date = "2014-08-20";
            $id = null;
            $test_student = new Student ($name, $enroll_date, $id);
            $test_student->save();

            //Act
            $result = Student::findStudent($test_student->getId());

            //Assert
            $this->assertEquals($test_student, $result);
        }

        function test_addCourse()
        {
          //Arrange
          $course_name = "International Relations";
          $course_number = "BUS250";
          $id = null;
          $test_course = new Course ($course_name, $course_number, $id);
          $test_course->save();


          $name = "Bob Morley";
          $enroll_date = "2014-08-20";
          $id = null;
          $test_student = new Student($name, $enroll_date, $id);
          $test_student->save();

          //Act
          $test_student->addCourse($test_course);

          //Assert
          $this->assertEquals($test_student->getCourses(), [$test_course]);
        }

        function test_getCourses()
        {
            //Arrange

            $name = "Bob Morley";
            $enroll_date = "2014-08-20";
            $id = null;
            $test_student = new Student($name, $enroll_date, $id);
            $test_student->save();

            $course_name = "International Relations";
            $course_number = "BUS250";
            $test_course = new Course ($course_name, $course_number, $id);
            $test_course->save();

            $course_name2 = "Fiscal Policy";
            $course_number2 = "BUS260";
            $test_course2 = new Course ($course_name2, $course_number2, $id);
            $test_course2->save();

            //Act
            $test_student->addCourse($test_course);
            $test_student->addCourse($test_course2);

            //Assert
            $this->assertEquals([$test_course, $test_course2], $test_student->getCourses());
        }

    }

?>
