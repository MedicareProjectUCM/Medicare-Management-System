<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Hospital Management System</title>
    </head>
    <body >
        
        
        <div style="background:  buttonface;float: top; width: 60%;margin-left:auto; margin-right:auto;border: activeborder; border-style: outset">
            <h2 style="text-align: center">Welcome to Hospital Management System</h2>
        </div>
        <div style="background: antiquewhite; width: 60%;height: 40%;margin-left:auto; margin-right:auto; margin-top: 10pt; border: blue; border-style: double">
            <div style="width: 45%; float: left">  
            
                <?php
        require('/model/user_repository.php');
       if (isset($_SESSION['user_name'])) {
              echo '<a href="logout.php">Log Out (' . $_SESSION['user_name'] . ')</a>';
      } else
       {
          echo '<ul>';
          
          echo '<li><a href="doctor_reg_form.php">New Doctor Registration</a><br /></li><br/>';
          echo '<li><a href="mcare_reg_form.php">New Medicare Registration</a><br /></li><br/>';
          echo '<li><a href="patient_reg_form.php">New Patient Registration</a><br /></li></ul>';
        }
        ?>
        </div>
       <div style="width: 45%; float: right">
                <?php
                 echo '<ul><br/><br/>';
                echo '<li><a href="login.php">Login</a><br />';
                 echo '</ul>';
                 ?>
        </div>
            
        </div>
        <div style="clear: both;background: antiquewhite; width: 60%;height: 40%;margin-left:auto; margin-right:auto; margin-top: 10pt; border: blue; border-style: double">
            
        
        </div>
   
    </body>
</html>
