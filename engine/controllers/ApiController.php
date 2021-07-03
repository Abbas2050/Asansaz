<?php
namespace app\controllers;

use app\helpers\CsvHelper;
use app\helpers\StringHelper;
use app\models\Conversation;
use app\models\ConversationMessage;
use app\models\CustomerStore;
use app\models\Listing;
use app\models\ListingSearch;
use app\models\ListingFavorite;
use app\models\Category;
use app\models\CategoryField;
use app\models\Country;
use app\models\Location;
use app\models\Zone;
use app\models\Invoice;
use app\models\Customer;
use app\models\CustomerForgotForm;
use app\models\CustomerLoginForm;
use app\models\AdSearch;
use app\models\Api;
use app\models\ListingPackageUser;
use app\models\ListingStat;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use app\yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use app\yii\filters\OwnerAccessRule;
use yii\web\UploadedFile;
use yii\helpers\Url;
use Yii;

class ApiController extends Controller
{
     /**
     * Constants
     */
    const ADS_PER_PAGE = 20;
    
    
    public function init(){
        $this->enableCsrfValidation = false;
    }

    public function actionIndex()
    {
        return 'Please add action with the controller like api/login';
    }

    
    public function actionLogin()
    {
        if(request()->isPost) { 
            
             //$LoginForm = request()->post('email');
        
        $model = new CustomerLoginForm();
         
        
            $LoginForm = array(
                'email' => request()->post('email'),
                'password' => request()->post('password')
                );
        
        //$LoginForm = request()->post('CustomerLoginForm');
        
        $customer = Customer::findByEmail($LoginForm['email']);
        
        
        if($customer){
               
               
            $form = array(
                'CustomerLoginForm' => $LoginForm
                );
            
            
            
            if ($model->load($form) && $model->login()) {
                
                $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                $access_token = substr(str_shuffle($str_result),0, 75);
                //print_r($access_token);die();
                
                $id = $customer->customer_id;
                $modelTest = Customer::findOne($id);
                $modelTest->scenario = Customer::SCENARIO_UPDATE;
                //$modelTest->load($access_form);
                $modelTest->access_token = $access_token;
                
                //print_r($modelTest);die();
        
                if(!$modelTest->save()){
                    
                    $result = array(
                    'status' => false,
                    'data' => '',
                    'message' => 'Not able to generate access token. Please trty again'
                    );
                    
                return json_encode($result);
                }
                
                
                $result = array(
                    'status' => true,
                    'data' => '',
                    'message' => 'Login Successful',
                    'access_token' => $access_token
                    );
                    
                return json_encode($result);
                
                
            }
            else{
                
                $result = array(
                    'status' => false,
                    'data' => '',
                    'message' => 'Login Failed! Password does not match',
                    'token' => ''
                    );
                    
                return json_encode($result);
                
                
                
                
            }   
            
        }
        else{
            $result = array(
                    'status' => false,
                    'data' => '',
                    'message' => 'Login Failed! Email does not exist',
                    'token' => ''
                    
                    );
                    
                return json_encode($result);
                
                
            
            
        }
        
            
            
        }
        else{
            
            $result = array(
                    'status' => false,
                    'data' => '',
                    'message' => 'Get Request Not Allowed.'
                    
                    );
                    
                return json_encode($result);
            
        }
       
        
        
        
    }
    
