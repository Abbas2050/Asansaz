<?php
use yii\bootstrap\ActiveForm;
use app\assets\AccountAsset;
use yii\authclient\widgets\AuthChoice;

AccountAsset::register($this);
?>
<style>
.foreignForceInfo {
    font-family: 'Quicksand';
    border-radius: 4px;
    border: solid 1px #eddfb7;
    background-color: #fff7e0;
    padding: 12px;
    margin-bottom: 15px;
}
.infoText {
    display: flex;
    justify-content: flex-start;
    align-items: center;
}
#infoIcon {
    margin-right: 12px;
}
	
#infoBoldText{
    color: #bd6b26;
    font-size: 16px;
    margin: 4px;
}	

.foreignForceInfo p{
    width: 954px;
    height: 18px;
    font-size: 14px;
    font-weight: normal;
    font-stretch: normal;
    font-style: normal;
    line-height: 1.29;
    letter-spacing: normal;
    color: #666;
    margin: 4px;
}
	
.informUs {
    display: flex;
    justify-content: space-around;
    align-items: center;
}
	
#foreignLoginInformLink {
    color: #4c69a7;
    cursor: pointer;
    font-weight: bold;
}	
	
	
@media only screen and (min-width: 1280px){
.custom-container {
	width: 990px !important;
	}
}	
	

.user-login {
    background-color: #f8f8f8;
    border: 1px solid #dfdfdf;
    border-radius: 3px;
    color: #36454d;
    padding: 42px 75px;
    float: left;
    margin: 10px 0 30px;
}
.user-login.guest-buy {
    background-color: #fff;
    padding: 70px 78px 36px 77px;
    margin: 0;
    margin-bottom: 20px;
    
}
.user-login {
    position: relative;
}	
.user-login.guest-buy .qr-login-trigger {
    background-color: #fff;
}
.user-login .qr-login-trigger {
    display: block;
    background: #f8f8f8 url(<?=Yii::getAlias('@web/assets/site/img/qr-login.png')?>) center no-repeat;
    -webkit-background-size: 60px 60px;
    -moz-background-size: 60px 60px;
    background-size: 60px 60px;
    width: 60px;
    height: 60px;
    padding: 10px;
    right: 5px;
    top: 5px;
    position: absolute;
    z-index: 10;
}	
.user-login.guest-buy h3 {
    text-align: center;
    color: #333;
    font-weight: bold;
    font-size: 18px;
}
.user-login dl {
    margin-bottom: 5px;
}
.user-login.guest-buy dt {
    margin-bottom: 5px;
}
.user-login dl dt {
    margin: 17px 0 8px 0;
}
.user-login.guest-buy dl label {
    font-size: 15px;
}
dt, dd, fieldset {
    margin: 0;
    padding: 0;
    background: no-repeat 0 0;
}
.user-login.guest-buy dl input {
    padding: 0 8px;
    height: 40px;
    margin-bottom: 10px;
    width: 307px;
}
.user-login dl input {
    font-size: 16px;
    padding: 8px;
    width: 310px;
    display: block;
    border: 1px solid #d6d4d4;
}
.user-login.guest-buy dl .forgot-guest-buy {
    display: inline-block;
    float: right;
    color: #868f94;
	font-size:12px;
	font-weight: normal;
}	
.user-login dl .password-input-wrapper {
    position: relative;
}
.user-login.guest-buy .remember-me {
    margin-top: 0;
    color: #36454d;
    font-size: 13px;
}
.desktop.win .remember-me input[type='checkbox']#rememberMe {
    vertical-align: -2px;
}
.remember-me input[type='checkbox']#rememberMe {
    margin: 0;
    vertical-align: 1px;
}
input[type=checkbox], input[type=radio] {
    cursor: pointer;
}	
.remember-me label {
    padding: 12px 0 0 5px;
    display: inline-block;
}
.user-login.guest-buy .remember-me {
    margin-top: 0;
    color: #36454d;
    font-size: 13px;
}	
.guest-new-screen {
    border: 1px solid #dfdfdf;
    border-radius: 3px;
    color: #3d3d3d;
    margin: 0 0 20px 20px;
    float: left;
    height: 494px;
    background-color: #fff;
    position: relative;
    overflow: hidden;
}
.guest-new-screen .not-member {
    padding-top: 143px;
    padding-left: 80px;
    padding-right: 85px;
    background-color: #fff;
}
.guest-new-screen .go-unregistered {
    border-bottom: 0;
    text-align: center;
    padding: 145px 75px 76px 80px;
    margin: 0;
}
.guest-new-screen .go-unregistered h3 {
    font-size: 18px;
    margin: 0 0 43px 0;
    padding-left: 0;
    padding-right: 0;
    width: 100%;
    color: #333;
    font-weight: bold;
}	
.guest-new-screen .go-unregistered p.info {
    color: #36454d;

    width: 315px;
}
.guest-new-screen .go-unregistered p {
    margin-bottom: 20px;
    font-size: 13px;
}
.guest-new-screen .go-unregistered .with-register {
    width: inherit;
    padding: 15px 22px;
    height: inherit;
}

