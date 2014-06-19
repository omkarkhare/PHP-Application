<?php
require_once('auth.php');
?>




<html>

<head>
    <link rel="stylesheet" type="text/css" href="admin_style.css">
    <link rel="stylesheet" href="styles/tab.css" />
    <link rel="stylesheet" href="styles/datepicker.css">


    <title>Welcome Administrator</title>
</head>

<body>



    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="http://benalman.com/code/projects/jquery-hashchange/jquery.ba-hashchange.js"></script>
    <script type="text/javascript" src="scripts/tab_script.js"></script>
      <script src="scripts/datepicker1.js"></script>
  <script src="scripts/datepicker2.js"></script>
    
    <script>
  $(function() {                                  // date picker function
    $( "#datepicker" ).datepicker();
  });
  
  $(function() {             //document . ready


                $('#country').change(function() {
                    var selected_country = $(this).val();
                    $.ajax({
					    type: "POST",
                        url: "getstate.php",
                        data: 'thecountry=' +  selected_country,
                        success: function(states) {

                            $('#thediv').html(states);
                            
                        } 
                    }); //END ajax
                }); //END dropdown change event
				
				
				
				$('#username').change(function() {  // to check if username already exists
					var entered_user = $(this).val();
					   $.ajax({
						
                        type: "POST",
                        url: "checkuser.php",
                        data: 'entered_user=' +  entered_user,
                        success: function(user_flag) {
							

var x = document.getElementById('user_error');
if (user_flag ==1)
{
	
	x.innerHTML="User Name Already Exists. Please select another username";
	 document.getElementById('submit_button').disabled=true;
}
if (user_flag==0)
{
    x.innerHTML="";
	
	document.getElementById('submit_button').disabled=false;

   
}
 
                        } 
                    }); //END ajax
					
				}); // END OF username check
		
            }); //END document.ready
			
			
			
			function repasswordCheck()  // javascript function to validate reentered password is correct
			{
				var pass = document.getElementById('password').value;
				
				var repass = document.getElementById('repassword').value;
				
				if (pass!=repass)
				{
					
					document.getElementById('submit_button').disabled=true;
					document.getElementById('incorrect_repassword').innerHTML="Passwords do not match";
				}
			
				else
				{
					
					document.getElementById('submit_button').disabled=false;
					document.getElementById('incorrect_repassword').innerHTML="";
				}
				
				
				
			}
			
  
  function emailCheck()   // javascript function to validate email
			{
				var email = document.getElementById('email').value;
			    var at = email.indexOf("@");  // for checking @
				var dot = email.lastIndexOf("."); // for checking '.' after @
				
				if (at< 1 || dot<at+2 || dot+2>=email.length) // '@' is at 1st position || '.' is at end of email  
				{
					document.getElementById('incorrect_email').innerHTML="Invalid Email";
					document.getElementById('submit_button').disabled=true;
				}
				else
				{
					document.getElementById('submit_button').disabled=false;
					document.getElementById('incorrect_email').innerHTML="";
				}
			}
			
 function validate_form()
			{
				
				var f_name = document.getElementById('f_name').value;
				var l_name = document.getElementById('l_name').value;
				var username = document.getElementById('username').value;
				var password = document.getElementById('password').value;
				var phone = document.getElementById('phone').value;
				var email = document.getElementById('email').value;
				var dob = document.getElementById('datepicker').value;
				var addr = document.getElementById('addr').value;
				 var month = dob.substring(0, 2);
				 var day = dob.substring(3, 5);
				 var year = dob.substring(6, 10);
				 
	 
				var country = document.getElementById('country').value; // country code and not the name
				
				if(country.length!=0) // special case when country code is not present
				{
				var state = document.getElementById('state').value;
				
				}
				if (isNaN(day)||isNaN(month)||isNaN(year)||day.length!=2||month.length!=2||year.length!=4||day<0||day>31||month<0||month>12)
				{
					document.getElementById('form_error').innerHTML="Incorrect date of birth";
					return false;
				}
				if (f_name.length===0||l_name.length===0||username.length===0||password.length===0||country.length===0||state.length===0||email.length===0||addr.length===1)
				{
					document.getElementById('form_error').innerHTML="Please input/select all the required details in proper format";
					return false;
				   
				}
				
				 var check_phone = phone.match(/\d+/g);
				   if(check_phone==null && phone.length!=0)    //phone is not numeric
				   {
				     
					 document.getElementById('form_error').innerHTML="Phone should be numeric";
					return false;
				   }
				
				
				document.getElementById('day').value=day;
				document.getElementById('year').value=year;
				document.getElementById('month').value=month;
				
				
				return true;
				
				
			} 
			
			function passwordCheck()   // javascript function to validate password
			{
				var pass = document.getElementById('password').value;
				var passlength = pass.length;
				var errflag_length=0;
				var errflag_number=0;
				var errflag_specialchars =0;
				var specialcharacters= "~@`!#$%^&*+=-[]\\\';,/{}|\":<>?";
				
				if(passlength<5 || passlength>15) //password does not meet the required length
				{
				   errflag_length=1;
				  
				}
				   
				   var contains_number = pass.match(/\d+/g);
				   if(contains_number==null)    //password does not contain number
				   {
				     
					  errflag_number=1;
				   }
				   
				   
				   for (var i=0;i<passlength;i++)
				   {
					   if (specialcharacters.indexOf(pass.charAt(i)) == -1)
					    {
							errflag_specialchars=1;
						}
						
						else
						{
							errflag_specialchars=0;
							break;
						}
				   }
				   
				   // check 8 conditions based on 3 flags
if (errflag_length==1 &&  errflag_number==1 && errflag_specialchars==1)
	{
	   document.getElementById('incorrect_password').innerHTML ="5 to 15 characters, 1 number & 1 special character";
	   document.getElementById('submit_button').disabled=true;
	}
					   
                if (errflag_length==0 &&  errflag_number==0 && errflag_specialchars==1)
				{
				     document.getElementById('incorrect_password').innerHTML = "Minimum 1 special character";
					  document.getElementById('submit_button').disabled=true;
				}
			    if (errflag_length==0 &&  errflag_number==1 && errflag_specialchars==0)
				{
				     document.getElementById('incorrect_password').innerHTML = "Minimum 1 numeric character";
					  document.getElementById('submit_button').disabled=true;
				}
			    if (errflag_length==0 &&  errflag_number==1 && errflag_specialchars==1)
				{
				     document.getElementById('incorrect_password').innerHTML = "Minimum 1 numeric character & 1 special character";
					  document.getElementById('submit_button').disabled=true;
				}
			    if (errflag_length==1 &&  errflag_number==0 && errflag_specialchars==0)
				{
				     document.getElementById('incorrect_password').innerHTML = "Should 5 to 15 characters";
					  document.getElementById('submit_button').disabled=true;
				}
			    if (errflag_length==1 &&  errflag_number==0 && errflag_specialchars==1)
				{
				     document.getElementById('incorrect_password').innerHTML = "Should 5 to 15 characters & minimum 1 special character";
					  document.getElementById('submit_button').disabled=true;
				}
			    if (errflag_length==1 &&  errflag_number==1 && errflag_specialchars==0)
				{
				     document.getElementById('incorrect_password').innerHTML = "Should 5 to 15 characters & minimum 1 numeric character";
					  document.getElementById('submit_button').disabled=true;
				}
				
					   
					    if (errflag_length==0 &&  errflag_number==0 && errflag_specialchars==0)
					   {
						   document.getElementById('incorrect_password').innerHTML ="";
						    document.getElementById('submit_button').disabled=false;
					   }
				
			}
			
	 function validate_radio_button()
  {
	  
	  
	 var x = document.getElementsByName('select_one');
	 var choice="";
	 for(var k=0;k<x.length;k++)
	 {
          if(x[k].checked)
		  {
            choice=x[k].value;
			//alert(choice);
          }
	 }
	 if ((choice==="") || (choice===null))
	 {
	 alert("Please select one");
	 return false;
	 }
	 else
	 {
		 document.getElementById('alter_id').value=choice;
		 return true;
	 }
		  
		  
		 
	  
	
  }		

  
