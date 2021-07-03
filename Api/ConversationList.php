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
$customerid = $_POST["customer_id"];
$listingid = $_POST["listing_id"];

$result=array();
$result['Data']=array();
//listing id check from here to----------------------------------------------------------------------------------------------------------------
if($listingid=="nolistid"){
    $select = "SELECT conversation_id,seller_id,buyer_id,listing_id FROM ea_conversation 
WHERE seller_id = '$customerid' OR buyer_id = '$customerid' ";
$responce=mysqli_query($conn,$select);
while($row=mysqli_fetch_array($responce))
    {
       $s = $row['1'];
       $b = $row['2'];
       $c = $row['0'];
       $index['messege']= "nomessege";
       $index['check']= "nocheck";
       $index['name']= "nomame";
       if($s == $customerid){
           $index['check']= "seller";
           $selectinner = "SELECT first_name,last_name FROM ea_customer WHERE customer_id = '$b'";
           $res=mysqli_query($conn,$selectinner);
           $innerrow = mysqli_fetch_array($res);
           $index['name']= $innerrow['0'].' '.$innerrow['1'];
       }else if($b == $customerid){
           $index['check']= "buyer";
           $selectinner = "SELECT first_name,last_name FROM ea_customer WHERE customer_id = '$s'";
           $res=mysqli_query($conn,$selectinner);
           $innerrow = mysqli_fetch_array($res);
           $index['name']= $innerrow['0'].' '.$innerrow['1'];
       }
       $index['conversationid']= $row['0'];
       $index['sellerid']= $row['1'];
       $index['buyerid']= $row['2'];
       $index['listingid']= $row['3'];
        $msql = "SELECT message,created_at FROM ea_conversation_message WHERE conversation_id = '$c' ORDER BY created_at DESC LIMIT 1";
        $mres = mysqli_query($conn,$msql);
        $mrow = mysqli_fetch_array($mres);
        $m = $mrow['0'];
        if($m==null){
            $index['messege']= "nomsg";
        }else{
            $index['messege']= $mrow['0'];
        }
        

        array_Push($result['Data'],$index);

    }
    $result["success"]="1";
    echo json_encode($result);
}else{ //else condition here----------------------------------------------------------------------------------------------------------------
    $selectouter = "SELECT conversation_id,seller_id,buyer_id,listing_id FROM ea_conversation
WHERE listing_id = '$listingid' ";
$outres = mysqli_query($conn,$selectouter);
 while($row=mysqli_fetch_array($outres))
    {
       $s = $row['1'];
       $b = $row['2'];
       $c = $row['0'];
       $index['messege']= "nomessege";
       $index['check']= "nocheck";
       $index['name']= "nomame";
       if($s == $customerid){
           $index['check']= "seller";
           $selectinner = "SELECT first_name,last_name FROM ea_customer WHERE customer_id = '$b'";
           $res=mysqli_query($conn,$selectinner);
           $innerrow = mysqli_fetch_array($res);
           $index['name']= $innerrow['0'].' '.$innerrow['1'];
       }else if($b == $customerid){
           $index['check']= "buyer";
           $selectinner = "SELECT first_name,last_name FROM ea_customer WHERE customer_id = '$s'";
           $res=mysqli_query($conn,$selectinner);
           $innerrow = mysqli_fetch_array($res);
           $index['name']= $innerrow['0'].' '.$innerrow['1'];
       }
       $index['conversationid']= $row['0'];
       $index['sellerid']= $row['1'];
       $index['buyerid']= $row['2'];
       $index['listingid']= $row['3'];
        $msql = "SELECT message,created_at FROM ea_conversation_message WHERE conversation_id = '$c' ORDER BY created_at DESC LIMIT 1";
        $mres = mysqli_query($conn,$msql);
        $mrow = mysqli_fetch_array($mres);
        $m = $mrow['0'];
        if($m==null){
            $index['messege']= "nomsg";
        }else{
            $index['messege']= $mrow['0'];
        }
        

        array_Push($result['Data'],$index);

    }
    $result["success"]="1";
    echo json_encode($result);
}
//if condition ends here----------------------------------------------------------------------------------------------------------------

}
    mysqli_close($conn);
?>