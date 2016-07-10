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
if (isset($_POST['submit'])) 
{
    $c = trim($_POST['complaint']);
    $tfile = trim($_FILES['tfile']['name']);
    
    $target_Path = "files/";
        if (!empty($tfile)) 
        {
            if ($_FILES['tfile']['error'] == 0) 
            {
                $target_Path = $target_Path.basename( $_FILES['tfile']['name'] );
                move_uploaded_file( $_FILES['tfile']['tmp_name'], $target_Path );
            }
            update_tresults($c, $tfile);
            echo '<p><strong style="tab-size: 14pt; color: blue"> successfully updated</strong>';
        }
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
        <form method="post" action="<?php $_SERVER['REQUEST_URI'] ?>" enctype="multipart/form-data">
            <h3>
                Medicare ID : <?php echo '' . $_SESSION['user_id']; ?><br/>
                Medicare Name : <?php echo '' . $_SESSION['user_name']; ?><br/>
            </h3>
            Select Complaint : 
            <select name="complaint">
                
                <?php
                
                $cids = get_compalints_mcare($_SESSION['user_id']);
                
                foreach ($cids as $cid) {
                    $selectStr = (trim($_POST['complaint']) == $cid['cid']) ? "selected = selected" : "";
                    echo '<option ' . $selectStr . '>' . $cid['cid'] . '</option>';
                }
                ?>
            </select>
            <input type="Submit" name="select" value="Select">
            <br/>
            Symptoms : <br/>
            <textarea name="symptom"  rows="2" cols="20" contenteditable="false">
                <?php
                if (isset($_POST['select'])) {
                    $c = trim($_POST['complaint']);
                    echo get_test($c);
                }
                ?>
            </textarea><br/>
            Upload Test Result File :
            <input type="file" name="tfile" /><br/>
            <input type="Submit" name="submit" value="Submit">
        </form>
        <p>
            <a href="mcare_home.php" > Back </a>
        </p>
    </body>
</html>
