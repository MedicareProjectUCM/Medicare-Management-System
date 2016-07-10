<?php

function get_user($username, $password) {
    global $db;
    $query = 'SELECT user_id, user_name FROM users
              WHERE user_name = :username AND pass_word = :password';
    try {
       
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function is_doctor($username) {
    global $db;
    $query = 'SELECT did FROM users
              WHERE user_name = :username';
    try {
       
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
       
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}


function add_user_doctor($username, $password, $did) {
    global $db;
    $query = "INSERT INTO users (user_name, pass_word , did) "
            . "VALUES (:username, :password, :did)";

    try { 
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':did', $did);
        
        $statement->execute();
        $statement->closeCursor();

        // Get the last product ID that was automatically generated
        $user_id = $db->lastInsertId();
        return $user_id;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
function add_user_mcare( $username, $password, $mid )
{
    global $db;
    $query = "INSERT INTO users (user_name, pass_word , mcareid) "
            . "VALUES (:username, :password, :mid)";

    try { 
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':mid', $mid);
        
        $statement->execute();
        $statement->closeCursor();

        // Get the last product ID that was automatically generated
        $user_id = $db->lastInsertId();
        return $user_id;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
function add_user_patient( $username, $password, $pid )
{
    global $db;
    $query = "INSERT INTO users (user_name, pass_word , pid) "
            . "VALUES (:username, :password, :pid)";

    try { 
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':pid', $pid);
        
        $statement->execute();
        $statement->closeCursor();

        // Get the last product ID that was automatically generated
        $user_id = $db->lastInsertId();
        return $user_id;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
function get_user_by_username($username) {
    global $db;
    $query = "SELECT * FROM users WHERE user_name = '$username'";
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function is_medicare($username) {
    global $db;
    $query = 'SELECT mcareid FROM users
              WHERE user_name = :username';
    try {
       
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
       
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
function  is_patient($username) {
    global $db;
    $query = 'SELECT pid FROM users
              WHERE user_name = :username';
    try {
       
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
       
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
function del_user_doctor($id)
{
  
    global $db;
    $query = "DELETE FROM users WHERE did='".$id."'";
    
     try { 
        $statement = $db->prepare($query);
        $result= $statement->execute();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function del_user_medicare($id)
{
  
    global $db;
    $query = "DELETE FROM users WHERE mcareid='".$id."'";
    
     try { 
        $statement = $db->prepare($query);
        $result= $statement->execute();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
function del_user_patient($id)
{
  
    global $db;
    $query = "DELETE FROM users WHERE pid='".$id."'";
    
     try { 
        $statement = $db->prepare($query);
        $result= $statement->execute();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
function display_db_error($error_message) {
    global $app_path;
    include '/errors/db_error.php';
    exit();
}
?>

