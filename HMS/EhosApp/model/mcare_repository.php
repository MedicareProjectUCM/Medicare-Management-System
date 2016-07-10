<?php
function add_medicare( $name, $spl, $pno, $email )
{
    global $db;
    $query = "INSERT INTO medicare (mname, spl , mpno, mmail ) "
            . "VALUES (:name, :spl, :pno, :email )";

    try { 
        $statement = $db->prepare($query);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':spl', $spl);
        $statement->bindValue(':pno', $pno);
        $statement->bindValue(':email', $email);
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

function get_medicares()
{
    global $db;
    $query = "SELECT * FROM medicare";
    
     try { 
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_medicareID($name)
{
    global $db;
    $query = "SELECT mcareid FROM medicare where mname ='".$name."'";
    
     try { 
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result['mcareid'];
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_compalints($id)
{
    global $db;
    $query = "Select cid from complaints where mcareid=".$id ;

    try { 
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }   
}

function del_medicare($id)
{
   
    global $db;
    $query = "DELETE FROM medicare WHERE mcareid='".$id."'";
    
     try { 
        $statement = $db->prepare($query);
        $result= $statement->execute();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
?>