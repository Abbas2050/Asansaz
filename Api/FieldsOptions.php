<?php
$servername = "bigserver.host.com.pk";
$username = "bahriamall_olx";
$password = "a^@EP4y*,(=ud";
$dbname = "bahriamall_olx";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}else{

$fieldid=$_POST["field_id"];
$result=array();
$result['Data']=array();
$select="SELECT option_id,field_id,name FROM ea_category_field_option WHERE field_id= '$fieldid'";
$responce=mysqli_query($conn,$select);
if (mysqli_num_rows($responce) == 0) { 
   //echo 'no result fond';
    $myindex['name'] = "no record found";
    array_Push($result['Data'],$myindex);
    echo json_encode($result);
    }
   else
   {
while($row=mysqli_fetch_array($responce))
    {
        $index['optionid']=  $row['0'];
        $index['fieldid']= $row['1'];
        $index['name']=  $row['2'];
        
        array_Push($result['Data'],$index);
    }
    $result["success"]="1";
    echo json_encode($result);
  }
}
    mysqli_close($conn);
?>