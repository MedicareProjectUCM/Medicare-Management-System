<?php //
require('/model/appvars.php');
require('/model/db_connect.php');
require('/model/user_repository.php');

// Clear the error message
$error_msg = "";

// If the user isn't logged in, try to log them in
if (!isset($_SESSION['user_id'])) {
    if (isset($_POST['submit'])) {
        // Grab the user-entered log-in data
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        if (!empty($username) && !empty($password)) {
            // Look up the username and password in the database
            $user = get_user($username, $password);
            
            
            if ($user !=NULL) {
                // The log-in is OK so set the user ID and username session vars (and cookies), and redirect to the home page
                $_SESSION['user_id'] = $user['user_id'];
                $uid = $user['user_id'];
                $_SESSION['user_name'] = $user['user_name'];
                setcookie('user_id', $user['user_id'], time() + (60 * 60 * 24 * 30));    // expires in 30 days
                setcookie('user_name', $user['user_name'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
                $doctor = is_doctor($_SESSION['user_name']);
                $mcare = is_medicare($_SESSION['user_name']);
                $patient = is_patient($_SESSION['user_name']);
                if ($doctor['did']!=NULL)
                    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/doctor_home.php';
                elseif($mcare['mcareid']!=NULL)
                    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/mcare_home.php';
                elseif($patient['pid']!=NULL)
                    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/patient_home.php';
                else 
                    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/admin_home.php'; 
                
                header('Location: ' . $home_url);
            } else{
                // The username/password are incorrect so set an error message
                $error_msg = 'Sorry, you must enter a valid username and password to log in.';
            }
        } else {
            // The username/password weren't entered so set an error message
            $error_msg = 'Sorry, you must enter your username and password to log in.';
        }
    }
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Log in</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body >
        <h3><center>Log In</center></h3>

        <?php
        // If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
        if (empty($_SESSION['user_id'])) {
            echo '<p class="error">' . $error_msg . '</p>';
            ?>
<div style="background: pink; width: 25%;height: 40%;margin-left:auto; margin-right:auto; margin-top: 10pt; border: blue; border-style: inset">
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
               
                    <label for="username">Username:</label>
                    <input type="text" name="username" value="<?php if (!empty($username)) echo $username; ?>" /><br />
                    <label for="password">Password:</label>
                    <input type="password" name="password" />
                </fieldset>
                <center><input type="submit" value="Log In" name="submit" /></center>
            </form>

            <?php
        }
        else {
            // Confirm the successful log-in
            echo('<p class="login">You are logged in as ' . $_SESSION['user_name'] . '.</p>');
        }
        ?>
</div>
    </body>
</html>
