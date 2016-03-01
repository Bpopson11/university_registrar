<?php
class Student
{
    private $name;
    private $enroll_date;
    private $id;


    function __construct($name, $enroll_date, $id = null)
    {
        $this->name = $name;
        $this->enroll_date = $enroll_date;
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

    function setEnroll_date($new_date)
    {
        $this->enroll_date = $new_date;
    }

    function getEnroll_date()
    {
        return $this->enroll_date;
    }

    function getId()
    {
        return $this->id;
    }

    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO students (name, enroll_date) VALUES ('{$this->getName()}', '{$this->getEnroll_date()}')");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM students;");
    }

    static function getAll()
    {
        $returned_students = $GLOBALS['DB']->query("SELECT * FROM students;");
        $students = array();
        foreach ($returned_students as $student) {
            $name = $student['name'];
            $enroll_date = $student['enroll_date'];
            $id = $student['id'];
            $new_student = new Student($name, $enroll_date, $id);
            array_push($students, $new_student);
        }
        return $students;
    }

    function deleteStudent()
    {
        $GLOBALS['DB']->exec("DELETE FROM students WHERE id = {$this->getId()};");
    }

    function updateStudentName($new_name)
    {
        $GLOBALS['DB']->exec("UPDATE students SET name = '{$new_name}' WHERE id = {$this->getId()};");
        $this->setName($new_name);
    }

    static function findStudent($search_id)
    {
        $found_student = null;
        $students = Student::getAll();
        foreach($students as $student) {
            $student_id = $student->getId();
            if ($student_id == $search_id) {
                $found_student = $student;
            }
        }
        return $found_student;
    }

  }
?>
