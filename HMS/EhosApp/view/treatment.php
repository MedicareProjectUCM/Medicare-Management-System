<?php
require('/model/appvars.php');
require('/model/db_connect.php');
require('/model/patient_repository.php');
require('/model/doctor_repository.php');
require('/model/user_repository.php');
require('/model/complaint_repository.php');
require('/model/mcare_repository.php');
require('/model/tresults_repository.php');

if (!isset($_SESSION['user_id'])) {
    echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
    exit();
}
if (isset($_POST['submit'])) {
    $mcare = trim($_POST['mcare']);
    $symp = $_POST['symptom'];
    $p = stripos($mcare, '-');
    $name = substr($mcare, 0, $p);
    //echo '' . $name;

    $did = $_SESSION['user_id'];
    $mid = get_medicareID($name);

    $medicin = trim($_POST['medicin']);
    $test = trim($_POST['tests']);
    $c = trim($_POST['complaint']);
    add_tests($did, $mid, $c, $medicin, $test);
    echo '<p><strong style="tab-size: 14pt; color: blue"> successfully placed</strong>';
}
?>


<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h2>
            Treatment Page 
        </h2>
        <form method="post" action="<?php $_SERVER['REQUEST_URI'] ?>">
            <h3>
                 <?php
                 $did = get_doctorIDbyUID($_SESSION['user_id']);
                 ?>
                Doctor ID : <?php echo '' .$did['did'] ; ?><br/>
                Doctor Name : <?php echo '' . $_SESSION['user_name']; ?><br/>
            </h3>
            Select Complaint : 
            <select name="complaint">
                <?php
                
                $cids = get_patients($did['did']);
                $mcares = get_medicares();
                echo '' . $cids;
                foreach ($cids as $cid) {
                    echo '' . $cid;
                    $selectStr = (trim($_POST['complaint']) == $cid['cid']) ? "selected = selected" : "";
                    echo '<option ' . $selectStr . '>' . $cid['cid'] . '</option>';
                }
                ?>
            </select>
            <input type="Submit" name="select" value="Select">
            <br/>
            Symptoms : <br/>
            <textarea name="symptom"  rows="4" cols="30" contenteditable="true"><?php
                if (isset($_POST['select'])) {
                    $c = trim($_POST['complaint']);
                    echo '' .get_symptoms($c);
                }
                ?>
            </textarea><br/>
            Enter Medicines :<br/>
            <input type="text" name="medicin" >
            <br/>
            Enter Tests :<br/>
            <input type="text" name="tests" ><br/>
            Select Medicare :<br/>
            <select name="mcare">
                <?php
                foreach ($mcares as $mcare) {
                    echo '<option>' . $mcare['mname'] . '-' . $mcare['spl'] . '</option>';
                }
                ?>
            </select>
            <input type="Submit" name="submit" value="Submit">
        </form>
        <p>
            <a href="doctor_home.php" > Back </a>
        </p>
    </body>
</html>
