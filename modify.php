<?php



$id = $_GET['id'];

require_once("connection.php");

$select_query = "select * from users where id = $id";

$result=mysqli_query($bd,$select_query);
$row=mysqli_fetch_assoc($result);

$first = $row['f_name'];
$last = $row['l_name'];
$email = $row['email'];
$phone = $row['phone'];
/*
echo $first;
echo $last;
echo $email;
echo $phone; */

?>

<html>
<title>MODIFICATION PAGE </title>
<head> 


 </head>
<form action="modification.php" method="post">
 <input type="hidden" name="idee" id="idee" value="" /> 
<table>
<tr>
<td>  <Label> First Name </label> </td>
<td>   <input type = "text" id="first" name="first"> </input> </td> 
 </tr>

<tr>
<td>  <Label> Last Name </label> </td>
<td>   <input type = "text" id="last" name="last"> </input> </td> 
 </tr>
 <tr>
<td>  <Label> Email </label> </td>
<td>   <input type = "text" id="email" name="email"> </input> </td> 
 </tr>
 
 
 <tr>
<td>  <Label> Phone </label> </td>
<td>   <input type = "text" id="phone" name="phone"> </input> </td> 
 </tr>

</table>

<input type="submit" value="Update">
</form>

<script>

document.getElementById("first").value = "<?php echo $first ?>";
document.getElementById("last").value = "<?php echo $last ?>";
document.getElementById("email").value = "<?php echo $email ?>";
document.getElementById("phone").value = "<?php echo $phone ?>";
document.getElementById("idee").value = "<?php echo $id ?>";


</script>
<body >


</body>

</html>