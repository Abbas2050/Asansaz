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
$parentid=$_POST["parent_id"];
$result=array();
$result['Data']=array();
$select="SELECT name,category_id,parent_id FROM ea_category WHERE parent_id= '$parentid'";
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
        $index['name']=  $row['0'];
        $index['category_id']=  $row['1'];
        $index['parent_id']=  $row['2'];
        $index['pid']= $parentid;
        array_Push($result['Data'],$index);
    }
    $result["success"]="1";
    echo json_encode($result);
  }
}
    mysqli_close($con);
?>