<?php

use yii\bootstrap\ActiveForm;
use app\assets\AccountAsset;
use yii\authclient\widgets\AuthChoice;
use app\helpers\DateTimeHelper;
use yii\helpers\Url;

AccountAsset::register($this);
?>
<style>

    @media only screen and (min-width: 1280px) {
        .custom-container {
            width: 990px !important;
            font-family: 'Quicksand';
        }
    }

    .registration {
        position: relative;
        background: #fff;
        border-radius: 3px;
        margin-right: 20px;
        padding: 0 50px 83px 50px;
        font-size: 15px;
        color: #505050;
        font-weight: 500;
        border: 1px solid #dedede;
    }

    .form-style-wrapper textarea, .form-style-wrapper input, .form-style-wrapper select {
        font-size: 14px !important;
        background-color: #fff;
    }

    .registration .user-register-form #errorList {
        width: 464px;
    }

    ol, ul {
        list-style: none;
    }

    .registration .user-register-form .registration-type {
        padding-bottom: 10px;
        display: inline-block;
    }

    .form-style-wrapper input[type="radio"], .form-style-wrapper input[type="checkbox"] {
        margin: 0;
        margin-top: 1px;
        line-height: normal;
        display: none;
        opacity: 0;
        -ms-filter: "alpha(opacity=0)";
        filter: alpha(opacity=0);
        width: 0;
        height: 0;
    }

    .registration .user-register-form .registration-type label {
        padding-right: 1px;
        margin-right: 15px;
        display: block;
        float: left;
        margin-bottom: 4px;
    }

    .form-style-wrapper input[type="radio"] + label, .form-style-wrapper input[type="checkbox"] + label {
        padding-left: 22px;
        position: relative;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        -o-user-select: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .form-style-wrapper input[type="radio"]:not(:focus):checked + label:before, .form-style-wrapper input[type="checkbox"]:not(:focus):checked + label:before {
        border-color: #da8016;
    }

    .form-style-wrapper input[type="radio"] + label:before {
        content: '';
        display: inline-block;
        position: absolute;
        width: 18px;
        height: 18px;
        top: 2px;
        left: 0;
        border: 1px solid #ccc;
        border-radius: 14px;
    }

    .form-style-wrapper input[type="radio"]:checked + label:after {
        content: '';
        background-color: #da8016;
        display: inline-block;
        position: absolute;
        border: 1px solid #da8016;
        border-color: #da8016;
        border-radius: 6px;
        width: 10px;
        height: 10px;
        top: 6px;
        left: 4px;
    }

    input[type=checkbox], input[type=radio] {
        cursor: pointer;
    }

    .registration .user-register-form .registration-type .tipitip-icon {
        margin-bottom: 1px;
        margin-left: 5px;
    }

    .registration a {
        color: #438ed8;
    }

    .tipitip-icon {
        height: 22px;
        width: 22px;
        display: inline-block;
        margin-top: -8px;
        position: relative;
        top: 7px;
        background: url('<?=Yii::getAlias('@web/assets/site/img/signInIcons.png')?>') no-repeat scroll 0 0;
        margin-left: 5px;
    }

    .registration .user-register-form .split-form {
        zoom: 1;
    }

    .registration .user-register-form .split-form:before, .registration .user-register-form .split-form:after {
        display: table;
        content: "";
        zoom: 1;
    }

    .registration .user-register-form .split-form dl {
        float: left;
        width: 172px;
    }

    .registration .user-register-form dl {
        margin-bottom: 3px;
    }

    .registration .user-register-form dl dt {
        position: relative;
        color: #505050;
        font-size: 12px;
        font-weight: 700;
        margin: 5px 0;
        clear: left;
    }

    .registration .user-register-form dl dd {
        position: relative;
    }

    .mbdef, .mvdef {
        margin-bottom: 15px;
    }

    .registration .user-register-form .split-form:after {
        clear: both;
    }

    .registration .user-register-form .split-form:before, .registration .user-register-form .split-form:after {
        display: table;
        content: "";
        zoom: 1;
    }

    .registration .user-register-form dl dt label {
        font: bold 16px 'Quicksand';
    }

    .registration .user-register-form.form-style-wrapper input[type='text'], .registration .user-register-form.form-style-wrapper input[type='password'], .registration .user-register-form.form-style-wrapper input[type='email'], .registration .user-register-form.form-style-wrapper input[type='tel'], .registration .user-register-form.form-style-wrapper textarea {
        -webkit-appearance: none;
    }

    .registration .user-register-form .split-form .input-text {
        width: 152px;
        padding-left: 8px;
        padding-right: 8px;
    }

    .registration .user-register-form .input-text {
        width: 324px;
        height: 36px;
        border-color: #ebe8e8;
        border-radius: 3px;
        border-style: solid;
        font: 16px "Quicksand";
        color: #505050;
        padding: 1px 8px;
    }

    .form-style-wrapper textarea, .form-style-wrapper input[type="text"], .form-style-wrapper input[type="password"], .form-style-wrapper input[type="email"], .form-style-wrapper input[type="tel"] {
        border: 1px solid #c0c0c0;
        border-radius: 2px;
        padding: 6px 8px 7px;
    }

    .registration .corporate-input, .registration .limited-company {
        display: none;
    }

    .registration .user-register-form .sign-up-container {
        padding-top: 20px;
    }

    .registration .user-register-form .sign-up-container #signUpButton {
        width: 135px;
        height: 44px;
    }

    .btn {
        display: inline-block;
        padding: 9px 22px;
        margin-bottom: 0;
        font-family: 'Lucida Grande', LucidaGrande, Arial, sans-serif;
        font-size: 14px;
        font-weight: bold;
        text-align: center;
        vertical-align: middle;
        cursor: pointer;
        border: 1px solid #437db9;
        border-radius: 2px;
        color: #fff !important;
        background-color: #437db9;
        background-repeat: repeat-x;
        background-image: -moz-linear-gradient(top, #6198d3, #437db9);
        background-image: -ms-linear-gradient(top, #6198d3, #437db9);
        background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #6198d3), color-stop(100%, #437db9));
        background-image: -webkit-linear-gradient(top, #6198d3, #437db9);
        background-image: -o-linear-gradient(top, #6198d3, #437db9);
        background-image: linear-gradient(top, #6198d3, #437db9);
        text-shadow: 1px 1px 0 #29619b;
        box-shadow: inset 0 0 0 1px rgb(255 255 255 / 10%), 0 2px 2px -1px rgb(0 0 0 / 15%);
        line-height: 1.3em;
        outline: 0;
    }

    .btn-get {
        background: #489ae9;
        box-shadow: 1px 0 2px 0 rgb(0 0 0 / 13%), 0 0 4px 0 rgb(0 0 0 / 11%), 0 2px 3px 0 rgb(0 0 0 / 16%);
        border-radius: 2px;
        border: 0;
        text-shadow: none;
        font-weight: bold;
        height: 50px;
        font-size: 16px;
        width: 100%;
        display: block;
    }

    .btn-get:hover {
        background: #4594de;
    }

    #signUpButton:focus {
        border: 1px solid #6097d1;
        -webkit-box-shadow: 0 0 1px 1px #6097d1;
        box-shadow: 0 0 1px 1px #6097d1;
        outline: unset;
        color: #fff;
    }

    .form-style-wrapper input[type="checkbox"] + label:before {
        content: '';
        display: inline-block;
        position: absolute;
        width: 14px;
        height: 14px;
        top: 0;
        left: 0;
        border: 1px solid #ccc;
        background-color: #fff;
    }

    .form-style-wrapper input[type="checkbox"] + label:before {
        border-radius: 2px;
        border-color: #ccc;
    }

    .form-style-wrapper input[type="checkbox"]:checked + label:after {
        content: '';
        background: url('/bahriamall/assets/site/img/form2x.png') 1px -115px no-repeat;
        -webkit-background-size: 15px 150px;
        -moz-background-size: 15px 150px;
        background-size: 15px 150px;
        width: 15px;
        height: 12px;
        display: inline-block;
        position: absolute;
        top: 3px;
        left: 1px;
    }

    .form-style-wrapper input[type="checkbox"] + label:before {
        content: '';
        display: inline-block;
        position: absolute;
        width: 14px;
        height: 14px;
        top: 5px;
        left: 0;
        border: 1px solid #ccc;
        background-color: #fff;
    }

    .form-style-wrapper input[type="checkbox"] + label:before {
        border-radius: 2px;
        border-color: #ccc;
    }

    .form-style-wrapper input[type="checkbox"]:checked + label:after {
        content: '';
        background: url('<?=Yii::getAlias('@web/assets/site/img/form2x.png')?>') 1px -115px no-repeat;
        -webkit-background-size: 15px 150px;
        -moz-background-size: 15px 150px;
        background-size: 15px 150px;
        width: 15px;
        height: 12px;
        display: inline-block;
        position: absolute;
        top: 7px;
        left: 0px;
    }

    .form-style-wrapper input[type="checkbox"]:checked + label:before {
        background-color: #eda862;
    }

    .registration .user-register-form .password-input-wrapper .show-hide-trigger {
        position: absolute;
        width: 21px;
        height: 18px;
        display: block;
        left: 290px;
        top: 11px;
        background: url('<?=Yii::getAlias('@web/assets/site/img/password_hide.png')?>') no-repeat;
        -webkit-background-size: 21px 18px;
        -moz-background-size: 21px 18px;
        background-size: 21px 18px;
    }

    .registration a {
        color: #438ed8;
    }



    .registration .info-box .registration-detail {
        border: 1px solid #dedede;
        padding: 40px;
        margin-bottom: 20px;
    }

    .registration .info-box .registration-detail h2 {
        font-size: 23px;
        line-height: 25px;
        padding: 0 0 25px 75px;
        position: relative;
        font-weight: bold;
    }

    .registration .info-box .registration-detail p {
        font-size: 16px;
        line-height: 20px;
        padding-bottom: 20px;
    }

    .registration .info-box .registration-detail.corporate, .registration .info-box .registration-detail.ntvd {
        display: none;
    }

    .registration .info-box .registration-detail h2:before {
        position: absolute;
        top: 0;
        left: 0;
        content: '';
        width: 58px;
        height: 52px;
        display: block;
        background: url('<?=Yii::getAlias('@web/assets/site/img/sprite.png')?>') no-repeat top left;
    }

    .registration .info-box .registration-detail li:before {
        position: relative;
        top: 14px;
        left: -17px;
        content: '';
        width: 6px;
        height: 6px;
        display: block;
        background: #999;
        border-radius: 100px;
    }

    .kvkk {
        background: #f7f7f7 url('<?=Yii::getAlias('@web/assets/site/img/kvkk_info.png')?>') 20px 20px no-repeat;
        -webkit-background-size: 18px 18px;
        -moz-background-size: 18px 18px;
        background-size: 18px 18px;
        border: 1px solid #ccc;
        padding: 21px 20px 20px 50px;
        border-bottom: none;
    }

    .kvkk p {
        font-size: 10px !important;
        color: #999 !important;
    }

    .registration .user-register-form .password-input-wrapper .show-hide-trigger.show {
        background: url('<?=Yii::getAlias('@web/assets/site/img/password_show.png')?>') no-repeat;
        -webkit-background-size: 21px 16px;
        -moz-background-size: 21px 16px;
        background-size: 21px 16px;
        top: 12px;
    }

    .select2 {
        width: 324px !important;
    }

    .taxField .select2 {
        width: 167px !important;
    }

    .registration.corporate .registration-detail.corporate h2:before {
        background: url('<?=Yii::getAlias('@web/assets/site/img/sprite.png')?>') no-repeat -58px 0;
    }

    .form-group.has-error:after {
        content: "" !important;
    }
    @media only screen and (max-width: 580px){
        #signup-form input ,  #signup-form .select2 , #address
        {
            width: 295px!important;
        }
        .registration .user-register-form .password-input-wrapper .show-hide-trigger
        {
            left: 265px;
        }
        .info-box
        {
            margin-top: 10%;
        }
        .registration .info-box .registration-detail
        {
            padding: 20px;
        }
        .registration
        {
            padding: 0;
            margin-top: 18%;
            margin-right: 0;
        }
        .registration .user-register-form .sign-up-container
        {
            display: flex;
            justify-content: center;
        }
    }
</style>
<div class = "sign-up">
   <div class = "container custom-container">
      <div class = "registration-container ">
         <div class = "row registration">
            <div class = "col-md-6 col-sm-12">
               <div class = "user-register-form form-style-wrapper">
                   <?php $form = ActiveForm::begin([
                                                           'id'     => 'signup-form',
                                                           'method' => 'post',
                                                   ]); ?>

                  <ul id = "errorList" class = "req" test = ""></ul>
                  <div class = "registration-type">
                     <input type = "radio" id = "individual" name = "registrationType" value = "individual" checked = "true">
                     <label for = "individual">
                        Individual
                     </label>

                     <input type = "radio" id = "corporate" name = "registrationType" value = "corporate">
                     <label for = "corporate">
                        Corporate
                        <a href = "javascript:;" class = "tipitip-trigger tipitip-icon" title = "Our users who trade in real estate, vehicles and products must be Corporate Memberships.">
                        </a>
                     </label>

                  </div>
                  <div class = "split-form">
                     <dl>
                        <dt>
                           <label for = "name">
                              Your name
                           </label>
                        </dt>
                        <dd class = "mbdef">
                            <?= $form->field($model, 'first_name', [
                                    'template' => '{input} {error}',
                            ])->textInput(['class' => 'input-text required'])->label(false); ?>
                        </dd>
                     </dl>
                     <dl>
                        <dt>
                           <label for = "surname">
                              Your surname
                           </label>
                        </dt>
                        <dd class = "mbdef">
                            <?= $form->field($model, 'last_name', [
                                    'template' => '{input} {error}',
                            ])->textInput(['class' => 'input-text'])->label(false); ?>
                        </dd>
                     </dl>
                  </div>

                  <dl>
                     <dt>
                        <label for = "email">
                           E-Mail Address<a href = "#" class = "tipitip-trigger tipitip-icon" title = ""></a>
                        </label>
                     </dt>
                     <dd class = "mbdef">
                         <?= $form->field($model, 'email', [
                                 'template' => '{input} {error}',
                         ])->textInput(['class' => 'input-text'])->label(false); ?>
                     </dd>
                  </dl>

                  <dl>
                     <dt>
                        <label for = "password">
                           Password
                        </label>
                     </dt>
                     <dd class = "mbdef">
                        <div class = "password-input-wrapper">
                            <?= $form->field($model, 'password', [
                                    'template' => '{input} {error}',
                            ])->passwordInput(['class' => 'input-text form-control with-addon'])->label(false); ?>
                           <a href = "javascript:" class = "show-hide-trigger" data-id = "0" data-ajax = "customer-password"></a>
                           <div id = "passwordHints" class = "disable">
                              <!--
                                                                  <ul class="password-hints">
                                                                      <li class="8chars">En az 8 karakter</li>
                                                                      <li class="1alph">En az 1 harf</li>
                                                                      <li class="1num">En az 1 rakam</li>
                                                                  </ul>
                              -->

                           </div>
                        </div>

                     </dd>
                  </dl>

                  <dl class = "corporate-input sector">
                     <dt>
                        <label for = "category">Your Field of Activity</label>
                     </dt>
                     <dd class = "mbdef">
                        <select id = "category" class = "custom-select input-text" name = "corporateForm.parentProductId">
                           <option value = "">Choose</option>
                           <option for = "Shopping" value = "Shopping" data-title = "Shopping">Shopping</option>
                           <option for = "Estate" value = "Estate" data-title = "Estate">Estate</option>
                           <option for = "Daily Rent" value = "Daily Rent" data-title = "Daily Rent">Daily Rent</option>
                           <option for = "Animal Kingdom" value = "Animal Kingdom" data-title = "Animal Kingdom">Animal Kingdom</option>
                           <option for = "Heavy Equipment &amp; Industry" value = "Heavy Equipment &amp; Industry" data-title = "Heavy Equipment &amp; Industry">
                              Heavy Equipment &amp; Industry
                           </option>
                           <option for = "Rent a Car" value = "Rent a Car" data-title = "Rent a Car">
                              Rent a Car
                           </option>
                           <option for = "Marine Vehicle For Rent" value = "Marine Vehicle For Rent" data-title = "Marine Vehicle For Rent">
                              Marine Vehicle For Rent
                           </option>
                           <option for = "Motorcycle" value = "Motorcycle" data-title = "Motorcycle">
                              Motorcycle
                           </option>
                           <option for = "Vehicle" value = "Vehicle" data-title = "Vehicle">
                              Vehicle
                           </option>
                           <option for = "Spare Parts, Accessories, Hardware &amp; Tuning" value = "Spare Parts, Accessories, Hardware &amp; Tuning" data-title = "Spare Parts, Accessories, Hardware &amp; Tuning Parça, Aksesuar, Donanım &amp; Tuning">
                              Spare Parts, Accessories, Hardware &amp; Tuning
                           </option>
                        </select>
                     </dd>
                  </dl>
                  <dl class = "corporate-input">
                     <dt><label for = "pritaveCompany">Business Type</label></dt>
                     <div class = "registration-type corporate-type corporate-input">
                        <input type = "radio" id = "pritaveCompany" name = "companyType" value = "PERSONAL_INVOICE" checked = "">

                        <label for = "pritaveCompany">Individual Company</label>

                        <input type = "radio" id = "limitedCompany" name = "companyType" value = "CORPORATE_INVOICE">

                        <label for = "limitedCompany">Limited or Joint Stock Company</label>
                     </div>
                  </dl>

                  <dl class = "corporate-input">
                     <dt><label for = "limitedCompanyName">Commercial title</label></dt>
                     <dd class = "mbdef">
                        <input type = "text" name = "corporateForm.companyName" id = "limitedCompanyName" class = "input-text tipitip-trigger" data-open-event = "focus" data-close-event = "blur" title = "" value = "" readonly = "">
                     </dd>
                  </dl>

                  <dl class = "corporate-input">
                     <dt>
                        <label for = "city">Province</label>
                     </dt>

                     <dd class = "mbdef">
                        <select id = "city" name = "corporateForm.province"></select>
                     </dd>
                  </dl>

                  <dl class = "corporate-input">
                     <dt>
                        <label for = "town">District</label>
                     </dt>

                     <dd class = "mbdef">
                        <select id = "city" name = "corporateForm.district"></select>
                     </dd>
                  </dl>

                  <dl class = "corporate-input quarter-area">
                     <dt>
                        <label for = "town">Neighborhood</label>
                     </dt>
                     <dd class = "mbdef">
                        <select id = "city" name = "corporateForm.neighbohood"></select>

                     </dd>
                  </dl>

                  <dl class = "corporate-input">
                     <dt>
                        <label for = "address">Address Details</label>
                     </dt>

                     <dd class = "mbdef">
                        <textarea id = "address" name = "corporateForm.address" class = "tipitip-trigger" data-open-event = "focus" data-close-event = "blur" minlength = "10" maxlength = "250" title = "" style = "width: 324px;height: 120px;"></textarea>
                     </dd>
                  </dl>

                  <div class = "split-form corporate-input">
                     <dl>
                        <dt><label for = "taxOffice">Tax Administration</label></dt>

                        <dd class = "mbdef taxField">
                           <select id = "taxOffice" name = "corporateForm.taxOfficeId" data-selected = "" class = "">

                           </select>

                        </dd>
                     </dl>

                     <dl class = "private-company">
                        <dt>
                           <label for = "idNumber">TC ID number</label>
                        </dt>

                        <dd class = "mbdef ">
                           <input id = "idNumber" name = "corporateForm.idNumber" title = "11 haneli TC kimlik numaranızı giriniz." data-close-event = "blur" data-open-event = "focus" type = "text" class = "input-text numericInput tipitip-trigger" value = "" maxlength = "11">
                        </dd>
                     </dl>
                     <dl class = "limited-company">
                        <dt><label for = "taxNumber"><font style = "vertical-align: inherit;"><font style = "vertical-align: inherit;">Tax number</font></font></label></dt>

                        <dd class = "mbdef ">
                           <input id = "taxNumber" name = "corporateForm.taxNumber" title = "Enter your 10-digit tax number belonging to your trade name." data-close-event = "blur" data-open-event = "focus" type = "text" class = "input-text numericInput tipitip-trigger" value = "" maxlength = "10"></dd>
                     </dl>
                  </div>

                  <div class = "corporate-input phones">
                     <dl>
                        <dt><label for = "phone">Fixed Telephone (Optional)</label></dt>

                        <dd class = "mbdef with-icon">
                           <input id = "phone" name = "corporateForm.firstPhone" title = "" data-close-event = "blur" data-open-event = "focus" placeholder = "(___) _______" type = "text" class = "input-text phone numericInput tipitip-trigger" value = "" maxlength = "13" autocomplete = "off"></dd>
                     </dl>
                  </div>
                  <dl class = "eula-area">
                     <dd>
                        <input required type = "checkbox" id = "endUserLicenceAgreement" name = "endUserLicenceAgreement" class="form-control" tabindex = "6">

                        <label for = "endUserLicenceAgreement">
							  <span>
								<label id = "corporateAgreement" style = "display: none;"></label>
								<label id = "personalAgreement">
									<a href = "#" rel = "nofollow" target = "_blank">
										<font style = "vertical-align: inherit;"></font>
									</a>
								</label>
								<font style = "vertical-align: inherit;">
									<font style = "vertical-align: inherit;">
										I accept the 
									</font>
									<label id = "personalAgreement">
										<a href = "#" rel = "nofollow" target = "_blank">
											Individual Membership Agreement.
										</a>
									</label>
									<font style = "vertical-align: inherit;"> .</font>
								</font>
							  </span>
                        </label>
                     </dd>

                     <dd id = "agreement">
                        <input type = "checkbox" id = "communicationAgreement" name = "communicationAgreement" tabindex = "7">

                        <label for = "communicationAgreement">
								<span>
									<font style = "vertical-align: inherit;">
										<font style = "vertical-align: inherit;">
										 
											I allow the sending of commercial electronic messages <br/>with campaign, promotion and advertisement content to my <br/>contact information, to the processing of my personal data <br/> for this purpose and to share it with your suppliers.
										   	  
										</font>
									</font>
								</span>
                        </label>
                     </dd>
                  </dl>

                  <div class = "sign-up-container">
                     <button type = "submit" class = "btn btn-get" id = "signUpButton" tabindex = "8">
                        Sign up
                     </button>
                  </div>
                   <?php ActiveForm::end(); ?>
               </div>
            </div>
            <div class = "col-md-6 col-sm-12">
               <div class = "info-box ">
                  <div class = "registration-detail individual">
                     <h2>
                        <font style = "vertical-align: inherit;">
                           <font style = "vertical-align: inherit;">
                              What are the Advantages of Individual Membership?
                           </font>
                        </font>
                     </h2>
                     <p>
                        <font style = "vertical-align: inherit;">
                           <font style = "vertical-align: inherit;">
                              Sell &#8203;&#8203;and rent your house and car, sell your
                           </font>
                        </font>
                        <br>
                        <font style = "vertical-align: inherit;">
                           <font style = "vertical-align: inherit;">
                              unused items and buy
                           </font>
                        </font>
                        <br>
                        <font style = "vertical-align: inherit;">
                           <font style = "vertical-align: inherit;">
                              new ones.
                           </font>
                        </font>
                     </p>
                     <ul>
                        <li>
                           <font style = "vertical-align: inherit;">
                              <font style = "vertical-align: inherit;">
                                 Advertise for free,
                              </font>
                           </font>
                        </li>
                        <li>
                           <font style = "vertical-align: inherit;">
                              <font style = "vertical-align: inherit;">
                                 Add the ads you are interested in to your
                              </font>
                           </font>
                           <font style = "vertical-align: inherit;">
                              <font style = "vertical-align: inherit;">
                                 favorites, follow the price
                              </font>
                           </font>
                           <br>
                           <font style = "vertical-align: inherit;">
                              <font style = "vertical-align: inherit;">
                                 changes
                              </font>
                              <font style = "vertical-align: inherit;">
                                 after adding
                              </font>
                              <font style = "vertical-align: inherit;">
                                 them
                              </font>
                           </font>
                           <br>
                           <font style = "vertical-align: inherit;">
                              <font style = "vertical-align: inherit;">
                                 to favorites, create favorite searches according to
                              </font>
                              <font style = "vertical-align: inherit;">
                                 your criteria
                              </font>
                              <font style = "vertical-align: inherit;">
                                 ,
                              </font>
                           </font>
                        </li>
                        <li>
                           <font style = "vertical-align: inherit;">
                              <font style = "vertical-align: inherit;">
                                 Message the advertisers on the site.
                              </font>
                           </font>
                        </li>
                     </ul>
                  </div>
                  <div class = "registration-detail corporate">
                     <h2>
                        <font style = "vertical-align: inherit;">
                           <font style = "vertical-align: inherit;">
                              What are the Advantages of Corporate Membership?
                           </font>
                        </font>
                     </h2>
                     <p>
                        <font style = "vertical-align: inherit;">
                           <font style = "vertical-align: inherit;">
                              In order to increase your trade and business volume, you too, step into the corporate membership world of sahibinden.com.
                           </font>
                        </font>
                     </p>
                     <ul>
                        <li>
                           <font style = "vertical-align: inherit;">
                              <font style = "vertical-align: inherit;">
                                 Turkey's solid strength in your power to reach millions of buyers around the,
                              </font>
                           </font>
                        </li>
                        <li>
                           <font style = "vertical-align: inherit;">
                              <font style = "vertical-align: inherit;">
                                 Publish your postings without waiting for approval,
                              </font>
                           </font>
                        </li>
                        <li>
                           <font style = "vertical-align: inherit;">
                              <font style = "vertical-align: inherit;">
                                 Take advantage of the special call center service for you.
                              </font>
                           </font>
                        </li>
                     </ul>
                  </div>

                  <div class = "kvkk ">
                     <p>
                        <font style = "vertical-align: inherit;">
                           <font style = "vertical-align: inherit;">
                              The information on this page is taken for sahibinden.com membership.
                           </font><font style = "vertical-align: inherit;">You
                           </font>
                        </font>
                        <a href = "#" target = "_blank">
                           <font style = "vertical-align: inherit;">
                              <font style = "vertical-align: inherit;">
                                 can
                              </font>
                           </font>
                        </a>
                        <font style = "vertical-align: inherit;">
                           <font style = "vertical-align: inherit;">
                              find
                           </font>
                           <font style = "vertical-align: inherit;">
                              detailed information about the protection of personal data
                           </font>
                           <a href = "#" target = "_blank">
                              <font style = "vertical-align: inherit;">
                                 here
                              </font>
                           </a>
                           <font style = "vertical-align: inherit;">
                              .
                           </font>
                        </font>
                     </p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>