function submitForm()
{
  if(validate_form())
  {
    document.forms["signup_form"].submit(); //first submit
    document.forms["signup_form"].reset(); //and then reset the form values
  }
}


  
  
  
 
  
  
  
  
  
  
  
  
  
  
  
  
  </script>

    <div id="wrapper">
        <div id="header">
            <br>
            <a href="http://www.umd.edu/" id="umd-logo">
                <img src="images/umd-logo.png" alt="University of Maryland" />
            </a>
        </div>
        <div align="center">
            <font color="#FFFFFF" size="+6" face="Times New Roman, Times, serif">Welcome <?php
echo $_SESSION['USER_FIRST_NAME'];
?>  </font>
        </div>


        <section id="wrapper1" class="wrapper1">



            <div id="v-nav">


                <ul>
                    <li tab="tab1" class="first current">Add Employees</li>
                    <li tab="tab2">Modify Users</li>
                    <li tab="tab3" class="last">View Users</li>

                </ul>
                <div class="tab-content">
                    <h4>Add Employees</h4> 
                    
                   <form id="signup" action="insert.php" method="post" name="signup_form" >
     
  <input type="hidden" name="day" id="day" value="" /> 
  <input type="hidden" name="month" id="month" value="" />  
  <input type="hidden" name="year" id="year" value="" />  
  
   <h3 class="msg">Enter details below </h3>
   <label for="form_error" id="form_error" class="err"> </label> 
     <table >
     
     <tr>
      <td>   <Label for="f_name" > First Name <font color="#FF0000">*</font> </label> </td>
       <td><input type="text" id="f_name" name="f_name"> </td>
      </tr>
      
      <tr>
      <td>    <Label for="l_name" > Last Name<font color="#FF0000">*</font></label> </td>
     <td>  <input type="text" id="l_name" name="l_name"> </td>
     </tr>
     
        <tr>
      <td>    <Label for="username" > Username<font color="#FF0000">*</font></label> </td>
     <td>  <input type="text" id="username" name="username"> 
           <label for="user_exists" id= "user_error" class="err"> </label>
     </td>
     </tr>
     
       <tr>
      <td>    <Label for="password" > Password<font color="#FF0000">*</font>
                  
                   
      </label> </td>
      
     <td>  <input type="password" id="password" onChange="passwordCheck()" name="password" > 
            <label for="incorrect_password" id= "incorrect_password" class="err"> (Upto 15 characters with 1 numeric and  1 special character) </label>
     
     
     </td>
           
     </tr>
     
        <tr>
      <td>    <Label for="repassword" > Retype Password<font color="#FF0000">*</font></label> </td>
     <td>  <input type="password" id="repassword" onChange="repasswordCheck()" > 
           <label for="incorrect_repassword" id= "incorrect_repassword" class="err">
     
     </td>
     </tr>
     
     
     
     <tr>
      <td>    <Label for="dob" > Date of Birth (mm/dd/yyyy)<font color="#FF0000">*</font></label> </td>
     <td>  <input type="text" id="datepicker" name="dob" > 
           <label for="dob_err" id= "dob_err" class="err">
     
     </td>
     </tr>
     
      <tr>
        <td> <Label for="dept" > Department<font color="#FF0000">*</font> </label> </td>
      <td> <select name="dept" id="dept" name="dept">
 <option selected value="">----Select----</option>
 
