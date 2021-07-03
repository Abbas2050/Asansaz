<?php
use app\models\ListingStat;
use app\models\AdSearch;
use app\assets\AppAsset;

AppAsset::register($this);
$formatter = app()->formatter;
$searchArrayData = array();
$adSearchcategory = AdSearch::find()->groupBy(['category'])->asArray()->all();
if(!empty($adSearchcategory)){
    foreach($adSearchcategory as $asSC){
        $searchWords = AdSearch::find()->where(['category' => $asSC['category']])->groupBy(['search_word'])->asArray()->all();
        foreach($searchWords as $searchWord){
            $searchArrayData[$asSC['category']][] = $searchWord['search_word'];
        }
    }
}
?>
<style>
	
.homepage aside {
    float: left;
    width: 261px;
    margin: 0 16px 38px 0;
    font-size: 13px;
}
.homepage aside .uiBox:first-child {
    margin-top: 0;
    overflow: visible;
}

.homepage aside .uiBox {
    margin-top: 10px;
}
.homepage .uiBox {
    border: 0;
}
.uiBox {
    border: 1px solid #dedede;
    position: relative;
}
.uiBox {
    border: 1px solid #dedede;
    overflow: hidden;
}
.homepage aside>.uiBox>h3.cat-title {
    display: none;
}
.homepage .uiBox h3 {
    border-bottom: 1px solid #e6e6e6;
    padding-bottom: 7px;
    font-size: 13px;
    font-weight: bold;
}
html, body, h1, h2, h3, h4, h5, h6, p, ul, ol, li, a, form, dl, dt, dd, fieldset {
    margin: 0;
    padding: 0;
    background: no-repeat 0 0;
}
nav {
    display: block;
}	
.homepage .uiBox nav .special-categories, .homepage .uiBox nav .services-categories {
    border-bottom: 1px solid #e6e6e6;
    padding-bottom: 8px;
    padding-left: 35px;
}
ol, ul {
    list-style: none;
}
.homepage .uiBox nav>ul>li:before {
    position: absolute;
    left: 0;
    margin-top: 0px;
}
.homepage .uiBox nav .special-categories li.category-acil-acil:before, .homepage .uiBox nav .services-categories li.category-acil-acil:before {
    background-image: url(/assets/site/img/categoryIcons.png);
    background-position: 0 0;
    width: 24px;
    height: 24px;
    content: '';
    display: inline-block;
    vertical-align: middle;
}	
.homepage .uiBox nav>ul>li>a {
    line-height: 28px;
}
a {
    color: #039;
    text-decoration: none;
    outline: 0;
}
.homepage .uiBox nav .special-categories li.category-fiyati-dusen:before, .homepage .uiBox nav .services-categories li.category-fiyati-dusen:before {
    background-image: url(/assets/site/img/categoryIcons.png);
    background-position: -102px 0;
    width: 24px;
    height: 24px;
    content: '';
    display: inline-block;
    vertical-align: middle;
}	
.homepage .uiBox nav .special-categories li.category-48:before, .homepage .uiBox nav .services-categories li.category-48:before {
    background-image: url(/assets/site/img/categoryIcons.png);
    background-position: -170px 0;
    width: 24px;
    height: 24px;
    content: '';
    display: inline-block;
    vertical-align: middle;
}	
.homepage .uiBox nav .special-categories, .homepage .uiBox nav .services-categories {
    border-bottom: 1px solid #e6e6e6;
    padding-bottom: 8px;
    padding-left: 35px;
}
.homepage .uiBox nav .services-categories {
    padding-top: 9px;
    position: relative;
}
.homepage .uiBox nav .services-categories .splash-360-home {
    display: none;
}
.homepage .uiBox nav .special-categories li.category-auto360:before, .homepage .uiBox nav .services-categories li.category-auto360:before {
    background-image: url(/assets/site/img/categoryIcons.png);
    background-position: 0 -34px;
    width: 24px;
    height: 24px;
    content: '';
    display: inline-block;
    vertical-align: middle;
}	
.homepage .uiBox nav .special-categories li.category-estate360:before, .homepage .uiBox nav .services-categories li.category-estate360:before {
    background-image: url(/assets/site/img/categoryIcons.png);
    background-position: -34px -68px;
    width: 24px;
    height: 24px;
    content: '';
    display: inline-block;
    vertical-align: middle;
}	
.homepage .uiBox nav .categories-left-menu {
    margin: 0;
}
.homepage .uiBox nav .categories-left-menu>li {
    padding: 6px 0 0 35px;
    margin-top: 7px;
    border-bottom: 1px solid #e6e6e6;
    position: relative;
}
.homepage .uiBox nav .categories-left-menu>li.category-5:before {
    background-image: url(/assets/site/img/categoryIcons.png);
    background-position: 0 -68px;
    width: 24px;
    height: 24px;
    content: '';
    display: inline-block;
    vertical-align: middle;
}	
.homepage .uiBox nav .categories-left-menu>li>a {
    font-weight: bold;
    line-height: 20px;
}
.homepage .uiBox nav .categories-left-menu>li>a+span {
    font-weight: bold;
}
.homepage .uiBox nav .categories-left-menu>li span {
    color: #a1a1a1;
    font-size: 10px;
}
.homepage .uiBox nav .categories-left-menu>li input[type="checkbox"] {
    display: none;
}
.homepage .uiBox nav .categories-left-menu>li ul li {
    margin-bottom: 5px;
    line-height: 17px;
}	
	
