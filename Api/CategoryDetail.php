
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
$listid=$_POST["listing_id"];
$categoryid=$_POST["category_id"];
$result=array();
$result['Data']=array();


$select = "SELECT ea_category.name, ea_listing.title,ea_category_field.field_id,ea_category_field.label,ea_category_field_value.value 
FROM (((ea_category INNER JOIN ea_listing ON ea_category.category_id = ea_listing.category_id)
INNER JOIN ea_category_field ON ea_category.category_id = ea_category_field.category_id)
INNER JOIN ea_category_field_value ON ea_category_field.field_id = ea_category_field_value.field_id) 
WHERE ea_category.category_id = '$categoryid' AND ea_listing.listing_id = '$listid' AND ea_category_field_value.listing_id = '$listid' ";

$responce=mysqli_query($conn,$select);
if($responce){
    //echo 'response available';
}
while($row=mysqli_fetch_array($responce))
    {
      $index['categoryname']= $row['0'];
      $index['listingtitle']= $row['1'];
      $index['fieldid']= $row['2'];
      $index['label']= $row['3'];
      $index['value']= $row['4'];

        array_Push($result['Data'],$index);

    }
    $result["success"]="1";
    echo json_encode($result);
}
    mysqli_close($conn);
?>