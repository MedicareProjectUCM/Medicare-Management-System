<?php
require('/model/appvars.php');
require('/model/db_connect.php');
require('/model/patient_repository.php');
require('/model/doctor_repository.php');
require('/model/user_repository.php');
require('/model/complaint_repository.php');
require('/model/tresults_repository.php');
require('/model/mcare_repository.php');

// Clear the error message
$error_msg = "";

// If the user isn't logged in, try to log them in.
if (!isset($_SESSION['user_id'])) {
    echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
    exit();
}

if (isset($_POST['submit'])) {

    if (isset($_POST['id'])) {
        $id=$_POST['id'];
        del_medicare($id);
        del_user_medicare($id);
    } else {
        echo '<p class="error">Please select .</p>';
    }
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            List of Doctors
        </title>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>

    <h2> List of Doctors
    </h2
    <div>
        <form method="post" action="<?php $_SERVER['REQUEST_URI'] ?>">

            <table border=1 >
                <thead> 
                    <tr>
                        <th bgcolor='pink'>S. No.</th>
                        <th bgcolor='pink'>Medicare ID</th>
                        <th bgcolor='pink'>Medicare Name</th>
                        <th bgcolor='pink'>Specialization </th>
                        <th bgcolor='pink'>Contact No. </th>
                        <th bgcolor='pink'>Email Address </th>
                        <th bgcolor='pink'>Delete </th>
                    </tr> 
                </thead>
                <tbody>

<?php
//echo $_SERVER['REQUEST_URI'];
$events = get_medicares();
$i = 0;
for ($index = 0; $index < count($events); $index++) {
    echo "<tr><td bgcolor='yellow'>" . ( ++$i) . '</td>';
    echo "<td bgcolor='yellow'>" . $events[$index]['mcareid'] . '</td>';
    echo "<td bgcolor='yellow'>" . $events[$index]['mname'] . '</td>';
    echo "<td bgcolor='yellow'>" . $events[$index]['spl'] . '</td>';
    echo "<td bgcolor='yellow'>" . $events[$index]['mpno'] . '</td>';
    echo "<td bgcolor='yellow'>" . $events[$index]['mmail'] . '</td>';
    echo "<td bgcolor='yellow'>  <input type='radio' name ='id' value='" . $events[$index]['mcareid'] . "'> </td></tr>";
}
?>
                </tbody>
            </table>
            <input type="submit" name="submit" value="Delete"> 
        </form>
    </div>
    <a href="admin_home.php" > Back </a> 
</html>
