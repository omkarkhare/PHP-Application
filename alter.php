<?php

/*echo $_POST['alter_id'];

echo "<br>";

echo $_POST['Modify'];

echo "<br>";

echo $_POST['Delete'];

echo "<br>"; */
$id = $_POST['alter_id'];

if ($_POST['Delete'])
{
	
	require_once("connection.php");
	$delete_query = "DELETE FROM users where id = $id ";
	
	mysqli_query($bd,$delete_query) or die("Query failed ".mysqli_error());
	
	header("Location:admin.php");
}


if ($_POST['Modify'])
{
	
	//$_SESSION['alt_id'] = $id;
	
	//echo $_SESSION['alt_id'];
	header("Location:modify.php? id=$id");
	
	
}
?>