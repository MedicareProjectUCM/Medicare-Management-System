<?php
$dsn = 'mysql:host=localhost;dbname=ehosdb';
$username_conn = 'root';
$password_conn = 'root';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

try {
    //echo 'Connecting.';
    $db = new PDO($dsn, $username_conn, $password_conn, $options);
   // echo 'Connected.';
} catch (PDOException $ex) {
    $error_msg = $ex->getMessage();
    include('/errors/db_error.php');
    
    exit();
}
?>