<?php
$host   = 'localhost';
$dbuser = 'root';
$dbpass = 'root';
$dbname = 'omi';
$conn   = mysqli_connect($host, $dbuser, $dbpass, $dbname);

if (mysqli_connect_errno()) {
    die("DATABASE CONNECTION FAILED" . mysqli_connect_error() . "(" . mysqli_connect_errno() . ")");
}

$query = "SELECT * FROM dept";
echo $query;
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_row($result)) {
    echo "<option id=" . $row[0] . " value=" . $row[0] . " >" . $row[1] . "</option>";
    
}
mysqli_close($conn);
?>

</select> </td>
</tr>
     
      <tr>
      <td>    <Label for="email" > Email<font color="#FF0000">*</font></label> </td>
     <td>  <input type="text" id="email" onChange="emailCheck()" name="email" > 
           <label for="incorrect_email" id= "incorrect_email" class="err">
     
     </td>
     </tr>
       
       <tr>
       <td> <Label for="address" > Street Address<font color="#FF0000">*</font> </label> </td>
       <td><textarea rows="2" cols="20" id="addr" name="addr"> </textarea> </td>
       </tr>
       
       <tr>
       <td><Label for="city" > City </label> </td>
       <td><input type="text" id="city" name="city"> </td>
        </tr>
        <tr>
        <td> <Label for="country" > Country<font color="#FF0000">*</font> </label> </td>
      <td> <select name="country" id="country" name="country">
 <option selected value="">----Select----</option>
 
