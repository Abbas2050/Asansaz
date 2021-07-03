<?php


namespace app\models;

use yii\db\Command;
use Yii;

class Api extends \app\yii\db\ActiveRecord
{
    
    public function init(){
        $this->enableCsrfValidation = false;
    }
    
    public static function getIdbyToken($token)
    {
        $connection = Yii::$app->db;
        //$command = $connection->createCommand('select * from ea_listing');
        //$users = $connection->createCommand('SELECT '. $field . ' FROM ' . $table_name)->where($condition)->queryAll();

        //$row = $command->queryRow(); //executes the SQL statement and returns the first row of the result.
        
        $select = "SELECT customer_id FROM ea_customer WHERE ea_customer.access_token = '$token' ";

        $users = $connection->createCommand($select)->queryAll();

        return $users;
        
    }
    
    public static function getAdsbyCategoryID($category_id)
    {
        $connection = Yii::$app->db;
        
        $active = 'active';
        //$command = $connection->createCommand('select * from ea_listing');
        $select = "SELECT ea_listing.title,ea_listing.slug,ea_listing.listing_id,ea_listing.price,ea_currency.symbol,
            ea_location.city,ea_listing.created_at,ea_location.longitude,ea_location.latitude,ea_category.category_id,
            ea_customer.customer_id,ea_customer.first_name,ea_customer.last_name,ea_listing.hide_phone,ea_listing.hide_email,
            ea_listing.description,ea_customer.email,ea_customer.phone,ea_listing.status
            FROM ((((ea_listing INNER JOIN ea_category ON ea_listing.category_id = ea_category.category_id)
            INNER JOIN ea_currency ON ea_listing.currency_id=ea_currency.currency_id)
            INNER JOIN ea_location ON ea_listing.location_id = ea_location.location_id)
            INNER JOIN ea_customer ON ea_listing.customer_id = ea_customer.customer_id) WHERE (ea_listing.status = '$active') AND (ea_listing.category_id = '$category_id') ";

        $users = $connection->createCommand($select)->queryAll();

        //$row = $command->queryRow(); //executes the SQL statement and returns the first row of the result.

        return $users;
        
    }
    
    public static function getAdDetailbyID($id)
    {
        $connection = Yii::$app->db;
        //$command = $connection->createCommand('select * from ea_listing');
        //$users = $connection->createCommand('SELECT '. $field . ' FROM ' . $table_name)->where($condition)->queryAll();

        //$row = $command->queryRow(); //executes the SQL statement and returns the first row of the result.
        
        $select = "SELECT ea_listing.title,ea_listing.slug,ea_listing.listing_id,ea_listing.price,ea_currency.symbol,
            ea_location.city,ea_listing.created_at,ea_location.longitude,ea_location.latitude,ea_category.category_id,
            ea_customer.customer_id,ea_customer.first_name,ea_customer.last_name,ea_listing.hide_phone,ea_listing.hide_email,
            ea_listing.description,ea_customer.email,ea_customer.phone,ea_listing.status
            FROM ((((ea_listing INNER JOIN ea_category ON ea_listing.category_id = ea_category.category_id)
            INNER JOIN ea_currency ON ea_listing.currency_id=ea_currency.currency_id)
            INNER JOIN ea_location ON ea_listing.location_id = ea_location.location_id)
            INNER JOIN ea_customer ON ea_listing.customer_id = ea_customer.customer_id)WHERE ea_listing.listing_id = '$id' ";

        $users = $connection->createCommand($select)->queryAll();

        return $users;
        
    }
    
    public static function getProfilebyToken($token)
    {
        $connection = Yii::$app->db;
        //$command = $connection->createCommand('select * from ea_listing');
        //$users = $connection->createCommand('SELECT '. $field . ' FROM ' . $table_name)->where($condition)->queryAll();

        //$row = $command->queryRow(); //executes the SQL statement and returns the first row of the result.
        
        $select = "SELECT first_name, last_name, email, phone FROM ea_customer WHERE access_token = '$token'";

        $users = $connection->createCommand($select)->queryAll();

        return $users;
        
    }
    
    public static function updateProfilebyToken($token)
    {
        $connection = Yii::$app->db;
        
        
        $select = "SELECT first_name, last_name, email, phone FROM ea_customer WHERE access_token = '$token'";

        $users = $connection->createCommand($select)->queryAll();

        return $users;
        
    }
    
    
    

}