    public function actionForgot() {
        
        if(request()->isPost) { 

        $model = new CustomerForgotForm();
        $forgetForm = array(
                'email' => request()->post('email')
                );
                
        $check_mail = Customer::findByEmail($forgetForm['email']);
        
        //print_r($check_mail);die();
        
        if($check_mail){
            /* if form is submitted */
        $form = array(
                'CustomerForgotForm' => $forgetForm
                );
                
        if ($model->load($form) && $model->sendEmail()) {
            $result = array(
                    'status' => true,
                    'data' => '',
                    'message' => 'Please check your email for confirmation!',
                    
                    );
                    
                return json_encode($result);
        }
        else{
            
            $result = array(
                    'status' => false,
                    'data' => '',
                    'message' => 'Unable to send Email.',
                    
                    );
                    
                return json_encode($result);
            
        }
    
            
        }
        else{
            
            $result = array(
                    'status' => false,
                    'data' => '',
                    'message' => 'Email does not exist.',
                    
                    );
                    
                return json_encode($result);
            
        }
        
    
    }
        else{
            
            $result = array(
                    'status' => false,
                    'data' => '',
                    'message' => 'Get Request Not Allowed.',
                    
                    );
                    
                return json_encode($result);
            
        }
    }
    
    
    public function actionJoin()
    {
        if(request()->isPost) { 
            
            $model = new Customer([
                                      'scenario' => Customer::SCENARIO_CREATE
                              ]);
            
            if (request()->post('registrationType') == 'corporate') {
                $post = Yii::$app->request->post();
                $model->customer_type = $post['registrationType'];
                $model->parent_product_id = $post['corporateForm_parentProductId'];
                $model->company_type = $post['companyType'];
                $model->company_name = $post['corporateForm_companyName'];
                $model->company_address = $post['corporateForm_address'];
                $model->tc_id = $post['corporateForm_idNumber'];
                $model->tax_office_id = $post['corporateForm_taxNumber'];
                $model->province = isset($post['corporateForm_province']) && $post['corporateForm_province'] !== '' ? $post['corporateForm_province'] : null;
                $model->district = isset($post['corporateForm_district']) && $post['corporateForm_district'] !== '' ? $post['corporateForm_district'] : null;
                $model->neighborhood = isset($post['corporateForm_neighborhood']) && $post['corporateForm_neighborhood'] !== '' ? $post['corporateForm_neighborhood'] : null;
                $model->company_primary_number = isset($post['corporateForm_firstPhone']) && $post['corporateForm_firstPhone'] !== '' ? $post['corporateForm_firstPhone'] : null;
            }
        
        //$customerBasicInformation = request()->post('Customer');
        
        $customerBasicInformation = array(
            'first_name' => request()->post('first_name'),
            'last_name' => request()->post('last_name'),
            'email' => request()->post('email'),
            'password' => request()->post('password'),
            'nickname' => request()->post('nickname')
            );

        $emailExist = Customer::findByEmail($customerBasicInformation['email']);
        if ($emailExist) {
            $result = array(
                    'status' => false,
                    'data' => '',
                    'message' => 'Email already exists.',
                    
                    );
                    
                    return json_encode($result);

        }
        else {
            
            $corporateForm = array(
                'parentProductId' => request()->post('parentProductId'),
                'companyName' => request()->post('companyName'),
                'address' => request()->post('address'),
                'idNumber' => request()->post('idNumber'),
                'taxNumber' => request()->post('taxNumber'),
                'firstPhone' => request()->post('firstPhone')
                );
            
            $form = array(
                'registrationType' => request()->post('registrationType'),
                'Customer' => $customerBasicInformation,
                'companyType' => request()->post('companyType'),
                'corporateForm' => $corporateForm,
                'endUserLicenceAgreement' => request()->post('endUserLicenceAgreement'),
                'communicationAgreement' => request()->post('communicationAgreement')
                
                );

            if ($model->load($form) && $model->save(false)) {

                if (options()->get('app.settings.common.confirmationEmail', 0) != 0) {
                    $model->pendingAccountActivation();
                    
                    $result = array(
                    'status' => true,
                    'data' => '',
                    'message' => 'Your account was created successfully! We have sent you the activation email.',
                    
                    );
                    
                    return json_encode($result);

                }



                $model->sendRegistrationEmail();

                $result = array(
                    'status' => true,
                    'data' => '',
                    'message' => 'Your account was created successfully!',
                    
                    );
                    
                return json_encode($result);
            }
            else{
                
                $result = array(
                    'status' => false,
                    'data' => '',
                    'message' => 'Not able to create account.',
                    
                    );
                    
                    return json_encode($result);
                
            }
        }
        
        }
        else{
            
            $result = array(
                    'status' => false,
                    'data' => '',
                    'message' => 'Get Request Not Allowed.',
                    
                    );
                    
                return json_encode($result);
            
        }
        
    }
    