<?php
$host   = 'localhost';
$dbuser = 'root';
$dbpass = 'root';
$dbname = 'omi';
$conn   = mysqli_connect($host, $dbuser, $dbpass, $dbname);

if (mysqli_connect_errno()) {
    die("DATABASE CONNECTION FAILED" . mysqli_connect_error() . "(" . mysqli_connect_errno() . ")");
}

$query = "SELECT * FROM cntry";
echo $query;
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_row($result)) {
    echo "<option id=" . $row[0] . " value=" . $row[2] . " >" . $row[1] . "</option>";
    
}
mysqli_close($conn);
?>

</select> </td>
</tr>

<tr>
<td>State/Province<font color="#FF0000">*</font> <td>
<div id="thediv">
<td>


 </td>
 </div>
</tr>


<tr>
       <td><Label for="phone" > Phone </label> </td>
       <td><input type="text" id="phone"  maxlength="10" size="10" name="phone"> </td>
        </tr>

</table>
       <p>
       <div class="in">
      <input type="button" value="Submit" id="submit_button" onclick="submitForm()">  <!--Used regular button instead of a submit to tackle the reset issue-->     
       <input type="reset" > 
       </div>      
       </p>
     
       
     
     </form>
     
     <table  width="500px">
     <tr>
     <td><a href="index.php"> Back </a></td>
     </tr>
     </table>
                    
                    
                    
                    
                </div>

                <div class="tab-content">
                    <h4>Modify Users</h4> 
                    <form name="remove_users" method="post" action="alter.php" onsubmit=" return validate_radio_button()" >
                    
                     <input type="hidden" name="alter_id" id="alter_id" value="" /> 
                    
                    
                     <?php

echo "<table border=1 align=center width=auto>";
echo "<th>" . "Select One" . "</th>";
echo "<th>" . "First Name" . "</th>";
echo "<th>" . "Last Name" . "</th>";
echo "<th>" . "Email" . "</th>";
echo "<th>" . "Date of Birth" . "</th>";
echo "<th>" . "Department" . "</th>";
echo "<th>" . "Address" . "</th>";
echo "<th>" . "City" . "</th>";
echo "<th>" . "State" . "</th>";
echo "<th>" . "Country" . "</th>";
echo "<th>" . "Phone" . "</th>";


require_once("connection.php");

$select_query = "SELECT * from users where admin_flag=0";
$result       = mysqli_query($bd, $select_query);



