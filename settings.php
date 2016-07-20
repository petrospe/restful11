<?php
/* Initial Application settings */

$applicationFolderName = 'restful11'; // The application root folder
$hostname = 'localhost'; // Database hostname
$database = 'B63Xy47C'; // Database Name
$dbuser = 'hX239y6u'; // Database User
$dbpassword = '5aXks8UXXk'; // Database Password

/* PDO Connection */
function getDb()
   {
       global $hostname;
       global $database;
       global $dbuser;
       global $dbpassword;
       
       $dsn = 'mysql:host='.$hostname.';dbname='.$database.';charset=utf8';
       $options = array(
           \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
           \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
       );

       try {
           $db = new \PDO($dsn, $dbuser, $dbpassword,$options);
       } catch (\PDOException $e) {
           die(sprintf('DB connection error: %s', $e->getMessage()));
       }
       
       return $db;
   }