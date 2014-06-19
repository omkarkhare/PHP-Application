<?php
  //Start session
  session_start();  
  //Unset the variables stored in session
  unset($_SESSION['ID']);
  unset($_SESSION['USER_FIRST_NAME']);
  unset($_SESSION['USER_LAST_NAME']);
  $_SESSION['start'] = 0;
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" type="text/css" href="index_style.css">
    <title> My Website</title>
  </head>

  <body>
  <div id="wrapper">
    <div id="header">
      
      <a href="http://www.umd.edu/" id="umd-logo"><img src="images/umd-logo.png" alt="University of Maryland" /></a>
    </div>
    
    <div id="main">
    
     <div id="content">
     
     <form id="login" name="login" action="login_check.php" method="post">
     
     
   <h2 class="welcome">Welcome!</br> </h2>
   <h3 class="msg">Please login with your credentials </h3>
     
       <Label for="username" class="in"> User Name : </label>
       <input type="text" name="user">
       <br>
       <Label for="password" class="in"> Password : </label>
       <input type="password" name="pass"  >
       <p>
       <div class="in">
      <input type="submit" value="Submit">       
       <input type="reset" > 
       </div>      
       </p>

       <?php
//SCRIPT TO DISPLAY THE ERRORS IF INVALID CREDENTIALS ARE ENTERED
if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
      echo '<ul class="err">';
      foreach($_SESSION['ERRMSG_ARR'] as $msg) {
        echo '<li>',$msg,'</li>'; 
        }
      echo '</ul>';
      unset($_SESSION['ERRMSG_ARR']);
      }
    ?>
     
       
     
     </form>
     
     <table  width="500px">
     <tr>
     <td> <a href="reset.html">Forgot Password? </a></td> 
     <td><a href="signup.php"> Signup  </a></td>
     </tr>
     </table>
     </div>
   
   </div>

   
  </div>
  

   
  
  </body>
</html>