<?php
require('/model/appvars.php');
require('/model/db_connect.php');
require('/model/user_repository.php');
require('/model/mcare_repository.php');


if (isset($_POST['submit'])) {
    // Grab the profile data from the POST
    $name = trim($_POST['name']);
    $username = trim($_POST['username']);
    $password1 = trim($_POST['password1']);
    $password2 = trim($_POST['password2']);
    $spl = trim($_POST['spl']);
    
    $pno = trim($_POST['pno']);
    $email = trim($_POST['email']);

    if (!empty($username) && !empty($password1) && !empty($password2) && ($password1 == $password2)) {
        // Make sure someone isn't already registered using this username
        $users = get_user_by_username($username);

        if ($users == false) 
        {
            $mid = add_medicare( $name, $spl, $pno, $email );
            // The username is unique, so insert the data into the database
            add_user_mcare( $username, $password1, $mid );

            // Confirm success with the user
            echo '<p>New Mdicare account has been successfully created.  <a href="login.php">log in</a>.</p>';
            exit();
        } else {
            // An account already exists for this username, so display an error message
            echo '<p class="error">An account already exists for this username. Please use a different address.</p>';
            $username = "";
        }
    } else {
        echo '<p class="error">You must enter all the fields.</p>';
    }
}
?>


<html>
    <head>
        <meta charset="UTF-8">
        <title>Sign up</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>
        <h3>Medicare's Registration Form</h3>



        <p>Please enter your Details.</p>
        <ul>
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <fieldset style="width: 150pt; background: blanchedalmond">
                

                <label for="name">Enter Your name:</label>
                <input type="text" id="name" name="name"/><br/><br />

                <label for="username">Enter User name:</label>
                <input type="text" id="username" name="username" value="<?php if (!empty($username)) echo $username; ?>" /><br />
                <label for="password1">Enter Password:</label>
                <input type="password" id="password1" name="password1" /><br />
                <label for="password2">Renter Password:</label>
                <input type="password" id="password2" name="password2" /><br /><br />
                
                <label for="spl">Enter Specialization:</label>
                <input type="text" id="spl" name="spl"/><br />
                
                <label for="pno">Enter Phone No. :</label>
                <input type="text" id="pno" name="pno"/><br/>
                <label for="email">Enter E-mail :</label>
                <input type="text" id="email" name="email"/><br/>
            </fieldset>
            <input type="submit" value="Register" name="submit" />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="./ehos_home.php"><input type="Button" value="Back" name="back" /></a>
        </form>
        </ul>
    </body>
</html>
