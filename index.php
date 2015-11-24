<?php
	require 'vendor/autoload.php';

	$app = new \Slim\slim();

	$app->get('/',function(){
		echo 'Hello Slim';
	});

	$app->get('/show',function()use($app){
		$db = DBConnection();
		$result = $db->query("select * from users")->fetchAll();
		echo json_encode($result);
	});

	$app->post('/insert',function()use($app){
		$db = DBConnection()->exec("insert into users (email) values ('".$app->request->post('email')."');");
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

	$app->run();