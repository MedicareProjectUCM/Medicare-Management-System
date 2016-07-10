<?php
function add_complaint($d, $p, $symp)
{
    global $db;
    $query = "INSERT INTO complaints (did, pid , symptoms, cdate ) "
            . "VALUES (:did, :pip, :symp, now())";

    try { 
        $statement = $db->prepare($query);
        $statement->bindValue(':did', $d);
        $statement->bindValue(':pip', $p);
        $statement->bindValue(':symp', $symp);
        //$statement->bindValue(':cdate', now);
        $statement->execute();
        $statement->closeCursor();

        // Get the last product ID that was automatically generated
        $id = $db->lastInsertId();
        return $id;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_complaints($uid)
{
    global $db;
    $query = "Select * from complaints where pid=".$uid ;

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
function get_complaints_doctor($uid)
{
    global $db;
    $query = "Select * from complaints where did=".$uid ;

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

function get_comp_mcare($uid){
    global $db;
    $query = "Select * from complaints where mcareid=".$uid ;

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
function get_compalints_mcare($uid)
{
    global $db;
    $query = "SELECT cid FROM complaints c, users u WHERE cid IN "
            ."(SELECT cid FROM tresults WHERE tfilepath IS NULL)"
            ."AND c.mcareid = u.mcareid AND u.user_id =".$uid ;

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


function get_patients($did)
{
    global $db;
    $query = "SELECT DISTINCT cid FROM complaints WHERE cid NOT IN (SELECT cid FROM tresults) and did=".$did ;

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

function get_symptoms($pid)
{
    global $db;
    $query = "Select symptoms from complaints where cid=".$pid ;

    try { 
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result['symptoms'];
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
function get_test($c)
{
    global $db;
    $query = "Select tests from complaints where cid=".$c ;

    try { 
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result['tests'];
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
    
}
?>