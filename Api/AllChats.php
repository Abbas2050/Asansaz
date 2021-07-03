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

//$listid=$_POST["listing_id"];
$result=array();
$result['Data']=array();

/*$select = "SELECT ea_conversation_message.seller_id,ea_conversation_message.buyer_id,ea_conversation.conversation_id,
ea_conversation.listing_id,ea_conversation_message.message,
ea_conversation_message.created_at AS time 
FROM ((ea_conversation INNER JOIN ea_conversation_message ON ea_conversation.conversation_id = ea_conversation_message.conversation_id)
INNER JOIN ea_customer ON ea_conversation.buyer_id = ea_customer.customer_id)
WHERE ea_conversation.seller_id = 2 AND ea_conversation.buyer_id = 1 AND ea_conversation.listing_id = 74 ORDER BY time ASC";*/
$selectouter = "SELECT listing_id,customer_id FROM ea_listing WHERE customer_id = 1095395";
$outres = mysqli_query($con, $selectouter);
if($outres){
    echo 'outer query work';
}
$select = "SELECT conversation_id,seller_id,buyer_id,listing_id,created_at FROM ea_conversation ORDER BY created_at ASC";

$responce=mysqli_query($con,$select);
if($responce){
    //echo 'response available';
}
while($row=mysqli_fetch_array($responce))
    {
          $index['conversationid']= $row['0'];
          $index['sellerid']= $row['0'];
          $index['buyerid']= $row['0'];
          $index['listingid']= $row['0'];
          $index['createdat']= $row['0'];
 


        array_Push($result['Data'],$index);

    }
    $result["success"]="1";
    echo json_encode($result);
}
    mysqli_close($con);
?>