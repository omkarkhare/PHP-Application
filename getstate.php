<?php

$host = 'localhost';
$dbuser = 'root';
$dbpass= 'root';
$dbname = 'omi';

$conn = mysqli_connect($host,$dbuser,$dbpass,$dbname);

//Get value posted in by ajax
    $selCountry = $_POST['thecountry'];
	
	
   // die('You sent: ' . $selCountry);
   
   
    

//Run DB query
    $query = "
	
	SELECT * from province 
	JOIN cntry on province.country = cntry.country_code
	WHERE 
	cntry.country_code = \"" . $selCountry . "\"
	";
	
	
    $result = mysqli_query($conn,$query) ;
	
	
	
   
	
	

//Prepare response html markup
    $r = '  
            
            <select id="state" name="state">
			
			<option selected value=""> </option>
    ';

//Parse mysql results and create response string. Response can be an html table, a full page, or just a few characters
   
        while ($row = mysqli_fetch_row($result)) {
            $r = $r . '<option value="' .$row[1]. '">' . $row[1] . '</option>';
        }
     

//Add this extra button for fun
    $r = $r . '</select>';

//The response echoed below will be inserted into the 
    echo $r;

    ?>