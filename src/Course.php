<?php
class Course
{
    private $course_name;
    private $course_number;
    private $id;


    function __construct($course_name, $course_number, $id = null)
    {
        $this->course_name = $course_name;
        $this->course_number = $course_number;
        $this->id = $id;
    }

    function setCourse_name($new_course_name)
    {
        $this->course_name = (string) $new_course_name;
    }

    function getCourse_name()
    {
        return $this->course_name;
    }

    function setCourse_number($new_number)
    {
        $this->course_number = $new_number;
    }

    function getCourse_number()
    {
        return $this->course_number;
    }

    function getId()
    {
        return $this->id;
    }

    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO courses (course_name, course_number) VALUES ('{$this->getCourse_name()}', '{$this->getCourse_number()}')");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM courses;");
    }

    static function getAll()
    {
        $returned_courses = $GLOBALS['DB']->query("SELECT * FROM courses;");
        $courses = array();
        foreach ($returned_courses as $course) {
            $course_name = $course['course_name'];
            $course_number = $course['course_number'];
            $id = $course['id'];
            $new_course = new Course($course_name, $course_number, $id);
            array_push($courses, $new_course);
        }
        return $courses;
    }

    function deleteCourse()
    {
        $GLOBALS['DB']->exec("DELETE FROM courses WHERE id = {$this->getId()};");
    }

    function updateCourseName($new_course_name)
    {
        $GLOBALS['DB']->exec("UPDATE courses SET course_name = '{$new_course_name}' WHERE id = {$this->getId()};");
        $this->setCourse_name($new_course_name);
    }

    static function findCourse($search_id)
    {
        $found_course = null;
        $courses = Course::getAll();
        foreach($courses as $course) {
            $course_id = $course->getId();
            if ($course_id == $search_id) {
                $found_course = $course;
            }
        }
        return $found_course;
    }

    function addStudent($student)
    {
        $GLOBALS['DB']->exec("INSERT INTO roster (student_id, course_id)  VALUES ({$student->getId()}, {$this->getId()});");
    }

    function getStudents()
    {
        $returned_students = $GLOBALS['DB']->query("SELECT students.* FROM courses
          JOIN roster ON (courses.id = roster.course_id)
          JOIN students ON (roster.student_id = students.id)
          WHERE courses.id = {$this->getId()};");

        $students = array();

        foreach($returned_students as $student) {
            $name = $student['name'];
            $enroll_date = $student['enroll_date'];
            $id = $student['id'];
            $new_student = new Student($name, $enroll_date, $id);
            array_push($students, $new_student);
        }
        return $students;
    }



  }
?>
