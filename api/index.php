<?php
/* Api Controller */
    date_default_timezone_set('Europe/Athens');
    error_reporting(-1);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    
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
            'debug' => true
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

    require '../lib/notorm/NotORM.php';

    $pdo = new PDO('mysql:dbhost='.$hostname.';dbname='.$database.';charset=utf8',$dbuser,$dbpassword);
    $db = new NotORM($pdo);

    /* Get users */
    $app->get('/users', function () use ($app, $db) {
        try{
            $users = array();
            foreach ($db->users() as $user) {
                $users[]  = array(
                    'id' => $user['id'],
                    'fname' => $user['fname'],
                    'lname' => $user['lname'],
                    'title' => $user['title'],
                    'username' => $user['username'],
                    'role' => $user['role'],
                    'email' => $user['email'],
                    'status' => $user['status']
                );
            }
            $app->response()->header('Content-Type', 'application/json');
            echo json_encode($users);
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    });
    /* Get user id */
    $app->get('/user/:id', function ($id) use ($app, $db) {
        try{
            $app->response()->header('Content-Type', 'application/json');
            $user = $db->users()->where('id', $id);
            if ($data = $user->fetch()) {
                echo json_encode(array(
                    "id" => $data["id"],
                    "fname" => $data["fname"],
                    "lname" => $data["lname"],
                    "title" => $data["title"],
                    "username" => $data["username"],
                    "role" => $data["role"],
                    "email" => $data["email"],
                    "status" => $data["status"]
                    ));
            }else{
                echo json_encode(array(
                    "status" => false,
                    "message" => "User ID $id does not exist"
                    ));
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    });
    /* User Insert */
    $app->post('/user', function () use($app, $db) {
        try{
            $app->response()->header('Content-Type', 'application/json');
            $user = $app->request()->post();
            $result = $db->users->insert($user);
            if($result["password"]){
                updatePassword($result["id"],$result["password"]);
            }
            echo json_encode(array(
                "id" => $result["id"],
                "message" => "Add user successfully"
                ));
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    });
    /* User Update */
    $app->put('/user/:id/:jsondata', function ($id, $jsondata) use ($app, $db) {
        try{
            $updateUserData = json_decode($jsondata, true);
            $app->response()->header('Content-Type', 'application/json');
            $user = $db->users()->where('id', $id);
            if($user){
                $result = $user->update($updateUserData);
                if($user->update(['password' => $user->update($updateUserData)])){
                    updatePassword($id,$updateUserData["password"]);
                }
                echo json_encode(array(
                    "status" => (bool)$result,
                    "message" => "User updated successfully"
                ));
            }else{
                echo json_encode(array(
                    "status" => false,
                    "message" => "User id $id does not exist"
                ));
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    });
    /* User Delete */
    $app->delete('/user/:id', function ($id) use($app, $db) {
        try{
            $app->response()->header('Content-Type', 'application/json');
            $user = $db->users()->where('id', $id);
            if($user->fetch()){
                $result = $user->delete();
                echo json_encode(array(
                    "status" => true,
                    "message" => "User deleted successfully"
                ));
            }else{
                echo json_encode(array(
                    "status" => false,
                    "message" => "User id $id does not exist"
                ));
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    });
    /* Get tasks */
    $app->get('/tasks', function () use ($app, $db) {
        try{
            $tasks = array();
            foreach ($db->tasks() as $task) {
                $tasks[]  = array(
                    'id' => $task['id'],
                    'title' => $task['title'],
                    'description' => $task['description'],
                    'start' => $task['start'],
                    'end' => $task['end'],
                    'user' => $task->users['username']
                );
            }
            $app->response()->header('Content-Type', 'application/json');
            echo json_encode($tasks);
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    });
    /* Task Insert */
    $app->post('/task', function () use($app, $db) {
        try{
            $app->response()->header('Content-Type', 'application/json');
            $task = $app->request()->post();
            $userid = $app->auth->getIdentity();
            $userArray = array("users_id"=>$userid["id"]);
            $taskUser = array_merge($task,$userArray);
            $result = $db->tasks->insert($taskUser);
            echo json_encode(array(
                "id" => $result["id"],
                "users_id" => $result["users_id"],
                "message" => "Add task successfully"
                ));
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    });
    /* Task Update */
    $app->put('/task/:id/:jsondata', function ($id, $jsondata) use ($app, $db) {
        try{
            $updateTaskData = json_decode($jsondata, true);
            $app->response()->header('Content-Type', 'application/json');
            $task = $db->tasks()->where('id', $id);
            if($task){
                $result = $task->update($updateTaskData);
                echo json_encode(array(
                    "status" => (bool)$result,
                    "message" => "Task updated successfully"
                ));
            }else{
                echo json_encode(array(
                    "status" => false,
                    "message" => "Task id $id does not exist"
                ));
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    });
    /* Task Delete */
    $app->delete('/task/:id', function ($id) use($app, $db) {
        try{
            $app->response()->header('Content-Type', 'application/json');
            $task = $db->tasks()->where('id', $id);
            if($task->fetch()){
                $result = $task->delete();
                echo json_encode(array(
                    "status" => true,
                    "message" => "Task deleted successfully"
                ));
            }else{
                echo json_encode(array(
                    "status" => false,
                    "message" => "Task id $id does not exist"
                ));
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    });
    $app->run();

    function updatePassword($key, $value)
    {
        global $hostname;
        global $database;
        global $dbuser;
        global $dbpassword;
        // Encrypt user passwords
        $dsn = 'mysql:host='.$hostname.';dbname='.$database.';charset=utf8';
        $options = array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            );
        $db = new \PDO($dsn, $dbuser, $dbpassword, $options);
        $passwordEncrypt = "UPDATE users SET password = :password WHERE id = ".$key."";
        $passwordEncrypt = $db->prepare($passwordEncrypt);
        $passwordEncrypt->execute(array('password' => password_hash($value, PASSWORD_DEFAULT)));
    }