<?php
require('/model/appvars.php');
require('/model/db_connect.php');
require('/model/patient_repository.php');
require('/model/doctor_repository.php');
require('/model/user_repository.php');
require('/model/complaint_repository.php');

if (!isset($_SESSION['user_id'])) {
    echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
    exit();
}
if (isset($_POST['submit'])) {
    $doct = $_POST['doctor'];
    $symp = $_POST['symptom'];
    $p = stripos($doct, '-');
    $name = substr($doct, 0, $p);

    $pid = $_SESSION['user_id'];
    $did = get_doctorID($name);
    add_complaint($did['did'], $pid, $symp);
    echo '<p><strong style="tab-size: 14pt; color: blue">Complaint has been successfully placed</strong>';
}
?>


<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h2>
            Complaints Page 
        </h2>
        <form method="post" action="<?php $_SERVER['REQUEST_URI'] ?>">
            <h3>
                Patient ID : <?php echo '' . $_SESSION['user_id']; ?><br/>
                Patient Name : <?php echo '' . $_SESSION['user_name']; ?><br/>
            </h3>
            Select Doctor : 
            <select name="doctor">
                <?php
                $doctors = get_doctors();
                echo '' . $doctors;
                foreach ($doctors as $doctor) {
                    echo '<option>' . $doctor['dname'] . '--' . $doctor['spl'] . '</option>';
                }
                ?>
            </select><br/>
            Enter Symptoms :<br/>
            <textarea name="symptom"  rows="5" cols="40"></textarea>

            <input type="Submit" name="submit" value="Submit">
        </form>
        <p>
            <a href="patient_home.php" > Back </a>
        </p>
    </body>
</html>
