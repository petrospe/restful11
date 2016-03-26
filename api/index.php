<?php
/* Backend Controller */
    require '../vendor/autoload.php';

    \Slim\Slim::registerAutoloader();

    $app = new \Slim\slim(array(
            'MODE' => 'developement',
//            'TEMPLATES.PATH' => './templates'
            ));

    require '../notorm/NotORM.php';

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
                    'title' => $task['title'],
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
    $app->run();