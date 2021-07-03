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

$categoryid=$_POST["category_id"];
$result=array();
$result['Data']=array();
$select="SELECT field_id,label FROM ea_category_field WHERE category_id= '$categoryid'";
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
        $index['fieldid']=  $row['0'];
        $index['name']=  $row['1'];

        array_Push($result['Data'],$index);
    }
    $result["success"]="1";
    echo json_encode($result);
  }
}
    mysqli_close($conn);
?>