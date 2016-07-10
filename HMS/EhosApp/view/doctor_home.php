<html>
    <head>
        <title>
            Doctor's Home page
        </title>
    </head>
    <body>
        <h3>
            Doctor's Home page
        </h3>
        <div style="background: skyblue; width: 60%;height: 40%;margin-left:auto; margin-right:auto; margin-top: 10pt; border: blue; border-style: inset">
        <?php
        if (!isset($_SESSION['user_id'])) {
            echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
            exit();
        } 
        
        echo '<p><strong>Welcome  to ' . $_SESSION['user_name'] . '...</p><br/>';
        echo '<ul>';
        echo '<li><a href="treatment.php">Treatment</a></li><br/>';
        echo '<li><a href="view_tresults.php">View Test Results</a></li><br/>';
        echo '<li><a href="logout.php">Log Out (' . $_SESSION['user_name'] . ')</a></li>';

        ?>
        
    </body>
</html>

