<?php
    // turns on error reporting
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    // requires autoload file
    require_once('vendor/autoload.php');

    // starts a session
    session_start();

    // instantiates f3
    $f3 = Base::instance();

    // turn on f3 error reporting
    $f3->set('DEBUG', 3);

    // defines an array of valid colors and assign it to a Fat-Free variable
    $f3->set('colors', array('pink', 'green', 'blue'));

    // defines a default route
    $f3->route('GET /', function() {

        $view = new Template();
        echo $view->render('home.html');
    });

    // defines a route that accepts parameter for animal type
    $f3->route('GET /@type', function($f3, $params) {

        $type = $params['type'];
        if ($type == 'chicken') {
            echo 'Cluck!';
        } else if ($type == 'dog') {
            echo 'Woof!';
        } else if ($type == 'cat') {
            echo 'Meow';
        } else if ($type == 'snake') {
            echo 'Hiss';
        } else if ($type == 'pig') {
            echo 'oink';
        } else {
            $f3->error(404);
        }

        $view = new Template();
        echo $view->render('home.html');
    });

    //define route for order 1
    $f3->route('GET|POST /order', function () {
        $template = new Template();
        echo $template->render( 'views/form1.html');
    });

    //define route for order 2
    $f3->route('GET|POST /order2', function () {
        $_SESSION['animal'] = $_POST['animal'];

        $template = new Template();
        echo $template->render( 'views/form2.html');
    });

    $f3->route('GET|POST /results', function() {
        $_SESSION['color'] = $_POST['color'];

        $view = new Template();
        echo $view->render( 'views/results.html');
    });

    //Run fat free
    $f3 ->run();

