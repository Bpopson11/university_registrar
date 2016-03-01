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

  }
?>
