<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Student.php";
    require_once __DIR__."/../src/Course.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost;dbname=university';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


  	use Symfony\Component\HttpFoundation\Request;
  	Request::enableHttpMethodParameterOverride();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    $app['debug'] = true;


    $app->get("/", function() use ($app)
    {
        return $app['twig']->render('index.html.twig', array('students' => Student::getAll(), 'courses' => Course::getAll()));
    });

    $app->get("/students", function() use ($app)
    {
        return $app['twig']->render('index.html.twig', array('students' => Student::getAll()));
    });

    $app->get("/courses", function() use ($app)
    {
        return $app['twig']->render('index.html.twig', array('courses' => Course::getAll()));
    });

    $app->post("/students", function() use ($app)
    {
        $student = new Student($_POST['name'], $_POST['enroll_date']);
        $student->save();
        return $app['twig']->render('index.html.twig', array('students' => Student::getAll(), 'courses' => Course::getAll()));
    });

    $app->post("/courses", function() use ($app)
    {
        $course = new Course($_POST['course_name'], $_POST['course_number']);
        $course->save();
        return $app['twig']->render('index.html.twig', array('courses' => Course::getAll(), 'students' => Student::getAll()));
    });

    $app->get("/students/{id}", function($id) use ($app)
    {
        $student = Student::findStudent($id);
        return $app['twig']->render('students.html.twig', array('student' => $student, 'students' => Student::getAll(), 'courses'=>$student->getCourses(), 'all_courses'=> Course::getAll()));
    });

    $app->get("/courses/{id}", function($id) use ($app)
    {
       $course = Course::findCourse($id);
        return $app['twig']->render('courses.html.twig', array('course'=>$course, 'courses' => Course::getAll(), 'students' => $course->getStudents(), 'all_students' => Student::getAll()));
    });

    $app->post("/delete_all_students", function() use ($app) {
        Student::deleteAll();
        return $app['twig']->render('index.html.twig', array('courses' =>Course::getAll(), 'students' =>Student::getAll()));
    });

    $app->post("/{id}/deleteStudent", function($id) use ($app) {
        $student = Student::findStudent($id);
        $student->deleteStudent();
        return $app['twig']->render('index.html.twig', array('courses' =>Course::getAll(), 'students' =>Student::getAll()));
    });

    $app->post("/{id}/deleteCourse", function($id) use ($app) {
        $course = Course::findCourse($id);
        $course->deleteCourse();
        return $app['twig']->render('index.html.twig', array('courses' =>Course::getAll(), 'students' =>Student::getAll()));
    });

    $app->post("/delete_all_courses", function() use ($app) {
        Course::deleteAll();
        return $app['twig']->render('index.html.twig', array('students' =>Student::getAll(), 'courses' =>Course::getAll()));
    });

    $app->post("/add_course", function() use ($app) {
        $course = Course::findCourse($_POST['course_id']);
        $student = Student::findStudent($_POST['student_id']);
        $student->addCourse($course);
        return $app['twig']->render('students.html.twig', array('student' => $student, 'students' => Student::getAll(), 'courses'=>$student->getCourses(), 'all_courses'=> Course::getAll()));
    });

    $app->post("/add_student", function() use ($app) {
        $student = Student::findStudent($_POST['student_id']);
        $course = Course::findCourse($_POST['course_id']);
        $course->addStudent($student);
        return $app['twig']->render('courses.html.twig', array('course' => $course, 'courses' => Course::getAll(), 'students'=>$course->getStudents(), 'all_students'=> Student::getAll()));
    });


      return $app;


?>
