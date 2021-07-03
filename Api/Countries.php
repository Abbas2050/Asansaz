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

$result=array();
$result['Data']=array();
$select="SELECT country_id,name FROM ea_country";
$responce=mysqli_query($conn,$select);

while($row=mysqli_fetch_array($responce))
    {
        
        $index['countryid']=  $row['0'];
        $index['name']= $row['1'];

        
        array_Push($result['Data'],$index);
    }
    $result["success"]="1";
    echo json_encode($result);
}
    mysqli_close($conn);
?>