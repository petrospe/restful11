<?php
	require 'vendor/autoload.php';

	\Slim\Slim::registerAutoloader();
	
	$app = new \Slim\slim(array(
		'MODE' => 'developement',
	    //'TEMPLATES.PATH' => './templates'
		));

	require "notorm/NotORM.php";

	$pdo = new PDO('mysql:dbhost=localhost;dbname=B63Xy47C;charset=utf8','hX239y6u','5aXks8UXXk');
	$db = new NotORM($pdo);

	$app->get('/',function(){
		echo 'Hello Slim';
	});

	$app->get("/users", function () use ($app, $db) {
	    $users = array();
	    foreach ($db->users() as $user) {
	        $users[]  = array(
	            "id" => $user["id"],
	            "fname" => $user["fname"],
	            "lname" => $user["lname"],
	            "title" => $user["title"],
	            "username" => $user["username"],
	            "email" => $user["email"],
	            "status" => $user["status"]
	        );
	    }
	    $app->response()->header("Content-Type", "application/json");
	    echo json_encode($users);
	});

	$app->get("/user/:id", function ($id) use ($app, $db) {
	    $app->response()->header("Content-Type", "application/json");
	    $user = $db->users()->where("id", $id);
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
	    }
	    else{
	        echo json_encode(array(
	            "status" => false,
	            "message" => "User ID $id does not exist"
	            ));
	    }
	});

	$app->post("/user", function () use($app, $db) {
	    $app->response()->header("Content-Type", "application/json");
	    $user = $app->request()->post();
	    $result = $db->users->insert($user);
	    echo json_encode(array("id" => $result["id"]));
	});

	$app->put("/user/:id", function ($id) use ($app, $db) {
	    $app->response()->header("Content-Type", "application/json");
	    $user = $db->users()->where("id", $id);
	    if ($user->fetch()) {
	        $post = $app->request()->put();
	        $result = $user->update($post);
	        echo json_encode(array(
	            "status" => (bool)$result,
	            "message" => "User updated successfully"
	            ));
	    }
	    else{
	        echo json_encode(array(
	            "status" => false,
	            "message" => "User id $id does not exist"
	        ));
	    }
	});

	$app->delete("/user/:id", function ($id) use($app, $db) {
	    $app->response()->header("Content-Type", "application/json");
	    $user = $db->users()->where("id", $id);
	    if ($user->fetch()) {
	        $result = $user->delete();
	        echo json_encode(array(
	            "status" => true,
	            "message" => "User deleted successfully"
	        ));
	    }
	    else{
	        echo json_encode(array(
	            "status" => false,
	            "message" => "User id $id does not exist"
	        ));
	    }
	});
	/*
	$app->get('/show',function()use($app){
		$db = DBConnection();
		$result = $db->query("select * from users")->fetchAll();
		echo json_encode($result);
	});

    $app->post('/insert',function()use($app){         
    	$db = DBConnection()->exec("insert into users (fname,lname,title,username,password,email,status) values ('".$app->request->post('fname')."'
    		,'".$app->request->post('lname')."','".$app->request->post('title')."','".$app->request->post('username')."','".$app->request->post('password')."',
    		'".$app->request->post('email')."','".$app->request->post('status')."');");
    	     });

	$app->put('/update/:id',function($id)use($app){
		$db = DBConnection()->exec("update users set email = '".$app->request->put('email')."' where id='$id';");
	});

	$app->delete('/delete/:id',function($id)use($app){
		$db = DBConnection()->exec("delete from users where id='$id';");
	});

	function DBConnection(){
		return new PDO('mysql:dbhost=localhost;dbname=B63Xy47C;charset=utf8','hX239y6u','5aXks8UXXk');
	}
	*/
	$app->run();