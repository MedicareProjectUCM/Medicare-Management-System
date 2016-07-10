<?php

function add_patient($name, $gen, $age, $addr, $pno, $email) {
    global $db;
    $query = "INSERT INTO patient (pname, gender , age, addr, ppno, pmail ) "
            . "VALUES (:name, :gen, :age, :addr, :pno, :email )";

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':gen', $gen);
        $statement->bindValue(':age', $age);
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

function allpatients() {
    global $db;
    $query = "SELECT * FROM patient";

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

function del_patient($id) {

    global $db;
    $query = "DELETE FROM patient WHERE pid=" . $id ;

    try {
        $statement = $db->prepare($query);
        $result = $statement->execute();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

?>