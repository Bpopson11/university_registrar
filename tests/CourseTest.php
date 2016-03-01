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

        function test_getCourse_name()
        {
            //Arrange
            $course_name = "International Relations";
            $course_number = "BUS250";
            $id = null;
            $test_course = new Course($course_name, $course_number, $id);

            //Act
            $result = $test_course->getCourse_name();

            //Assert
            $this->assertEquals("International Relations", $result);
        }

        function test_getCourse_number()
        {
            //Arrange
            $course_name = "International Relations";
            $course_number = "BUS250";
            $id = null;
            $test_course = new Course($course_name, $course_number, $id);

            //Act
            $result = $test_course->getCourse_number();

            //Assert
            $this->assertEquals("BUS250", $result);
        }

        function test_getAll()
        {
            //Arrange
            $course_name = "International Relations";
            $course_number = "BUS250";
            $id = null;
            $test_course = new Course($course_name, $course_number, $id);
            $test_course->save();

            $course_name2 = "Fiscal Policy";
            $course_number2 = "BUS260";
            $id = null;
            $test_course2 = new Course($course_name2, $course_number2, $id);
            $test_course2->save();

            //Act
            $result = Course::getAll();

            //Assert
            $this->assertEquals([$test_course, $test_course2], $result);
        }

        function test_update()
        {
            //Arrange
            $course_name = "International Relations";
            $course_number = "BUS250";
            $id = null;
            $test_course = new Course($course_name, $course_number, $id);
            $test_course->save();

            $new_course_name = "International Business Relations";

            //Act
            $test_course->updateCourseName($new_course_name);

            //Assert
            $this->assertEquals("International Business Relations", $test_course->getCourse_name());
        }

        function test_delete()
        {
            //Arrange
            $course_name = "International Relations";
            $course_number = "BUS250";
            $id = null;
            $test_course = new Course ($course_name, $course_number, $id);
            $test_course->save();

            $course_name2 = "Fiscal Policy";
            $course_number2 = "BUS260";
            $id = null;
            $test_course2 = new Course ($course_name2, $course_number2, $id);
            $test_course2->save();


            //Act
            $test_course->deleteCourse();

            //Assert
            $this->assertEquals([$test_course2], Course::getAll());
        }

        function test_findCourse()
        {
            //Arrange
            $course_name = "International Relations";
            $course_number = "BUS250";
            $id = null;
            $test_course = new Course ($course_name, $course_number, $id);
            $test_course->save();

            //Act
            $result = Course::findCourse($test_course->getId());

            //Assert
            $this->assertEquals($test_course, $result);
        }

        function test_addStudent()
        {
          //Arrange
          $course_name = "International Relations";
          $course_number = "BUS250";
          $id = null;
          $test_course = new Course ($course_name, $course_number, $id);
          $test_course->save();


          $name = "Bob Morley";
          $enroll_date = "2014-08-20";
          $test_student = new Student($name, $enroll_date, $id);
          $test_student->save();

          //Act
          $test_course->addStudent($test_student);

          //Assert
          $this->assertEquals($test_course->getStudents(), [$test_student]);
        }

        function test_getStudents()
        {
            //Arrange
            $course_name = "International Relations";
            $course_number = "BUS250";
            $id = null;
            $test_course = new Course ($course_name, $course_number, $id);
            $test_course->save();
            
            $name = "Bob Morley";
            $enroll_date = "2014-08-20";
            $test_student = new Student($name, $enroll_date, $id);
            $test_student->save();

            $name2 = "Octavia Blake";
            $enroll_date2 = "2015-08-20";
            $test_student2 = new Student($name2, $enroll_date2, $id);
            $test_student2->save();

            //Act
            $test_course->addStudent($test_student);
            $test_course->addStudent($test_student2);

            //Assert
            $this->assertEquals([$test_student, $test_student2], $test_course->getStudents());
        }

    }

?>