#container {
    margin: 0 auto;
    width: 984px;
    overflow: visible;
}	
.homepage .uiBox.picks-left-menu {
    margin-top: 5px;
}

.homepage .uiBox.picks-left-menu ul {
    padding-left: 35px;
    margin-top: 9px;
}
.homepage .uiBox.picks-left-menu ul>li {
    line-height: 28px;
}
.homepage .uiBox.picks-left-menu ul>li.category-stories:before {
    background-image: url(/assets/site/img/categoryIcons.png);
    background-position: -68px -102px;
    width: 24px;
    height: 24px;
    content: '';
    display: inline-block;
    vertical-align: middle;
}
.homepage .uiBox.picks-left-menu ul>li:before {
    position: absolute;
    left: 0;
}
.homepage .uiBox.picks-left-menu ul>li.category-efsane:before {
    background-image: url(/assets/site/img/categoryIcons.png);
    background-position: -34px -34px;
    width: 24px;
    height: 24px;
    content: '';
    display: inline-block;
    vertical-align: middle;
}	
.homepage .uiBox.picks-left-menu ul>li.category-ilginc:before {
    background-image: url(/assets/site/img/categoryIcons.png);
    background-position: -136px -102px;
    width: 24px;
    height: 24px;
    content: '';
    display: inline-block;
    vertical-align: middle;
}	
a {
    color: #039;
    text-decoration: none;
    outline: 0;
}	
.homepage .homepage-content {
    width: 838px;
    float: left;
}
.homepage .homepage-content .uiBox.showcase {
    margin-bottom: 16px;
}
<style>
.homepage .homepage-content .uiBox {
    clear: left;
    margin-bottom: 20px;
}	

.homepage .uiBox h3 small {
    margin-top: 1px;
    font-size: 12px;
	font-weight: bold;
}

.uiBoxTitle a, .uiBox h3 small {
    float: right;
}
.homepage .vitrin-list {
    padding: 9px 0 0 0;
}
.homepage .homepage-content li {
    float: left;
    width: 106px;
    max-height: 109px;
    padding: 7px 16px 5px 0;
    text-align: left;
    font-size: 11px;
}
.homepage .homepage-content li a {
    color: #333;
}
.homepage .homepage-content li img {
    display: block;
    border: 1px solid #e6e6e6;
    width: 104px;
    height: 78px;
    background: #f5f5f5;
}
.homepage .vitrin-list span, .homepage .interesting-ads span {
    width: 98%;
    display: block;
    white-space: nowrap;
    overflow: hidden;
    -o-text-overflow: ellipsis;
    text-overflow: ellipsis;
    max-height: 17px;
    line-height: 18px;
}

