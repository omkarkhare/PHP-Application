<?php

$host = 'localhost';
$dbuser = 'root';
$dbpass= 'root';
$dbname = 'omi';

$conn = mysqli_connect($host,$dbuser,$dbpass,$dbname);

$entered_user = $_POST['entered_user'];
	
	
	$query1 = "SELECT username from users where username = \"" . $entered_user . "\"      ";
	$result1 = mysqli_query($conn,$query1) ;


$num_rows = mysqli_num_rows($result1);

	
	if ($num_rows==0)
	  {
		  
		  $r1 = 0;
	  }
	  else
	  {
		  $r1 = 1;
	  }
	  
	  echo $r1;


    ?>