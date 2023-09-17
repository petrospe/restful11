<?php
// Check if the script is running on Heroku (checks for the DYNO environment variable)
if (!getenv('DYNO')) {
    // Running locally, load from .env file
    $envFilePath = __DIR__ . '/.env';

    // Check if the .env file exists
    if (file_exists($envFilePath)) {
        // Read the .env file and parse its contents
        $envContents = file_get_contents($envFilePath);
        $envVariables = preg_split('/\r\n|\r|\n/', $envContents);

        foreach ($envVariables as $envVariable) {
            // Split the line into key and value
            list($key, $value) = explode('=', $envVariable, 2);

            // Set the environment variable
            if ($key && $value) {
                $_ENV[$key] = $value;
                putenv("$key=$value");
            }
        }
    } else {
        die('.env file not found.');
    }
}

function getEnvVariable($envvariable){
    $value = null;
    if(!empty($envvariable)){
        $value =  (!empty(getenv($envvariable))?getenv($envvariable):(!empty($_ENV[$envvariable])?$_ENV[$envvariable]:null));
    }
    return $value;
}

/* Initial Application settings */

$applicationFolderName = dirname(__FILE__); // The application root folder
$hostname = getEnvVariable('DB_HOST'); // Database hostname
$database = getEnvVariable('DBNAME'); // Database Name
$dbuser = getEnvVariable('DBUSERNAME'); // Database User
$dbpassword = getEnvVariable('DBPASSWORD'); // Database Password
$dbport = getEnvVariable('DBPORT'); // Database Port

/* PDO Connection */
function getDb()
   {
       global $hostname;
       global $database;
       global $dbuser;
       global $dbpassword;
       global $dbport;
   
       $dsn = 'mysql:host='.$hostname.';port='.$dbport.';dbname='.$database.';charset=utf8';
       $options = array(
           \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
           \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
       );
   
       try {
           $db = new \PDO($dsn, $dbuser, $dbpassword, $options);
       } catch (\PDOException $e) {
           die(sprintf('DB connection error: %s', $e->getMessage()));
       }
   
       return $db;
   }