.homepage .homepage-content li a {
    color: #333;
}
.clearfix:after {
    visibility: hidden;
    display: block;
    font-size: 0;
    content: " ";
    clear: both;
    height: 0;
}
body #container {
    width: 1115px!important;
}	
#container:before {
     display: table;
    content: " ";
}	
#container:after {
     clear:both;
}	
.uiBoxTitle a, .uiBox h3 small {
    float: right;
}	
.homepage .uiBox.auto-360-showcase, .homepage .uiBox.estate-360-showcase {
    margin: 30px 0;
}
.homepage .uiBox.auto-360-showcase .service-container, .homepage .uiBox.estate-360-showcase .service-container {
    margin-top: 10px;
}
.homepage .uiBox.auto-360-showcase .service-container .service, .homepage .uiBox.estate-360-showcase .service-container .service {
    display: inline-block;
    margin-right: 5px;
    width: 95px;
}
.homepage .uiBox.auto-360-showcase .service-container .service .service-link, .homepage .uiBox.estate-360-showcase .service-container .service .service-link {
    display: -webkit-box;
    display: -moz-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: box;
    display: flex;
    -webkit-box-align: center;
    -moz-box-align: center;
    -o-box-align: center;
    -ms-flex-align: center;
    -webkit-align-items: center;
    align-items: center;
}
homepage .uiBox.auto-360-showcase .service-container .service .service-link.arac-degerleme:before, .homepage .uiBox.estate-360-showcase .service-container .service .service-link.arac-degerleme:before {
    background-image: url(/assets/site/img/s360HomePageShowcase.png);
    background-position: -34px 0;
    width: 24px;
    height: 24px;
    content: '';
    display: inline-block;
    vertical-align: middle;
    content: '';
    -webkit-flex-shrink: 0;
    flex-shrink: 0;
    display: inline-block;
    margin-right: 5px;
}
.homepage .uiBox.auto-360-showcase .service-container .service.x75, .homepage .uiBox.estate-360-showcase .service-container .service.x75 {
    width: 105px;
}
.homepage .uiBox.auto-360-showcase .service-container .service .service-link.arac-karsilastirma:before, .homepage .uiBox.estate-360-showcase .service-container .service .service-link.arac-karsilastirma:before {
    background-image: url(/assets/site/img/s360HomePageShowcase.png);
    background-position: -68px 0;
    width: 24px;
    height: 24px;
    content: '';
    display: inline-block;
    vertical-align: middle;
    content: '';
    -webkit-flex-shrink: 0;
    flex-shrink: 0;
    display: inline-block;
    margin-right: 5px;
}	
.homepage .uiBox.auto-360-showcase .service-container .service .service-link.hasar-sorgulama:before, .homepage .uiBox.estate-360-showcase .service-container .service .service-link.hasar-sorgulama:before {
    background-image: url(/assets/site/img/s360HomePageShowcase.png);
    background-position: -102px 0;
    width: 24px;
    height: 24px;
    content: '';
    display: inline-block;
    vertical-align: middle;
    content: '';
    -webkit-flex-shrink: 0;
    flex-shrink: 0;
    display: inline-block;
    margin-right: 5px;
}	
.homepage .uiBox.auto-360-showcase .service-container .service .service-link.oto-ekspertiz:before, .homepage .uiBox.estate-360-showcase .service-container .service .service-link.oto-ekspertiz:before {
    background-image: url(/assets/site/img/s360HomePageShowcase.png);
    background-position: 0 -69px;
    width: 24px;
    height: 24px;
    content: '';
    display: inline-block;
    vertical-align: middle;
    content: '';
    -webkit-flex-shrink: 0;
    flex-shrink: 0;
    display: inline-block;
    margin-right: 5px;
}
.homepage .uiBox.auto-360-showcase .service-container .service .service-link.kredi-teklifleri:before, .homepage .uiBox.estate-360-showcase .service-container .service .service-link.kredi-teklifleri:before {
    background-image: url(/assets/site/img/s360HomePageShowcase.png);
    background-position: -102px -34px;
    width: 24px;
    height: 24px;
    content: '';
    display: inline-block;
    vertical-align: middle;
    content: '';
    -webkit-flex-shrink: 0;
    flex-shrink: 0;
    display: inline-block;
    margin-right: 5px;
}	
.homepage .uiBox.auto-360-showcase .service-container .service .service-link.sifir-araclar:before, .homepage .uiBox.estate-360-showcase .service-container .service .service-link.sifir-araclar:before {
    background-image: url(/assets/site/img/s360HomePageShowcase.png);
    background-position: -34px -69px;
    width: 24px;
    height: 24px;
    content: '';
    display: inline-block;
    vertical-align: middle;
    content: '';
    -webkit-flex-shrink: 0;
    flex-shrink: 0;
    display: inline-block;
    margin-right: 5px;
}	
.homepage .uiBox.auto-360-showcase .service-container .service .service-link.arac-rehberi:before, .homepage .uiBox.estate-360-showcase .service-container .service .service-link.arac-rehberi:before {
    background-image: url(/assets/site/img/s360HomePageShowcase.png);
    background-position: 0 -35px;
    width: 24px;
    height: 24px;
    content: '';
    display: inline-block;
    vertical-align: middle;
    content: '';
    -webkit-flex-shrink: 0;
    flex-shrink: 0;
    display: inline-block;
    margin-right: 5px;
}
.homepage .uiBox nav .categories-left-menu>li.category-10:before {
    background-image: url(/assets/site/img/categoryIcons.png);
    background-position: -136px -68px;
    width: 24px;
    height: 24px;
    content: '';
    display: inline-block;
    vertical-align: middle;
}
.homepage .uiBox nav .categories-left-menu>li.category-7:before {
    background-image: url(/assets/site/img/categoryIcons.png);
    background-position: -136px -34px;
    width: 24px;
    height: 24px;
    content: '';
    display: inline-block;
    vertical-align: middle;
}	
.homepage .uiBox nav .categories-left-menu>li.category-6:before {
    background-image: url(/assets/site/img/categoryIcons.png);
    background-position: -170px -102px;
    width: 24px;
    height: 24px;
    content: '';
    display: inline-block;
    vertical-align: middle;
}
.homepage .uiBox nav .categories-left-menu>li.category-8:before {
    background-image: url(/assets/site/img/categoryIcons.png);
    background-position: -170px -68px;
    width: 24px;
    height: 24px;
    content: '';
    display: inline-block;
    vertical-align: middle;
}
.homepage .uiBox nav .categories-left-menu>li.category-9:before {
    background-image: url(/assets/site/img/categoryIcons.png);
    background-position: -68px -136px;
    width: 24px;
    height: 24px;
    content: '';
    display: inline-block;
    vertical-align: middle;
}	
.homepage .uiBox.auto-360-showcase .service-container .service .service-link.arac-rehberi:before, .homepage .uiBox.estate-360-showcase .service-container .service .service-link.arac-rehberi:before {
    background-image: url(/assets/site/img/s360HomePageShowcase.png);
    background-position: 0 -35px;
    width: 24px;
    height: 24px;
    content: '';
    display: inline-block;
    vertical-align: middle;
    content: '';
    -webkit-flex-shrink: 0;
    flex-shrink: 0;
    display: inline-block;
    margin-right: 5px;
}	
.homepage .uiBox.auto-360-showcase .service-container .service .service-link.arac-degerleme:before, .homepage .uiBox.estate-360-showcase .service-container .service .service-link.arac-degerleme:before {
    background-image: url(/assets/site/img/s360HomePageShowcase.png);
    background-position: -34px 0;
    width: 24px;
    height: 24px;
    content: '';
    display: inline-block;
    vertical-align: middle;
    content: '';
    -webkit-flex-shrink: 0;
    flex-shrink: 0;
    display: inline-block;
    margin-right: 5px;
}
.homepage .homepage-content .uiBox.most {
    margin-bottom: 17px;
}
.homepage .vitrin-list.popular-links, .homepage .interesting-ads.popular-links {
    margin-top: 6px;
    padding-top: 0;
}
.homepage .vitrin-list {
    padding: 9px 0 0 0;
}
.homepage .vitrin-list.popular-links li, .homepage .interesting-ads.popular-links li {
    width: auto;
    padding: 0;
    margin: 10px 10px 0 0;
    height: 27px;
}
.homepage .vitrin-list.popular-links li a, .homepage .interesting-ads.popular-links li a {
    border: 1px solid #dfdfdf;
    border-radius: 5px;
    padding: 5px 10px;
    color: #44474e;
    font-size: 12px;
}
.homepage .center-banner {
    height: 90px;
    margin-bottom: 22px;
}	
.homepage .uiBox nav .categories-left-menu>li ul {
    margin: 5px 0 0 0;
}
@media only screen and (max-width: 600px) {
  
 .listings-list{
     margin-top: 50px !important;
 }
  .app-homepage-content{
      padding-top: 0px !important;
      width:100% !important;
  }
  .app-homepage-content .vitrin-list li{
      width: 112px !important;
  }
}
</style>
<section class="listings-list">
    
    <div class="container">
        <?php if ($title) { ?>
            <div class="row">
				<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    
                </div>
                
            </div>
        <?php } ?>
         
				<div class="homepage">
				  <div class="content">
					<aside class="app-left-sidebar">
						<div class="uiBox" data-search-type="category/tree">
						  <h3 class="cat-title">Kategoriler</h3>
						  <nav>
							  <ul class="special-categories">
								<li class="category-acil-acil"> 
									<a title="Emergency Emergency" class="icon-category category-acil-acil trackLinkClick trackId_acilacil_sol_menu" href="#">
										<font style="vertical-align: inherit;">
											<font style="vertical-align: inherit;">
												Emergency Emergency
											</font>
										</font>
									</a> 
								</li>
							
								<li class="icon-category category-48"> 
									<a title="Last 48 Hours" class="trackLinkClick trackId_last48_sol_menu" href="#">
										<font style="vertical-align: inherit;">
											<font style="vertical-align: inherit;">
												Last 48 Hours
											</font>
										</font>
									</a>
									<font style="vertical-align: inherit;">
										<font style="vertical-align: inherit;"> / </font>
									</font>
									<a title="1 week" class="trackLinkClick trackId_lastweek_sol_menu" href="#">
										<font style="vertical-align: inherit;">
											<font style="vertical-align: inherit;">1 Week</font>
										</font>
									</a>
									<font style="vertical-align: inherit;">
										<font style="vertical-align: inherit;"> / </font>
									</font>
									<a title="1 month" class="trackLinkClick trackId_lastmonth_sol_menu" href="#">
										<font style="vertical-align: inherit;">
											<font style="vertical-align: inherit;">1 Month</font></font>
									</a> 
								</li>
						      </ul>
							 <!-- <ul class="services-categories">-->
								<!--<li class="splash-360-home"></li>-->
								<!--<li class="category-auto360"> -->
								<!--	<a href="#" title="Auto360" data-click-category="oto360" data-click-event="click-anasayfa" class="icon-category trackLinkClick trackId_oto360anasayfa">-->
								<!--		<font style="vertical-align: inherit;">-->
								<!--			<font style="vertical-align: inherit;"> -->
								<!--				Auto360-->
								<!--			</font>-->
								<!--		</font>-->
								<!--		<span class="new-category">-->
								<!--			<font style="vertical-align: inherit;">-->
								<!--				<font style="vertical-align: inherit;">new</font>-->
								<!--			</font>-->
								<!--		</span> -->
								<!--	</a> -->
								<!-- </li>-->
								<!--<li class="category-estate360">-->
								<!--	<a href="" title="Real Estate360" data-click-category="emlak360" data-click-event="click-anasayfa" class="icon-category trackLinkClick trackId_emlak360anasayfa">-->
								<!--		<font style="vertical-align: inherit;">-->
								<!--			<font style="vertical-align: inherit;"> -->
								<!--				Real Estate360-->
								<!--			</font>-->
								<!--		</font>-->
								<!--		<span class="new-category">-->
								<!--			<font style="vertical-align: inherit;">-->
								<!--				<font style="vertical-align: inherit;">new</font>-->
								<!--			</font>-->
								<!--		</span> -->
								<!--	</a> -->
								<!--</li>-->
						      <!--</ul>-->
							  <ul class="categories-left-menu">
							     <?=$this->render('../../../views/site/nCategories', [
										   'categories' => $categories
								]);

							  ?>
						      </ul>
							  
						 </nav>	  
						</div>	
					    <div class="uiBox picks-left-menu">
							<h3>
								<font style="vertical-align: inherit;">
									<font style="vertical-align: inherit;">
										Our Choices
									</font>
								</font>
							</h3>
							<ul class="picks-left-menu">
							  <li class="category-stories"> 
								  <a href="#" title="Share Your Story">
									  <font style="vertical-align: inherit;">
										  <font style="vertical-align: inherit;">
											  Share Your Story
										  </font>
									  </font>
								  </a> 
							  </li>
							  <li class="category-efsane"> 
								  <a href="#" title="Legendary Advertisements">
									  <font style="vertical-align: inherit;">
										  <font style="vertical-align: inherit;">
											  Legendary Advertisements
										  </font>
									  </font>
								  </a> 
							  </li>
							  <li class="category-ilginc"> 
								  <a href="https://www.sahibinden.com/ilginc-ilanlar" title="Interesting Classifieds">
									  <font style="vertical-align: inherit;">
										  <font style="vertical-align: inherit;">
											  Interesting Classifieds
										  </font>
									  </font>
								  </a> 
							  </li>
							</ul>
					  </div>
					</aside>
				    <div class="homepage-content app-homepage-content">
				        
                        <div class="row">
                            <div class="col-md-12">
                                
                                <?php app()->trigger('home.under.categories', new \app\yii\base\Event()); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                
                                <?php app()->trigger('mobile.home.under.categories', new \app\yii\base\Event()); ?>
                            </div>
                        </div>
                        <br>
					    <div class="uiBox showcase">
						<h3>
							<small>
								<a href="#">
									<font style="vertical-align: inherit;">
										<font style="vertical-align: inherit;">
											Show all showcase ads
										</font>
									</font>
								</a>
							</small>
							<font style="vertical-align: inherit;">
								<font style="vertical-align: inherit;">
										Home Showcase
								</font>
							</font>
						   </h3>
							<ul class="vitrin-list clearfix" style="width: 102%;" >
							  <?php foreach ($ads as $ad) { ?>
								<?php $isFavorite = (!empty($ad->favorite)) ? true : false; ?>
									<li>
										<a href="<?= url(['/listing/index', 'slug' => $ad->slug]); ?>" title="<?= html_encode(mb_strtoupper($ad->title,'UTF-8')); ?>">
												<img alt="<?= html_encode(ucwords($ad->title)); ?>" src="<?= Yii::getAlias('@web/assets/site/img/img-listing-list-empty.png');?>" srcset="<?= ($ad->mainImage != null) ? $ad->mainImage->image : ''; ?>" class="lazyload">
												<span>
													<font style="vertical-align: inherit;">
														<font style="vertical-align: inherit;">
															<?= html_encode(ucwords($ad->title)); ?>
														</font>
													</font>
											   </span>
											</a>
									</li>
							<?php } ?>	
							</ul>
					</div>
					<!-- Homepage Showcase -->

						<div class="center-banner">
							  <?php app()->trigger('home.above.footer', new \app\yii\base\Event()); ?>
							  <?php app()->trigger('mobile.home.above.footer', new \app\yii\base\Event()); ?>
						</div>
										<!-- Sahibinden Center Banner -->

						<div class="uiBox auto-360-showcase" style="display: none">
							<h3>
								<font style="vertical-align: inherit;">
								 <font style="vertical-align: inherit;">
										Auto360
								 </font>
								</font>
							</h3>

							<div class="service-container">
								<ul class="service">
									<a class="service-link arac-degerleme" href="/oto360/arac-degerleme/alirken" target="_blank"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Vehicle Valuation</font></font></a>
								</ul>
								<ul class="service x75">
									<a class="service-link arac-karsilastirma" href="/oto360/arac-karsilastirma" target="_blank"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Vehicle Comparison</font></font></a>
								</ul>
								<ul class="service">
									<a class="service-link hasar-sorgulama" href="/oto360/hasar-sorgulama" target="_blank"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Vehicle Damage Inquiry</font></font></a>
								</ul>
								<ul class="service">
									<a class="service-link oto-ekspertiz" href="/oto360/oto-ekspertiz" target="_blank"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Auto Expertise</font></font></a>
								</ul>
								<ul class="service">
									<a class="service-link kredi-teklifleri" href="/oto360/tasit-kredisi-ve-ihtiyac-kredisi-teklifleri" target="_blank"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Credit Offers</font></font></a>
								</ul>
								<ul class="service">
									<a class="service-link sifir-araclar" href="/oto360/sifir-araclar" target="_blank"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Zero Vehicle World</font></font></a>
								</ul>
								<ul class="service">
									<a class="service-link arac-rehberi" href="/oto360/arac-alim-rehberi" target="_blank"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Vehicle Buying Guide</font></font></a>
								</ul>
								<ul class="service">
									<a class="service-link arac-rehberi" href="/oto360/arac-satis-rehberi" target="_blank"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Vehicle Sales Directory</font></font></a>
								</ul>
							</div>
						</div>

						<!--<div class="uiBox most">-->
						<!--	<h3><font style="vertical-align: inherit;">-->
						<!--			<font style="vertical-align: inherit;">-->
						<!--				Most popular Realestate-->
						<!--			</font>-->
						<!--		</font>-->
						<!--	</h3>-->
						<!--	<ul class="popular-links vitrin-list clearfix">-->
						<!--		<li>-->
						<!--			<a target="_self" href="https://bahriamall.pk/index.php/listing/index/warehouse-by-the-owner-cg7130b7sw07d" title="iphone 12 mini">-->
						<!--				<font style="vertical-align: inherit;">-->
						<!--					<font style="vertical-align: inherit;">-->
						<!--						Warehouse by the Owner-->
						<!--					</font>-->
						<!--				</font>-->
						<!--			</a>-->
						<!--		</li>-->
						<!--		<li>-->
						<!--			<a target="_self" href="https://bahriamall.pk/index.php/listing/index/top-floor-with-inhabited-view-from-the-owner-aj896nl05e36d" title="iphone 12 mini">-->
						<!--				<font style="vertical-align: inherit;">-->
						<!--					<font style="vertical-align: inherit;">-->
						<!--						Top Floor With Inhabited-->
						<!--					</font>-->
						<!--				</font>-->
						<!--			</a>-->
						<!--		</li>-->
						<!--		<li>-->
						<!--			<a target="_self" href="https://bahriamall.pk/index.php/listing/index/brand-new-house-sd304dnkbb778" title="iphone 12 mini">-->
						<!--				<font style="vertical-align: inherit;">-->
						<!--					<font style="vertical-align: inherit;">-->
						<!--						Brand New House-->
						<!--					</font>-->
						<!--				</font>-->
						<!--			</a>-->
						<!--		</li>-->
						<!--   </ul>-->
						<!--</div>-->
						<!--<div class="uiBox most">-->
						<!--	<h3><font style="vertical-align: inherit;">-->
						<!--			<font style="vertical-align: inherit;">-->
						<!--				Most popular Jobs-->
						<!--			</font>-->
						<!--		</font>-->
						<!--	</h3>-->
						<!--	<ul class="popular-links vitrin-list clearfix">-->
						<!--		<li>-->
						<!--			<a target="_self" href="https://bahriamall.pk/index.php/listing/index/web-developer-op62124y2t212" title="iphone 12 mini">-->
						<!--				<font style="vertical-align: inherit;">-->
						<!--					<font style="vertical-align: inherit;">-->
						<!--						Web Developer-->
						<!--					</font>-->
						<!--				</font>-->
						<!--			</a>-->
						<!--		</li>-->
						<!--		<li>-->
						<!--			<a target="_self" href="https://bahriamall.pk/index.php/listing/index/teacher-required-mp176k0v21d64" title="iphone 12 mini">-->
						<!--				<font style="vertical-align: inherit;">-->
						<!--					<font style="vertical-align: inherit;">-->
						<!--						Teacher Required-->
						<!--					</font>-->
						<!--				</font>-->
						<!--			</a>-->
						<!--		</li>-->
						<!--		<li>-->
						<!--			<a target="_self" href="https://bahriamall.pk/index.php/listing/index/photographer-require-cy96710pz9ef4" title="iphone 12 mini">-->
						<!--				<font style="vertical-align: inherit;">-->
						<!--					<font style="vertical-align: inherit;">-->
						<!--						Photographer Require-->
						<!--					</font>-->
						<!--				</font>-->
						<!--			</a>-->
						<!--		</li>-->
						<!--   </ul>-->
						<!--</div>	-->
						<!--<div class="uiBox most">-->
						<!--	<h3><font style="vertical-align: inherit;">-->
						<!--			<font style="vertical-align: inherit;">-->
						<!--				Most popular Vehicles-->
						<!--			</font>-->
						<!--		</font>-->
						<!--	</h3>-->
						<!--	<ul class="popular-links vitrin-list clearfix">-->
						<!--		<li>-->
						<!--			<a target="_self" href="https://bahriamall.pk/index.php/listing/index/web-developer-op62124y2t212" title="iphone 12 mini">-->
						<!--				<font style="vertical-align: inherit;">-->
						<!--					<font style="vertical-align: inherit;">-->
						<!--						Mecedeze-->
						<!--					</font>-->
						<!--				</font>-->
						<!--			</a>-->
						<!--		</li>-->
						<!--		<li>-->
						<!--			<a target="_self" href="https://bahriamall.pk/index.php/listing/index/teacher-required-mp176k0v21d64" title="iphone 12 mini">-->
						<!--				<font style="vertical-align: inherit;">-->
						<!--					<font style="vertical-align: inherit;">-->
						<!--						Toyota Corola-->
						<!--					</font>-->
						<!--				</font>-->
						<!--			</a>-->
						<!--		</li>-->
						<!--		<li>-->
						<!--			<a target="_self" href="https://bahriamall.pk/index.php/listing/index/photographer-require-cy96710pz9ef4" title="iphone 12 mini">-->
						<!--				<font style="vertical-align: inherit;">-->
						<!--					<font style="vertical-align: inherit;">-->
						<!--						Honda Civic-->
						<!--					</font>-->
						<!--				</font>-->
						<!--			</a>-->
						<!--		</li>-->
						<!--   </ul>-->
						<!--</div>		-->
						<?php if(!empty($searchArrayData)){ ?>
						    <?php foreach($searchArrayData as $key => $searchArrayDat){ ?>
                                <div class="uiBox most">
        							<h3><font style="vertical-align: inherit;">
        									<font style="vertical-align: inherit;">
        										Most popular searches <?= $key ?>
        									</font>
        								</font>
        							</h3>
            						<ul class="popular-links vitrin-list clearfix">
            							<?php foreach($searchArrayDat as $key2 => $searchArrayDa){ ?>    
            								<li>
            									<a target="_self" href="https://asansaz.com/index.php/search?ListingSearch%5BsearchPhrase%5D=<?=$searchArrayDa?>" title="">
            										<font style="vertical-align: inherit;">
            											<font style="vertical-align: inherit;">
            												<?= $searchArrayDa ?>
            											</font>
            										</font>
            									</a>
            								</li>
            						    <?php } ?>  
            						</ul>
        						</div>	
        					<?php } ?>
						<?php } ?>
										


					</div>  
				  </div>
				</div>
  		
     </div>
       
</section>
