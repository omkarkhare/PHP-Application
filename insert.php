<?php

$host   = 'localhost';
$dbuser = 'root';
$dbpass = 'root';
$dbname = 'omi';

$conn = mysqli_connect($host, $dbuser, $dbpass, $dbname);


if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
/*
echo "First Name " .$_POST['f_name'];
echo "<br>";
echo "Last Name " .$_POST['l_name'];
echo "<br>";
echo "username " .$_POST['username'];
echo "<br>";
echo "password " .$_POST['password'];
echo "<br>";
echo "address " .$_POST['addr'];
echo "<br>";
echo "city " .$_POST['city'];
echo "<br>";
echo "country " .$_POST['country'];
echo "<br>";
echo "state " .$_POST['state'];
echo "<br>";
echo "phone " .$_POST['phone']; 
echo "<br>";
echo "email " .$_POST['email']; 
echo "<br>";
echo "day " .$_POST['day'];
echo "<br>";
echo "month " .$_POST['month'];  
echo "<br>";
echo "year " .$_POST['year']; 
echo "<br>";
echo "dept " .$_POST['dept'];  
$dob_string = $_POST['year'] . "-" . $_POST['month'] ."-" .$_POST['day'] ; 
$dob=date("Y-m-d",strtotime($dob_string)); 
echo "<br>";
echo "DOB " .$dob; 
echo "<br>";
$phone;
if ($_POST['phone'] =="")
$phone=NULL;
else
$phone=$_POST['phone'];
echo "phone " .$phone; */




$username     = $_POST['username'];
$pass         = $_POST['password'];
$encoded_pass = md5($pass);
$f_name       = $_POST['f_name'];
$l_name       = $_POST['l_name'];
$state        = $_POST['state'];

$country    = $_POST['country'];
$email      = $_POST['email'];
$addr       = $_POST['addr'];
$dob_string = $_POST['year'] . "-" . $_POST['month'] . "-" . $_POST['day'];
$dob        = date("Y-m-d", strtotime($dob_string));
$dept_id    = $_POST['dept'];

//TAKING CARE OF NULL VALUES
$phone;
if ($_POST['phone'] == "")
    $phone = NULL;
else
    $phone = $_POST['phone'];
$city = $_POST['city'];
if ($_POST['city'] == "")
    $city = NULL;


$insert_query = "INSERT INTO users (dept_id,username,password,email,f_name,l_name,date_of_birth,address,city,state,country_code,phone) 

                   VALUES ('$dept_id','$username', '$encoded_pass','$email' ,'$f_name' , '$l_name','$dob', '$addr' , '$city', '$state' , '$country', '$phone')

   ";

//  $execute = mysqli_query($conn,$insert_query);

mysqli_query($conn, $insert_query) or die("Query failed " . mysqli_error($conn));







header("location: admin.php");



?>