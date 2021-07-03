<?php
class Product{
 
    // database connection and table name
    private $conn;
    private $table_name = "ea_customer";
 
    // object properties
    public $customer_id;
public $customer_uid;
public $group_id;
public $nickname;
public $first_name;
public $last_name;
public $email;
public $activation_date;
public $phone;
public $gender;
public $birthday;
public $avatar;
public $source;
public $display_option;
public $status;
public $created_at;
public $updated_at;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
        // read products
function read(){
 
    // select all query
    $query = "SELECT * FROM " . $this->table_name . ";
           
            
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}
    }
}
?>