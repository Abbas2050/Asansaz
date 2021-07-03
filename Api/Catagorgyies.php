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
$select="SELECT name,parent_id,category_id,icon,description FROM ea_category WHERE parent_id IS NULL ";
$responce=mysqli_query($conn,$select);
while($row=mysqli_fetch_array($responce))
    {
        $index['name']=  $row['0'];
        $index['parent_id']= $row['1'];
        $index['category_id']= $row['2'];
        $index['icon']= $row['3'];
        $index['desc']= $row['4'];

        array_Push($result['Data'],$index);
    }
    $result["success"]="1";
    echo json_encode($result);
}
    mysqli_close($con);
?>