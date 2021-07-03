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
$conid = $_POST["conversation_id"];

$result=array();
$result['Data']=array();

$select = "SELECT seller_id,buyer_id,message
FROM ea_conversation_message WHERE conversation_id = '$conid'  ";
$responce=mysqli_query($conn,$select);
if($responce){
    //echo 'response available';
}
while($row=mysqli_fetch_array($responce))
    {
        if($row['0']==null){
            $index['sellerid']= "noid";
        }else {
            $index['sellerid']=  $row['0'];
        }
        if($row[1]==null){
            $index['buyerid']= "noid";
        }else{
           $index['buyerid']=  $row['1']; 
        }
        
        $index['messege']=  $row['2'];

        array_Push($result['Data'],$index);

    }
    $result["success"]="1";
    echo json_encode($result);
}
    mysqli_close($conn);
?>