<?php
function add_doctor( $name, $spl, $qual, $addr, $pno, $email ) {
    global $db;
    $query = "INSERT INTO doctor (dname, spl , qual, addr, dpno, email ) "
            . "VALUES (:name, :spl, :qual, :addr, :pno, :email )";

    try { 
        $statement = $db->prepare($query);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':spl', $spl);
        $statement->bindValue(':qual', $qual);
        $statement->bindValue(':addr', $addr);
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

function get_doctors()
{
    global $db;
    $query = "SELECT * FROM doctor";
    
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

function get_doctorID($name)
{
    global $db;
    $query = "SELECT did FROM doctor where dname ='".$name."'";
    
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

function get_doctorIDbyUID($id)
{
    global $db;
    $query = "SELECT did FROM  users where  user_id ='".$id."'";
    
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
function del_doctor($id)
{
   
    global $db;
    $query = "DELETE FROM doctor WHERE did='".$id."'";
    
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