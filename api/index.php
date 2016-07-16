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
    
    $app = new \Slim\slim(array(
            'mode' => 'developement',
//            'templates.path' => './templates'
            'debug' => true
            ));
    
    // Configure Slim Auth components
    $validator = new PasswordValidator();
    $adapter = new PdoAdapter(getDb(), 'uses', 'username', 'password', $validator);
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

    require '../lib/notorm/NotORM.php';

    $pdo = new PDO('mysql:dbhost=localhost;dbname=B63Xy47C;charset=utf8','hX239y6u','5aXks8UXXk');
    $db = new NotORM($pdo);

//    $app->get('/',function(){
//            echo 'Hello Slim';
//    });
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
            updatePassword($result["id"],$result["password"]);
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
                    'end' => $task['end']
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
            $result = $db->tasks->insert($task);
            echo json_encode(array(
                "id" => $result["id"],
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

    function updatePassword($key, $value)
    {
        // Encrypt user passwords
        $dsn = 'mysql:host=localhost;dbname=B63Xy47C;charset=utf8';
        $options = array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            );
        $db = new \PDO($dsn, 'hX239y6u', '5aXks8UXXk',$options);
        $passwordEncrypt = "UPDATE users SET password = :password WHERE id = ".$key."";
        $passwordEncrypt = $db->prepare($passwordEncrypt);
        $passwordEncrypt->execute(array('password' => password_hash($value, PASSWORD_DEFAULT)));
    }