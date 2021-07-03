<?php 
use app\models\ListingSearch;
$searchModel = new ListingSearch();
 ?>
<style>
    @media only screen and (min-width: 768px){
        #header {
            min-height: 60px !important;
        }
    }
    
    .content {
        padding-top:20px;
    }
    
    #listingsearch-searchphrase , .field-listingsearch-searchphrase button {
        background: #2f3546;
    border: none;
    }
    
    .homepage .homepage-content li img {
        width:100% !important;
    }
    
    .homepage .homepage-content li {
            width: 120px !important;
    }
    
    .homepage .homepage-content li a {
        font-weight:700;
    }
</style>
<header id="header">
	<div class="header-wrapper sticky">
        <?php if (session()->get('impersonating_customer')) {?>
        <section id="impersonating">
            You are now impersonating the customer <?= app()->customer->identity->getFullName();?><br />
            Click <a href="<?=url(['/account/impersonate']);?>" >here</a> to return to admin
        </section>
        <?php } ?>
        <section id="notify-container">
            <?= notify()->show();?>
        </section>
        <section class="main-menu" style="background-color:#3F475F;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="logo">
                            <a href="<?=url(['/']);?>">
                                <img src="<?=\Yii::getAlias('@web') . options()->get('app.settings.theme.siteLogo', \Yii::getAlias('/assets/site/img/logo.png'));?>" style="position: relative;top: 1rem;"/>
                            </a>
                            <a href="#nav-mobile" class="btn-as transparent mobile-menu pull-left hidden-lg hidden-md hidden-sm" data-toggle="collapse" aria-expanded="false" aria-controls="nav-mobile"><i class="fa fa-bars" aria-hidden="true"></i></a>
                            <a href="<?=url(['/listing/post']);?>" class="btn-add pull-right"><i class="fa fa-plus" aria-hidden="true"></i></a>



                        </div>
                        <div id="nav-mobile" class="collapse mobile-menu-wrapper">
                            <ul>
                                <?php if (app()->customer->isGuest == false) { ?>
                                <li><a href="<?=url(['account/info']);?>"><i class="fa fa-cog" aria-hidden="true"></i><?=t('app','Account Info');?></a></li>
                                <?php if (app()->customer->identity->group_id == 2) { ?>
                                    <li><a href="<?=url(['/store/index', 'slug' => app()->customer->identity->stores->slug]);?>"><i class="fa fa-eye" aria-hidden="true"></i><?=t('app','My Store');?></a></li>
                                <?php } else { ?>
                                    <?php if (options()->get('app.settings.common.disableStore', 0) == 0) { ?>
                                    <li><a href="<?=url(['account/info#company-block']);?>"><i class="fa fa-plus" aria-hidden="true"></i><?=t('app','Upgrade');?></a></li>
                                    <?php } ?>
                                <?php } ?>
                                <li><a href="<?=url(['account/my-listings']);?>"><i class="fa fa-tasks" aria-hidden="true"></i><?=t('app','My Ads');?></a></li>
                                <li><a href="<?=url(['account/conversations']);?>"><i class="fa fa-comments-o" aria-hidden="true"></i><?=t('app','Inbox');?></a></li>
                                <li><a href="<?=url(['account/favorites']);?>"><i class="fa fa-heart-o" aria-hidden="true"></i><?=t('app','Favorites');?></a></li>
                                <?php if (options()->get('app.settings.invoice.disableInvoices', 0) == 0){ ?>
                                    <li><a href="<?=url(['account/invoices']);?>"><i class="fa fa-file-o" aria-hidden="true"></i><?=t('app','Invoices');?></a></li>
                                <?php } ?>
                                <li><a href="<?=url(['account/logout']);?>"><i class="fa fa-power-off" aria-hidden="true"></i><?=t('app','Logout');?></a></li>
                                <?php } else { ?>
                                <li><a href="<?=url(['account/join']);?>"><i class="fa fa-heart-o" aria-hidden="true"></i><?=t('app','Join');?></a></li>
                                <li><a href="<?=url(['account/login']);?>"><i class="fa fa-user" aria-hidden="true"></i><?=t('app','Login');?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <div class="main-navigation" style="text-align: center">
						  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="padding: 0px">
							<div class="btn-group" style="width:100%">
                            <?= $this->render('../site/_homepage-search', [
									'searchModel' => $searchModel,
							]); ?>
                            </div>
						   </div>
                            <!-- -->
						 <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12" style="margin-top: -3px;">
                            <div class="btn-group hidden-xs">
                               <?php if (app()->customer->isGuest == true)
							   { ?>
									<a href="<?=url(['account/login']);?>" class="btn-as transparent" aria-haspopup="true" aria-expanded="false">
										<i class="fa fa-user-o" aria-hidden="true"></i> <?=t('app','My Account');?>
									</a>
								<?php
							    }
								else
								{
								?>
								<div class="row">
								 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0px;position: relative;top: 1rem;">
									 <div class="col-lg-6 col-md-3 col-sm-4 col-xs-12" style="padding: 0px;position: relative;bottom:1.1rem">
										 <a href="javascript:;" class="btn-as transparent dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<?=t('app','My Account');?>
									</a>
										 <div class="dropdown-menu" style="top: 48px;left: 3.6rem;">

												<?php if (app()->customer->identity->group_id == 2) { ?>
													<a href="<?=url(['/store/index', 'slug' => app()->customer->identity->stores->slug]);?>"><i class="fa fa-eye" aria-hidden="true"></i><?=t('app','My Store');?></a>
												<?php } else { ?>
												<?php if (options()->get('app.settings.common.disableStore', 0) == 0) { ?>
												<a href="<?=url(['account/info#company-block']);?>"><i class="fa fa-plus" aria-hidden="true"></i><?=t('app','Upgrade');?></a>
												<?php } ?>
												<?php } ?>
												<?php if (options()->get('app.settings.invoice.disableInvoices', 0) == 0){ ?>
												<a href="<?=url(['account/invoices']);?>"><i class="fa fa-file-o" aria-hidden="true"></i><?=t('app','Invoices');?></a>
												<?php } ?>
												<a href="<?=url(['account/logout']);?>"><i class="fa fa-power-off" aria-hidden="true"></i><?=t('app','Logout');?></a>


										 </div>
									 </div>
									 <div class="col-lg-1 col-md-2 col-sm-4 col-xs-12" style="margin-top: 0.1rem;padding:0px">
										<a href="<?=url(['account/my-listings']);?>" title="My Ads"> <i class="fa fa-tasks" aria-hidden="true" style="float: left;font-size: 2rem;color: #fff"></i> </a>
									 </div>
									 <div class="col-lg-1 col-md-2 col-sm-4 col-xs-12">
										<a href="<?=url(['account/favorites']);?>" title="Favorite Ads"> <i class="fa fa-star" aria-hidden="true" style="float: left;font-size: 2rem;color: #fff"></i> </a>
									 </div>
									 <div class="col-lg-1 col-md-2 col-sm-4 col-xs-12" >
										<a href="<?=url(['account/conversations']);?>" title="Inbox"> <i class="fa fa-envelope" aria-hidden="true" style="float: left;font-size: 2rem;color: #fff"></i> </a>
									 </div>
									 <div class="col-lg-1 col-md-2 col-sm-4 col-xs-12" >
										<a href="<?=url(['account/info']);?>" title="Account Info"> <i class="fa fa-cog" aria-hidden="true" style="float: left;font-size: 2rem;color: #fff"></i> </a>
									 </div>



								 </div>
								</div>
								<?php

								}?>

                            </div>
                            <div class="btn-group hidden-xs">
                                <a href="<?=url(['/listing/post']);?>"><button type="btn" class="btn btn-primary" style="outline:none;"> Free * Post an Ad</button></a>

                            </div>
						 </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</header>