    public function actionCategories() {
        
        if(request()->isGet) {
            
            $token_valid = Customer::findIdentityByAccessToken(request()->get('access_token'),null);
            if($token_valid->access_token){
                
                if(request()->get('parent_id')){
                    $parent_id = request()->get('parent_id');
                }
                else{
                    $parent_id = NULL;
                }
                
                $childCategories = Category::find()->where(['parent_id' => $parent_id, 'status' => Category::STATUS_ACTIVE])->orderBy(['sort_order' => SORT_ASC])->all();
            
            $categories = array();
            
            foreach($childCategories as $row){
                $category = array(
                    'category_id' => $row->category_id,
                    'parent_id' => $row->parent_id,
                    'name' => $row->name,
                    'slug' => $row->slug,
                    'description' => $row->description,
                    'sort_order' => $row->sort_order,
                    'meta_keywords' => $row->meta_keywords,
                    'meta_description' => $row->meta_description,
                    'status' => $row->status
                    );
                    
                    array_push($categories, $category);
            }
            //print_r($categories);die();
            
            $result = array(
                    'status' => true,
                    'data' => $categories,
                    'message' => 'List of categories',
                    
                    );
                    
                    return json_encode($result);
            }
            else{
                
                $result = array(
                    'status' => false,
                    'data' => '',
                    'message' => 'Access token is not valid',
                    
                    );
                    
                    return json_encode($result);
                
            }
            
            
            
    
    }
        else{
            
            $result = array(
                    'status' => false,
                    'data' => '',
                    'message' => 'POST Request Not Allowed.',
                    
                    );
                    
                return json_encode($result);
            
        }
    }
    
    
    
    public function actionHome()
    {
        if(request()->isGet) { 
            
            $token_valid = Customer::findIdentityByAccessToken(request()->get('access_token'),null);
            if($token_valid->access_token){
                
                $slug = request()->get('slug');
                
                $category_id = request()->get('category_id');
                
                $results = Api::getAdsbyCategoryID($category_id);
                //print_r($results);die();
                
                if($results){
                    $result = array(
                    'status' => true,
                    'data' => $results,
                    'message' => 'Search results by category ID',
                    
                    );
                    
                    return json_encode($result);$result = array(
                    'status' => true,
                    'data' => $data,
                    'message' => 'Detail of Ad',
                    
                    );
                    
                    return json_encode($result);
                }
                else{
                    $result = array(
                    'status' => false,
                    'data' => $results,
                    'message' => 'No data found',
                    
                    );
                    
                    return json_encode($result);
                }
                
                
                
                
                //As per website
                
                // $category = $this->findCategoryBySlug($slug);
                // $searchCategories = Category::find()->where(['status' => Category::STATUS_ACTIVE])->orderBy(['sort_order' => SORT_ASC])->all();
                // $categories = Category::getHierarchyOfCategoriesBySlug($slug, true);
                // $childCategories = Category::find()->where(['parent_id' => $category->category_id, 'status' => Category::STATUS_ACTIVE])->orderBy(['sort_order' => SORT_ASC])->all();
                
                // if ($slug = request()->get('slug')) {
                //     $chosenCategory = self::findCategoryBySlug($slug);
                // }
                
                // $searchModel = new ListingSearch();

                // // ads
                // $AdsProvider = $searchModel->categorySearch(request()->queryParams);
                // $AdsProvider->query->andWhere(['category_id' => $categories])
                //     ->orderBy(['promo_expire_at' => SORT_DESC, 'created_at' => SORT_DESC]);
                // //$AdsProvider->sort = ['defaultOrder' => ['promo_expire_at' => SORT_DESC]];
                // // $AdsProvider->pagination = [
                // //     'defaultPageSize' => self::ADS_PER_PAGE,
                // // ];
                
                // $listing = new Listing();
                
                // $listingResult = $listing->findBySlug($slug);
                
                // $AdSearchSave = new AdSearch();
                // //$AdSearchSave->search_word = !empty($searchPharsead)?$searchPharsead:'';
                // $AdSearchSave->category = !empty($category->name)?$category->name:'';
                // $AdSearchSave->save(false);
                
                
                // print_r($AdSearchSave);die();
                        
                
            }
            else{
                
                $result = array(
                    'status' => false,
                    'data' => '',
                    'message' => 'Access token is not valid',
                    
                    );
                    
                    return json_encode($result);
                
            }
        
        }
        else{
            
            $result = array(
                    'status' => false,
                    'data' => '',
                    'message' => 'Post Request Not Allowed.',
                    
                    );
                    
                return json_encode($result);
            
        }
        
    }
    
