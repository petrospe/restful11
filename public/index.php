<?php
require '../vendor/autoload.php';
$app = new \Slim\Slim();
	
$app->get('/', function () use ($app) {
    $data = array(
        "intro" =>  "<div>
                        <div class='jumbotron'>
                            <div class='page-header'>
                                <h1>Task App <small>Welcome to Task App</small></h1>
                            </div>
                            <p>This is a tiny user-task magager Application</p>
                        </div>
                    </div>",
    );
    $app->render('frontpage.php',$data);
});

$app->get('/tasks', function () use ($app) {
    $data = array(
        'tasks' => file_get_contents('templates/tasks.php'),
    );
    $app->render('frontpage.php',$data);
});

$app->get('/users', function () use ($app) {
    $data = array(
        'users' => file_get_contents('templates/users.php'),
    );
    $app->render('frontpage.php',$data);
});

$app->get('/login', function () use ($app) {
    $app->render('login.php');
});

$app->run();