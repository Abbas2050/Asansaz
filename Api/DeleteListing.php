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
$myresult = array();
$myresult['Data'] = array();

    // echo "db connected ";
    $listid=  "107"; //$_POST["listing_id"];
     $sel1 = "SELECT location_id FROM ea_listing WHERE listing_id ='$listid'";
  $response1 = mysqli_query($con,$sel1);
  if(!$response1){
      //response1
  }else{
      $result1 = mysqli_fetch_array($response1);
      $locid = $result1['0'];
      $myindex['locationid'] = $locid;
      $myindex['messege'] = "successfuly connect to database";
      $myindex['listingid'] = $listid;
     array_Push($myresult['Data'],$myindex);
  echo json_encode($myresult);
  $del1 = "DELETE FROM ea_listing WHERE listing_id = '$listid'";
  $del2 = "DELETE FROM ea_location WHERE location_id = '$locid'";
  $del3 = "DELETE FROM ea_category_field_value WHERE listing_id = '$listid'";
  $del4 = "DELETE FROM ea_listing_view WHERE listing_id = '$listid'";
  $del4 = "DELETE FROM ea_listing_favorite WHERE listing_id = '$listid'";
  $res2 = mysqli_query($con,$del1);
  $res3 = mysqli_query($con,$del2);
  $res4 = mysqli_query($con,$del3);
  $res5 = mysqli_query($con,$del4);
  $res6 = mysqli_query($con,$del5);
  if ($con->query($del2) === TRUE) {
      echo 'response 2 aval';
  }else{
      echo 'resp 2 not avail';
  }
  if($res2){
      echo 'res2';
      if($res3){
          echo 'res3';
          if($res4){
              echo 'res4';
              if($res5){
                  echo 'res5';
                  if($res6){
                      echo 'res6';
       
                  }
              }
          }
      }
  }else{
      echo 'not res2';
  }
  }
    
 
}

?>