    protected function findCategoryBySlug($slug)
    {
        if (($category = Category::findOne(['slug' => $slug, 'status' => Category::STATUS_ACTIVE])) !== null) {
            return $category;
        }
        throw new NotFoundHttpException(t('app', 'The requested page does not exist.'));
    }
    
    
    public function actionAdbyslug()
    {
        if(request()->isGet) { 
            
            $token_valid = Customer::findIdentityByAccessToken(request()->get('access_token'),null);
            if($token_valid->access_token){
                
                $slug = request()->get('slug');
                
                $ad = $this->findAdBySlug($slug);

                if (!$ad->isActive && !$ad->isExpired) {
                    if (!$ad->isOwnedBy(app()->customer->id)) {
                        $result = array(
                            'status' => false,
                            'data' => '',
                            'message' => 'The ad is not active yet, please try again later.',
                            
                            );
                            
                            return json_encode($result);
                        
                        //throw new NotFoundHttpException(t('app', 'The ad is not active yet, please try again later.'));
                    }
                    
                    $result = array(
                            'status' => false,
                            'data' => '',
                            'message' => 'Your ad is not active yet and it\'s visible only to you!',
                            
                            );
                            
                            return json_encode($result);
                            
                    //notify()->addWarning(t('app', 'Your ad is not active yet and it\'s visible only to you!'));
                    
                    if ($ad->isExpired) {
                        $result = array(
                            'status' => false,
                            'data' => '',
                            'message' => 'This ad is expired!',
                            
                            );
                        //notify()->addWarning(t('app', 'This ad is expired!'));
                    } 
                    
                }
                
                //Get all detail of Ad bt ID
                $adDetail = Api::getAdDetailbyID($ad->listing_id);
                
                //$customer = Customer::findOne($ad->customer_id);
                
                
                //Get images of Ad
                    
                $images = $ad->getImages()->orderBy(['sort_order' => SORT_ASC])->all(); 
                $image_urls = array();
                foreach($images as $row){
                    $image_path = Url::base(true) . $row->image_path;
                    array_push($image_urls, $image_path);
                    
                }
                //print_r($image_urls);die();
                
                
                $data = array(
                    'ad'         => $adDetail,
                    'images'     => $image_urls
                );
                
                $result = array(
                    'status' => true,
                    'data' => $data,
                    'message' => 'Detail of Ad',
                    
                    );
                    
                    return json_encode($result);
                
                
                
            }
            else{
                
                $result = array(
                    'status' => false,
                    'data' => '',
                    'message' => 'Access token is not valid',
                    
                    );
                    
                    return json_encode($result);
                
            }
                
                
        
        }
        else{
            
            $result = array(
                    'status' => false,
                    'data' => '',
                    'message' => 'Post Request Not Allowed.',
                    
                    );
                    
                return json_encode($result);
            
        }
        
    }
    
    protected function findAdBySlug($slug)
    {
        if (($ad = Listing::findOne(['slug' => $slug])) !== null) {
            return $ad;
        }
        
         $result = array(
                            'status' => false,
                            'data' => '',
                            'message' => 'The ad is not active yet, please try again later.',
                            
                            );
                            
                            return json_encode($result);

        //throw new NotFoundHttpException(t('app', 'The requested page does not exist.'));
    }
    
