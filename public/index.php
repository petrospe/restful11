<?php
/* Frontend Controller */
date_default_timezone_set('Europe/Athens');
error_reporting(-1);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require '../vendor/autoload.php';

use JeremyKendall\Password\PasswordValidator;
use JeremyKendall\Slim\Auth\Adapter\Db\PdoAdapter;
use JeremyKendall\Slim\Auth\Bootstrap;
use JeremyKendall\Slim\Auth\Exception\HttpForbiddenException;
use JeremyKendall\Slim\Auth\Exception\HttpUnauthorizedException;
use Zend\Authentication\Storage\Session as SessionStorage;
use Zend\Session\Config\SessionConfig;
use Zend\Session\SessionManager;

require '../lib/Acl.php';

//$config['displayErrorDetails'] = true;
//$app = new \Slim\Slim((["settings" => $config]));
$app = new \Slim\slim(array(
            'mode' => 'developement',
            'templates.path' => './templates',
            'debug' => true
            ));

// Configure Slim Auth components
$validator = new PasswordValidator();
$dsn = 'mysql:host=localhost;dbname=B63Xy47C;charset=utf8';
$options = array(
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    );
$db = new \PDO($dsn, 'hX239y6u', '5aXks8UXXk',$options);
$adapter = new PdoAdapter(getDb(), 'users', 'username', 'password', $validator);
$acl = new lib\Acl();

$sessionConfig = new SessionConfig();
$sessionConfig->setOptions(array(
    'remember_me_seconds' => 60 * 60 * 24 * 7,
    'name' => 'restful11',
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
    $app->render('frontpage.php',$data);
});

$app->get('/tasks', function () use ($app) {
    $data = array(
        'tasks' => file_get_contents('templates/tasks.inc.php'),
    );
    $app->render('frontpage.php',$data);
});

$app->get('/users', function () use ($app) {
    $data = array(
        'users' => file_get_contents('templates/users.inc.php'),
    );
    $app->render('frontpage.php',$data);
});

// Login route MUST be named 'login'
$app->map('/login', function () use ($app) {
    $username = null;

    if ($app->request()->isPost()) {
        $username = $app->request->post('username');
        $password = $app->request->post('password');

        $result = $app->authenticator->authenticate($username, $password);

        if ($result->isValid()) {
            $app->redirect('/restful11/public/');
        } else {
            $messages = $result->getMessages();
            $app->flashNow('error', $messages[0]);
        }
    }
    
    $data = array(
        'login' => file_get_contents('templates/login.inc.php'),
    );
    $app->render('frontpage.php', $data, array('username' => $username));
    
})->via('GET', 'POST')->name('login');

$app->get('/logout', function () use ($app) {
    if ($app->auth->hasIdentity()) {
        $app->auth->clearIdentity();
    }

    $app->redirect('/restful11/public/');
});

$app->run();
/**
 * Creates database table, users and database connection.
 *
 * @return \PDO
 */
function getDb()
{
    $dsn = 'sqlite::memory:';
    $options = array(
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    );

    try {
        $db = new \PDO($dsn, null, null, $options);
    } catch (\PDOException $e) {
        die(sprintf('DB connection error: %s', $e->getMessage()));
    }

    $create = 'CREATE TABLE IF NOT EXISTS [users] ( '
        . '[id] INTEGER  NOT NULL PRIMARY KEY, '
        . '[username] VARCHAR(50) NOT NULL, '
        . '[role] VARCHAR(50) NOT NULL, '
        . '[password] VARCHAR(255) NULL)';

    $delete = 'DELETE FROM users';

    $member = 'INSERT INTO users (username, role, password) '
        . "VALUES ('member', 'member', :pass)";

    $admin = 'INSERT INTO users (username, role, password) '
        . "VALUES ('admin', 'admin', :pass)";

    try {
        $db->exec($create);
        $db->exec($delete);

        $member = $db->prepare($member);
        $member->execute(array('pass' => password_hash('member', PASSWORD_DEFAULT)));

        $admin = $db->prepare($admin);
        $admin->execute(array('pass' => password_hash('admin', PASSWORD_DEFAULT)));
    } catch (\PDOException $e) {
        die(sprintf('DB setup error: %s', $e->getMessage()));
    }

    return $db;
}