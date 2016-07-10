<html>
    <head>
        <title>
            Medicare's Home page
        </title>
    </head>
    <body>
        <h3>
            Medicare's Home page
        </h3>
        <div style="background: yellowgreen; width: 60%;height: 40%;margin-left:auto; margin-right:auto; margin-top: 10pt; border: blue; border-style: inset">
        <?php
        if (!isset($_SESSION['user_id'])) {
            echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
            exit();
        } 
        
        echo '<p><strong>Welcome  to ' . $_SESSION['user_name'] . '...</p><br/>';
        echo '<ul>';
        echo '<li><a href="tests.php">Tests</a></li><br/>';
        echo '<li><a href="view_tresults.php">View Test Results</a></li><br/>';
        echo '<li><a href="logout.php">Log Out (' . $_SESSION['user_name'] . ')</a></li>';

        ?>
        
    </body>
</html>


<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