.clearfix:after {
    visibility: hidden;
    display: block;
    font-size: 0;
    content: " ";
    clear: both;
    height: 0;
}	
a:hover {
    text-decoration: underline;
}
.user-login dl .password-input-wrapper .show-hide-trigger {
    position: absolute;
    width: 21px;
    height: 18px;
    display: block;
    right: 11px;
    top: 11px;
    background: url(<?=Yii::getAlias('@web/assets/site/img/password_hide.png')?>) no-repeat;
    -webkit-background-size: 21px 18px;
    -moz-background-size: 21px 18px;
    background-size: 21px 18px;
}
.user-login dl .password-input-wrapper .show-hide-trigger.show {
    background: url(<?=Yii::getAlias('@web/assets/site/img/password_show.png')?>) no-repeat;
    -webkit-background-size: 21px 16px;
    -moz-background-size: 21px 16px;
    background-size: 21px 16px;
    top: 12px;
}	
.btn {
    display: inline-block;
    padding: 9px 22px;
    margin-bottom: 0;
    font-family: 'Lucida Grande',LucidaGrande,Arial,sans-serif;
    font-size: 14px;
    font-weight: bold;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    border: 1px solid #437db9;
    border-radius: 2px;
    color: #fff;
    background-color: #437db9;
    background-repeat: repeat-x;
    background-image: -moz-linear-gradient(top,#6198d3,#437db9);
    background-image: -ms-linear-gradient(top,#6198d3,#437db9);
    background-image: -webkit-gradient(linear,left top,left bottom,color-stop(0%,#6198d3),color-stop(100%,#437db9));
    background-image: -webkit-linear-gradient(top,#6198d3,#437db9);
    background-image: -o-linear-gradient(top,#6198d3,#437db9);
    background-image: linear-gradient(top,#6198d3,#437db9);
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
.btn-get:active {
    background: #418dd4;
    border: 1px solid #3d87cc;
    box-shadow: 0 2px 1px 0 #377bbb inset;
}
.btn:hover {
    background: #437db9;
    text-decoration: none;
	color:#fff;
}
.guest-new-screen .register-button {
    color: #489ae8;
}

	
.btn-get-alternative {
    background: #fafafa;
    box-shadow: 1px 0 2px 0 rgb(0 0 0 / 13%), 0 0 4px 0 rgb(0 0 0 / 11%), 0 2px 3px 0 rgb(0 0 0 / 16%);
    border-radius: 2px;
    border: 0;
    font-weight: bold;
    height: 50px;
    font-size: 16px;
    text-shadow: 0 2px 11px #fff;
    color: #868f94;
    width: 100%;
    display: block;
}
.btn-get-alternative:hover {
    background: #f7f7f7;
}	
input[type=checkbox] {
    position: relative;
    top: 0.3rem;
	left:unset;
}
.user-login #userLoginSubmitButton:focus {
    border: 1px solid #6097d1;
    -webkit-box-shadow: 0 0 1px 1px #6097d1;
    box-shadow: 0 0 1px 1px #6097d1;
	outline:unset;
	color:#fff;
}
@media only screen and (max-width: 580px){
    .user-login.guest-buy
    {
        padding: 20px;
        margin: 15% 0
    }
    .form-group.has-error:after {
        top: 51px;
        right: 0;
    }
    .guest-new-screen .go-unregistered{
         padding: 0;
    }
    .guest-new-screen
    {
        width: 100%;
        height: 100%;
        padding: 25px;
        margin-left: 0;
    }
}
</style>
<div class="sign-in">
    <div class="container custom-container">
	<!--	<div class="foreignForceInfo">
				<div class="infoText">
					<img id="infoIcon" src="<?=Yii::getAlias('@web/assets/site/img/denial_warning_7ea7cf82452e0ab0018593dd653880a2.png')?>" alt="warning" width="24" height="24">
					<h5 id="infoBoldText">You are trying to access from outside of Turkey.</h5>
				</div>
				<p>Please sign in to access sahibinden.com. Sign up for free if you do not have an account.</p>
				<div class="informUs">
					<p>If you think you should not see this,<span id="foreignLoginInformLink"> please inform us</span>. </p>
				</div>
		</div>-->
       <div class="row">
          <div class="col-6">
             <div class="user-login guest-buy  with-captcha">
                <a class="qr-login-trigger" href="javascript:;"></a>
                <h3><?= t('app','Login');?></h3>
                 <?php $form = ActiveForm::begin([
                                                         'id'        => 'signin-form',
                                                         'method'    => 'post',
                                                 ]); ?>
                <dl>
                   <dt>
                      <label for="username">E-mail</label>
                   </dt>
                   <dd>
                       <?= $form->field($model, 'email', [
                               'template'      => '{input} {error}',
                       ])->textInput([ 'placeholder' => t('app', 'Email'), 'class' => 'form-control with-addon'])->label(false); ?>
                   </dd>
                   <dt>
                      <label for="password">Password</label>
                      <a href="<?= url(['account/forgot']);?>" class="forgot-guest-buy" rel="nofollow">Forgot Password</a>
                   </dt>
                   <dd>
                      <div class="password-input-wrapper">
                          <?= $form->field($model, 'password', [
                                  'template' => '{input} {error}',
                          ])->passwordInput(['placeholder' => t('app','Password'), 'class' => 'form-control with-addon'])->label(false); ?>
                         <a href="javascript:;" class="show-hide-trigger" data-id="0" data-ajax="customerloginform-password"></a>
                      </div>

                   </dd>
                </dl>
                <button type="submit" class="btn btn-get btn-login-guest-buy" id="userLoginSubmitButton" name="userLoginSubmitButton" tabindex="3"><?=t('app','Sign In');?></button>
                <p class="remember-me clearfix">
                    <?= $form->field($model, 'rememberMe', [
                            'options' => [
                                    'id'    =>'rememberMe'
                            ],
                    ])->checkbox(['template' => '{input} {label}'],['value'=>true])->label("Keep me logged in"); ?>

                </p>



                 <?php ActiveForm::end(); ?>
             </div>
          </div>
       <div class="col-6">
          <div class="guest-new-screen ">
             <div class="go-unregistered clearfix not-member">
                <h3>Don't have an account?</h3>
                <p class="info">Sign up to benefit from our services.</p>
                <a class="with-register btn btn-get-alternative trackClick trackId_hemen_uye_ol register-button" data-click-event="get_odeme" href="<?=url(['account/join'])?>" data-funnel-trigger-register="login">Sign Up For Free</a>
             </div>
          </div>
       </div>

       </div>
        </div>
    </div>
<script >



</script>
