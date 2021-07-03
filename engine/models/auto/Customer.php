<?php

namespace app\models\auto;

use Yii;

/**
 * This is the model class for table "{{%customer}}".
 *
 * @property int $customer_id
 * @property string $customer_uid
 * @property int $group_id
 * @property string|null $customer_type
 * @property string $nickname
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * @property string $access_token
 * @property string $password_reset_key
 * @property string $activation_key
 * @property string $activation_date
 * @property string $phone
 * @property string $gender
 * @property string $birthday
 * @property string $avatar
 * @property string $source
 * @property string $display_option
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
  * @property int|null $parent_product_id
  * @property string|null $company_type
  * @property string|null $company_name
  * @property string|null $company_address
  * @property int|null $tc_id
  * @property int|null $tax_office_id
  * @property string|null $province
  * @property string|null $district
  * @property string|null $neighborhood
  * @property string|null $company_primary_number
 *
 * @property Conversation[] $conversations
 * @property Conversation[] $conversations0
 * @property ConversationMessage[] $conversationMessages
 * @property ConversationMessage[] $conversationMessages0
 * @property CustomerStore[] $customerStores
 * @property Listing[] $listings
 * @property ListingFavorite[] $listingFavorites
 * @property Order[] $orders
 */
class Customer extends \app\yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%customer}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group_id','parent_product_id','tc_id','tax_office_id'], 'integer'],
            [['activation_date', 'birthday', 'created_at', 'updated_at'], 'safe'],
            [['created_at', 'updated_at'], 'required'],
            [['customer_uid'], 'string', 'max' => 13],
            [['nickname', 'first_name', 'last_name','customer_type','company_type','company_name','company_address','company_primary_number','province','district','neighborhood'], 'string', 'max' => 100],
            [['customer_type','company_type','company_name','company_address','company_primary_number','province','district','neighborhood'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 150],
            [['password_hash', 'auth_key', 'access_token'], 'string', 'max' => 64],
            [['password_reset_key'], 'string', 'max' => 32],
            [['activation_key'], 'string', 'max' => 40],
            [['phone', 'source'], 'string', 'max' => 50],
            [['gender'], 'string', 'max' => 1],
            [['avatar'], 'string', 'max' => 255],
            [['display_option', 'status'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'customer_id' => 'Customer ID',
            'customer_uid' => 'Customer Uid',
            'group_id' => 'Group ID',
            'customer_type' => 'Customer Type',
            'nickname' => 'Nickname',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'password_hash' => 'Password Hash',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
            'password_reset_key' => 'Password Reset Key',
            'activation_key' => 'Activation Key',
            'activation_date' => 'Activation Date',
            'phone' => 'Phone',
            'gender' => 'Gender',
            'birthday' => 'Birthday',
            'avatar' => 'Avatar',
            'source' => 'Source',
            'display_option' => 'Display Option',
            'province' => 'Province',
            'company_address' => 'Company Address',
            'company_name' => 'Company Name',
            'company_type' => 'Company Type',
            'company_primary_phone_number' => 'Company Primary Phone Number',
            'district' => 'District',
            'neighborhood' => 'Neighborhood',
            'parent_product_it' => 'Parent Product Id',
            'tc_id' => 'Tc Id',
            'tax_office_id' => 'Tax Office Id',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConversations()
    {
        return $this->hasMany(Conversation::className(), ['buyer_id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConversations0()
    {
        return $this->hasMany(Conversation::className(), ['seller_id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConversationMessages()
    {
        return $this->hasMany(ConversationMessage::className(), ['buyer_id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConversationMessages0()
    {
        return $this->hasMany(ConversationMessage::className(), ['seller_id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerStores()
    {
        return $this->hasMany(CustomerStore::className(), ['customer_id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getListings()
    {
        return $this->hasMany(Listing::className(), ['customer_id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getListingFavorites()
    {
        return $this->hasMany(ListingFavorite::className(), ['customer_id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['customer_id' => 'customer_id']);
    }

    /**
     * {@inheritdoc}
     * @return CustomerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CustomerQuery(get_called_class());
    }
}
