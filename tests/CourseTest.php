<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Course.php";

    $server = 'mysql:host=localhost;dbname=university';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class CourseTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Course::deleteAll();
            Student::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "International Relations";
            $course_number = "BUS250";
            $id = null;
            $test_course = new Course ($name, $course_number, $id);

            //Act
            $result = $test_course->getName();

            //Assert
            $this->assertEquals("International Relations", $result);
        }

        function test_getCourse_number()
        {
            //Arrange
            $name = "International Relations";
            $course_number = "BUS250";
            $id = null;
            $test_course = new Course ($name, $course_number, $id);

            //Act
            $result = $test_course->getCourse_number();

            //Assert
            $this->assertEquals("BUS250", $result);
        }

        function test_getAll()
        {
            //Arrange
            $name = "International Relations";
            $course_number = "BUS250";
            $id = null;
            $test_course = new Course ($name, $course_number, $id);
            $test_course->save();

            $name2 = "Fiscal Policy";
            $course_number2 = "BUS260";
            $id = null;
            $test_course2 = new Course ($name2, $course_number2, $id);
            $test_course2->save();

            //Act
            $result = Course::getAll();

            //Assert
            $this->assertEquals([$test_course, $test_course2], $result);
        }

        function test_update()
        {
            //Arrange
            $name = "International Relations";
            $course_number = "BUS250";
            $id = null;
            $test_course = new Course ($name, $course_number, $id);
            $test_course->save();

            $new_name = "International Business Relations";

            //Act
            $test_course->updateCourseName($new_name);

            //Assert
            $this->assertEquals("International Business Relations", $test_course->getName());
        }

        function test_delete()
        {
            //Arrange
            $name = "International Relations";
            $course_number = "BUS250";
            $id = null;
            $test_course = new Course ($name, $course_number, $id);
            $test_course->save();

            $name2 = "Fiscal Policy";
            $course_number2 = "BUS260";
            $id = null;
            $test_course2 = new Course ($name2, $course_number2, $id);
            $test_course2->save();


            //Act
            $test_course->deleteCourse();

            //Assert
            $this->assertEquals([$test_course2], Course::getAll());
        }

        function test_findCourse()
        {
            //Arrange
            $name = "International Relations";
            $course_number = "BUS250";
            $id = null;
            $test_course = new Course ($name, $course_number, $id);
            $test_course->save();

            //Act
            $result = Course::findCourse($test_course->getId());

            //Assert
            $this->assertEquals($test_course, $result);
        }

    }

?>
