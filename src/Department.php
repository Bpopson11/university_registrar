<?php
class Department
{
    private $department_name;
    private $id;


    function __construct($department_name, $id = null)
    {
        $this->department_name = $department_name;
        $this->id = $id;
    }

    function setDepartment_name($new_department_name)
    {
        $this->department_name = (string) $new_department_name;
    }

    function getDepartment_name()
    {
        return $this->department_name;
    }

    function getId()
    {
        return $this->id;
    }

    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO departments (department_name) VALUES ('{$this->getdepartment_name()}');");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM departments;");
    }

    static function getAll()
    {
        $returned_departments = $GLOBALS['DB']->query("SELECT * FROM departments;");
        $departments = array();
        foreach ($returned_departments as $department) {
            $department_name = $department['department_name'];
            $id = $department['id'];
            $new_department = new Department($department_name, $id);
            array_push($departments, $new_department);
        }
        return $departments;
    }

    function deletedepartment()
    {
        $GLOBALS['DB']->exec("DELETE FROM departments WHERE id = {$this->getId()};");
        $GLOBALS['DB']->exec("DELETE FROM roster WHERE department_id = {$this->getId()};");
    }

    function updatedepartmentName($new_department_name)
    {
        $GLOBALS['DB']->exec("UPDATE departments SET department_name = '{$new_department_name}' WHERE id = {$this->getId()};");
        $this->setdepartment_name($new_department_name);
    }

    static function findDepartment($search_id)
    {
        $found_department = null;
        $departments = Department::getAll();
        foreach($departments as $department) {
            $department_id = $department->getId();
            if ($department_id == $search_id) {
                $found_department = $department;
            }
        }
        return $found_department;
    }

    function addStudent($student)
    {
        $GLOBALS['DB']->exec("INSERT INTO roster (student_id, department_id)  VALUES ({$student->getId()}, {$this->getId()});");
    }

    function addCourse($course)
    {
        $GLOBALS['DB']->exec("INSERT INTO roster (course_id, department_id)  VALUES ({$course->getId()}, {$this->getId()});");
    }

    function getStudents()
    {
        $returned_students = $GLOBALS['DB']->query("SELECT students.* FROM departments
          JOIN roster ON (departments.id = roster.department_id)
          JOIN students ON (roster.student_id = students.id)
          WHERE departments.id = {$this->getId()};");

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

    function getCourses()
    {
        $returned_courses = $GLOBALS['DB']->query("SELECT courses.* FROM departments
          JOIN roster ON (departments.id = roster.department_id)
          JOIN courses ON (roster.course_id = courses.id)
          WHERE departments.id = {$this->getId()};");

        $courses = array();

        foreach($returned_courses as $course) {
            $course_name = $course['name'];
            $course_number = $course['enroll_date'];
            $id = $course['id'];
            $new_course = new Course($course_name, $course_number, $id);
            array_push($courses, $new_course);
        }
        return $courses;
    }

  }
?>
