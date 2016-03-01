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

    //home page to show students

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




      return $app;


?>
