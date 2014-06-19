<?php
$f = $_POST['first'];
$l = $_POST['last'];
$e = $_POST['email'];
$p = $_POST['phone'];
$i = $_POST['idee'];

/*echo $f;
echo $l;
echo $e;
echo $p; 
echo $i;  */

require_once("connection.php");

$update_query = "UPDATE users set f_name='$f' , l_name = '$l' , email = '$e' , phone = $p where id= $i";
//echo $update_query;
mysqli_query($bd,$update_query) or die("Query failed ".mysqli_error());

header("Location:admin.php");

?>