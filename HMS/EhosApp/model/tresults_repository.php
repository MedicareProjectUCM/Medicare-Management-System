<?php


function get_tresults($uid)
{
    global $db;
    $query = "SELECT t.* FROM tresults t, complaints c WHERE t.cid = c.cid AND c.pid =".$uid ;

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
function get_tresults_doctor($uid)
{
    global $db;
    $query = "SELECT t.* FROM tresults t, complaints c WHERE t.cid = c.cid AND c.did =".$uid ;

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

function get_tresults_mcare($uid)
{
    global $db;
    $query = "SELECT t.* FROM tresults t, complaints c WHERE t.cid = c.cid AND c.mcareid =".$uid ;

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

function add_tests($did, $mid, $cid, $medicin, $test)
{
    global $db;
    
    $query1 = "update complaints set mcareid = '".$mid."', medicines ='".$medicin."' , tests ='".$test."' where cid = '".$cid."'";
    $query2 = "insert into tresults (cid, test_name) values (:cid, :test)";
    try { 
        $statement = $db->prepare($query1);
        $statement->execute();
        $statement->closeCursor();
        
        $statement = $db->prepare($query2);
        $statement->bindValue(':cid', $cid);
        $statement->bindValue(':test', $test);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function  update_tresults($c, $tfile)
{
     global $db;
    
    $query = "update tresults set tdate=now() , tfilepath='".$tfile."' where cid = ".$c;
   
    try { 
        $statement = $db->prepare($query);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
    
}
?>