    public function actionProfile()
    {
        if(request()->isGet) { 
            
            $token_valid = Customer::findIdentityByAccessToken(request()->get('access_token'),null);
            if($token_valid->access_token){
                
                $profile = array(
                    'nickname' => $token_valid->nickname,
                    'first_name' => $token_valid->first_name,
                    'last_name' => $token_valid->last_name,
                    'email' => $token_valid->email,
                    'phone' => $token_valid->phone
                    );
                
                $result = array(
                    'status' => true,
                    'data' => $profile,
                    'message' => 'Detail of profile',
                    
                    );
                    
                    return json_encode($result);
                
            }
            else{
                
                $result = array(
                    'status' => false,
                    'data' => '',
                    'message' => 'Access token is not valid',
                    
                    );
                    
                    return json_encode($result);
                
            }
                
                
        
        }
        else{
            
            $result = array(
                    'status' => false,
                    'data' => '',
                    'message' => 'Post Request Not Allowed.',
                    
                    );
                    
                return json_encode($result);
            
        }
        
    }
    
    public function actionUpdateprofile()
    {
        if(request()->isPOST) { 
            
            $token_valid = Customer::findIdentityByAccessToken(request()->post('access_token'),null);
            if($token_valid)
            {
                
                
                    $customer = Customer::findOne($token_valid->customer_id);
                    $customer->first_name = request()->post('first_name');
                    $customer->last_name = request()->post('last_name');
                    //$customer->email = request()->post('email');
                    $customer->phone = request()->post('phone');
                    $customer->nickname = request()->post('nickname');
                    
                    if($customer->save()){
                        $result = array(
                            'status' => true,
                            'data' => '',
                            'message' => 'Profile update successfully',
                            
                            );
                            
                            return json_encode($result);
                        
                        
                    }
                    else{
                        $result = array(
                            'status' => false,
                            'data' => '',
                            'message' => 'Not able to update profile',
                            
                            );
                            
                            return json_encode($result);
                        
                    }
                
                
            }
            else{
                
                $result = array(
                    'status' => false,
                    'data' => '',
                    'message' => 'Access token is not valid',
                    
                    );
                    
                    return json_encode($result);
                
            }
                
                
        
        }
        else{
            
            $result = array(
                    'status' => false,
                    'data' => '',
                    'message' => 'Get Request Not Allowed.',
                    
                    );
                    
                return json_encode($result);
            
        }
        
    }
    
    public function actionAdpost()
    {
        if(request()->isGet) { 
            
            $token_valid = Customer::findIdentityByAccessToken(request()->get('access_token'),null);
            if($token_valid->access_token){
                
                
                
            }
            else{
                
                $result = array(
                    'status' => false,
                    'data' => '',
                    'message' => 'Access token is not valid',
                    
                    );
                    
                    return json_encode($result);
                
            }
                
                
        
        }
        else{
            
            $result = array(
                    'status' => false,
                    'data' => '',
                    'message' => 'Post Request Not Allowed.',
                    
                    );
                    
                return json_encode($result);
            
        }
        
    }
    
    
    public function actionTest2()
    {
        if(request()->isGet) { 
            
            $token_valid = Customer::findIdentityByAccessToken(request()->get('access_token'),null);
            if($token_valid){
                
                
                
            }
            else{
                
                $result = array(
                    'status' => false,
                    'data' => '',
                    'message' => 'Access token is not valid',
                    
                    );
                    
                    return json_encode($result);
                
            }
                
                
        
        }
        else{
            
            $result = array(
                    'status' => false,
                    'data' => '',
                    'message' => 'Post Request Not Allowed.',
                    
                    );
                    
                return json_encode($result);
            
        }
        
    }
    
    public function actionTest()
    {
        if(request()->isPost) { 
        
        }
        else{
            
            $result = array(
                    'status' => false,
                    'data' => '',
                    'message' => 'Get Request Not Allowed.',
                    
                    );
                    
                return json_encode($result);
            
        }
        
    }

}


?>