while ($row = mysqli_fetch_assoc($result)) {
    $uid                = $row['id'];
    $country_code       = $row["country_code"];
    $country_query_1    = "SELECT country_name from cntry where country_code = \"" . $country_code . "\"";
    $department_query_1 = "select dept_name from dept join users on dept.dept_id = users.dept_id  where admin_flag=0 and id = $uid";
    
    $result1_1 = mysqli_query($bd, $country_query_1);
    $result2_1 = mysqli_query($bd, $department_query_1);
    
    $row1_1 = mysqli_fetch_array($result1_1);
    $row2_1 = mysqli_fetch_array($result2_1);
    
    $country   = $row1_1["0"];
    $dept_name = $row2_1["0"];
    
    
    
    echo "<tr>";
    echo "<td>  <input type='radio' name='select_one' id='select_one' value=" . $row["id"] . " </td>";
    echo "<td>" . $row["f_name"] . "</td>";
    echo "<td>" . $row["l_name"] . "</td>";
    echo "<td>" . $row["email"] . "</td>";
    echo "<td width=10px >" . $row["date_of_birth"] . "</td>";
    echo "<td align=center>" . $dept_name . "</td>"; // Department name
    echo "<td>" . $row["address"] . "</td>";
    echo "<td>" . $row["city"] . "</td>";
    echo "<td>" . $row["state"] . "</td>";
    echo "<td>" . $country . "</td>";
    echo "<td>" . $row["phone"] . "</td>";
    echo "</tr>";
    
}

echo "</table>";
?>


<input type="submit" value="Modify" name="Modify" ></input> 
<input type="submit" value="Delete" name="Delete"></input> 
                    


                    </form>

                </div>

                <div class="tab-content">
                    <h4>View Users</h4> 
                    <form name="view_users" >
                        <?php

echo "<table border=1 align=center width=auto>";

echo "<th>" . "First Name" . "</th>";
echo "<th>" . "Last Name" . "</th>";
echo "<th>" . "Email" . "</th>";
echo "<th>" . "Date of Birth" . "</th>";
echo "<th>" . "Department" . "</th>";
echo "<th>" . "Address" . "</th>";
echo "<th>" . "City" . "</th>";
echo "<th>" . "State" . "</th>";
echo "<th>" . "Country" . "</th>";
echo "<th>" . "Phone" . "</th>";


require_once("connection.php");

$select_query = "SELECT * from users where admin_flag=0";
$result       = mysqli_query($bd, $select_query);



while ($row = mysqli_fetch_assoc($result)) {
    $uid              = $row['id'];
    $country_code     = $row["country_code"];
    $country_query    = "SELECT country_name from cntry where country_code = \"" . $country_code . "\"";
    $department_query = "select dept_name from dept join users on dept.dept_id = users.dept_id where admin_flag=0 AND id = $uid ";
    
    $result1 = mysqli_query($bd, $country_query);
    $result2 = mysqli_query($bd, $department_query);
    
    $row1 = mysqli_fetch_array($result1);
    $row2 = mysqli_fetch_array($result2);
    
    $country   = $row1["0"];
    $dept_name = $row2["0"];
    
    
    
    echo "<tr>";
    echo "<td>" . $row["f_name"] . "</td>";
    echo "<td>" . $row["l_name"] . "</td>";
    echo "<td>" . $row["email"] . "</td>";
    echo "<td width=10px >" . $row["date_of_birth"] . "</td>";
    echo "<td align=center>" . $dept_name . "</td>"; // Department name
    echo "<td>" . $row["address"] . "</td>";
    echo "<td>" . $row["city"] . "</td>";
    echo "<td>" . $row["state"] . "</td>";
    echo "<td>" . $country . "</td>";
    echo "<td>" . $row["phone"] . "</td>";
    echo "</tr>";
    
}

echo "</table>";
?>



                    </form>

                </div>

        </section>
        </div>
</body>

</html>