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

$mail=$_POST["email"];
$password=$_POST["password_hash"];
$selectouter = "SELECT password_hash FROM ea_customer WHERE email = '$mail'";
$outerresponse = mysqli_query($conn,$selectouter);
$outerrow = mysqli_fetch_array($outerresponse);
$selectepass = $outerrow['0'];

//if (hash_equals($selectepass, crypt($password, $selectepass))) {
   //echo "Password verified!";
if ($password=$selectouter){
$select = "SELECT customer_id,first_name,last_name,customer_uid,email,password_hash,phone,gender,created_at FROM ea_customer
WHERE email = '$mail'";
$responce=mysqli_query($conn,$select);
if(mysqli_num_rows($responce) > 0){
    //echo 'response available';
    while($row=mysqli_fetch_array($responce))
    {
        $index['customerid']=  $row['0'];
        $index['customername']= $row['1'].' '.$row['2'];
        $index['customeruid']= $row['3'];
        $index['email']= $row['4'];
        $index['firstname']= $row['1'];
        $index['lastname']= $row['2'];
        $index['password']= $row['5'];
        $index['phone']= $row['6'];
        $index['gender']= $row['7'];
        $index['createdat']= $row['8'];
        array_Push($myresult['Data'],$index);
    }
}else{
    //echo 'response not available';
    $index['customerid']= "noid";
    $index['customername']= "noname";
    array_Push($myresult['Data'],$index);
    
}
}else{
    $index['customerid']= "noidmatch";
    $index['customername']= "nonamematch";
    array_Push($myresult['Data'],$index);
}


    $myresult["success"]="1";
    echo json_encode($myresult);
}
    mysqli_close($conn);
?>