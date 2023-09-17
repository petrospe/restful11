<?php
/* Frontend Controller */
date_default_timezone_set('Europe/Athens');
// error_reporting(-1);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

require '../vendor/autoload.php';
\Slim\Slim::registerAutoloader();

use JeremyKendall\Password\PasswordValidator;
use JeremyKendall\Slim\Auth\Adapter\Db\PdoAdapter;
use JeremyKendall\Slim\Auth\Bootstrap;
use JeremyKendall\Slim\Auth\Exception\HttpForbiddenException;
use JeremyKendall\Slim\Auth\Exception\HttpUnauthorizedException;
use Zend\Authentication\Storage\Session as SessionStorage;
use Zend\Session\Config\SessionConfig;
use Zend\Session\SessionManager;

require '../lib/Acl.php';
require '../settings.php';

$app = new \Slim\slim(array(
            'mode' => 'developement',
            'templates.path' => 'templates',
            'debug' => true,
            'cookies.lifetime' => '20 minutes',
            'cookies.encrypt' => true,
            'cookies.secret_key' => '5Zx56VOegtEOrML',
            'cookies.cipher' => MCRYPT_RIJNDAEL_256,
            'cookies.cipher_mode' => MCRYPT_MODE_CBC
            ));

// Configure Slim Auth components
$validator = new PasswordValidator();
$adapter = new PdoAdapter(getDb(), 'users', 'username', 'password', $validator);
$acl = new lib\Acl();

$sessionConfig = new SessionConfig();
$sessionConfig->setOptions(array(
    'remember_me_seconds' => 60 * 60 * 24 * 7,
    'name' => $applicationFolderName,
));
$sessionManager = new SessionManager($sessionConfig);
$sessionManager->rememberMe();
$storage = new SessionStorage(null, null, $sessionManager);

$authBootstrap = new Bootstrap($app, $adapter, $acl);
$authBootstrap->setStorage($storage);
$authBootstrap->bootstrap();

// Grabbing a few things I want in each view
$app->hook('slim.before.dispatch', function () use ($app) {
    $hasIdentity = $app->auth->hasIdentity();
    $identity = $app->auth->getIdentity();
    $role = ($hasIdentity) ? $identity['role'] : 'guest';
    $memberClass = ($role == 'guest') ? 'hide' : '';
    $adminClass = ($role != 'admin') ? 'hide' : '';

    $data = array(
        'hasIdentity' => $hasIdentity,
        'role' =>  $role,
        'identity' => $identity,
        'memberClass' => $memberClass,
        'adminClass' => $adminClass,
    );

    $app->view->appendData($data);
});

$app->container->singleton('log', function () {
    $log = new \Monolog\Logger('slim-skeleton');
    $log->pushHandler(new \Monolog\Handler\StreamHandler('../logs/app.log', \Monolog\Logger::DEBUG));

    return $log;
});

// Prepare view
$app->view(new \Slim\Views\Twig());
$app->view->parserOptions = array(
    'charset' => 'utf-8',
    'cache' => realpath('templates/cache'),
    'auto_reload' => true,
    'strict_variables' => false,
    'autoescape' => true,
    'debug' => true,
);

$app->view->parserExtensions = array(
    new \Slim\Views\TwigExtension(),
    new \Twig_Extension_Debug(),
);

$app->get('/', function () use ($app) {
    $data = array(
        "intro" =>  "<div>
                        <div class='jumbotron'>
                            <div class='page-header'>
                                <h1>Task App <small>Welcome to Task App</small></h1>
                            </div>
                            <p>This is a tiny user-task manager Application</p>
                        </div>
                    </div>",
    );
    $app->render('frontpage.twig',$data);
});

$app->get('/tasks', function () use ($app) {
    $app->render('tasks.twig');
});

$app->get('/projects', function () use ($app) {
    $app->render('projects.twig');
});

$app->get('/users', function () use ($app) {
    $app->render('users.twig');
});

// Login route MUST be named 'login'
$app->map('/login', function () use ($app) {
    $username = null;

    if ($app->request()->isPost()) {
        $username = $app->request->post('username');
        $password = $app->request->post('password');

        $result = $app->authenticator->authenticate($username, $password);

        if ($result->isValid()) {
            $app->redirect('.');
        } else {
            $messages = $result->getMessages();
            $app->flashNow('error', $messages[0]);
        }
    }
    
    $app->render('login.twig', array('username' => $username));
})->via('GET', 'POST')->name('login');

$app->get('/logout', function () use ($app) {
    if ($app->auth->hasIdentity()) {
        $app->auth->clearIdentity();
    }

    $app->redirect('.');
});

$app->run();