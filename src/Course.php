<?php
class Course
{
    private $name;
    private $course_number;
    private $id;


    function __construct($name, $course_number, $id = null)
    {
        $this->name = $name;
        $this->course_number = $course_number;
        $this->id = $id;
    }

    function setName($new_name)
    {
        $this->name = (string) $new_name;
    }

    function getName()
    {
        return $this->name;
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
        $GLOBALS['DB']->exec("INSERT INTO courses (name, course_number) VALUES ('{$this->getName()}', '{$this->getCourse_number()}')");
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
            $name = $course['name'];
            $course_number = $course['course_number'];
            $id = $course['id'];
            $new_course = new Course($name, $course_number, $id);
            array_push($courses, $new_course);
        }
        return $courses;
    }

    function deleteCourse()
    {
        $GLOBALS['DB']->exec("DELETE FROM courses WHERE id = {$this->getId()};");
    }

    function updateCourseName($new_name)
    {
        $GLOBALS['DB']->exec("UPDATE courses SET name = '{$new_name}' WHERE id = {$this->getId()};");
        $this->setName($new_name);
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

  }
?>
