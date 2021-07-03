<?php
use yii\widgets\ListView;
use yii\helpers\Html;
use app\helpers\SvgHelper;
use app\assets\AppAsset;
use app\components\AdsListWidget;

AppAsset::register($this);
?>
<style>
ol, ul {
    list-style: none;
}	
#container {
    margin: 0 auto;
    width: 1150px;
    overflow: visible;
}
.store-page {
    width: 1150px;
    margin: 10px auto 0 auto;
    position: relative;
    min-height: 1057px;
}	
.store-page .theme {
    width: 1150px;
    height: 250px;
    position: relative;
}	
.store-page .information-area {
    float: left;
    width: 219px;
    position: absolute;
    left: 20px;
    top: 156px;
}	
.store-page .info {
    padding: 10px 13px;
    word-wrap: break-word;
    text-align: center;
}
.store-page .info img {
    max-width: 190px;
    height: 70px;
    display: block;
    margin: auto;
}	
.store-page .info, .store-page .search-in-store input, .store-page .categories, .store-page .classified-list li, .store-page .info h1:before, .store-page .without-logo h1:after, .store-page .about h4:before, .store-page .our-consultants h4:before, .store-page .classified-list-header:before {
    box-shadow: 0 2px 2px 0 #ececec;
}
.store-page .info, .store-page .search-in-store input, .store-page .categories, .store-page .classified-list li {
    background: #fff;
    border-radius: 3px;
    margin-bottom: 15px;
    border: 1px solid #dcdcdc;
}
a {
    color: #039;
    text-decoration: none;
    outline: 0;
}
.store-page .info h1 {
    color: #333;
    font-size: 20px;
    text-align: center;
    margin: 30px 0 10px 0;
    position: relative;
}
.store-page .info h1:before {
    content: '';
    display: block;
    width: 188px;
    border-bottom: 1px solid #dcdcdc;
    position: absolute;
    top: -16px;
    left: 0;
}
.store-page .info, .store-page .search-in-store input, .store-page .categories, .store-page .classified-list li, .store-page .info h1:before, .store-page .without-logo h1:after, .store-page .about h4:before, .store-page .our-consultants h4:before, .store-page .classified-list-header:before {
    box-shadow: 0 2px 2px 0 #ececec;
}
.store-page .info p {
    color: #333;
    font-size: 12px;
    text-align: center;
    margin-bottom: 15px;
    position: relative;
}	
.store-page .info p:before {
    content: '';
    display: block;
    height: 20px;
    width: 10px;
    background: url(/assets/site/img/storeHomePage.png) no-repeat 0 0;
    position: absolute;
    top: -2px;
    left: 27px;
}
.store-page .search-in-store {
    position: relative;
}
html, body, h1, h2, h3, h4, h5, h6, p, ul, ol, li, a, form, dl, dt, dd, fieldset {
    margin: 0;
    padding: 0;
    background: no-repeat 0 0;
}
.store-page .info, .store-page .search-in-store input, .store-page .categories, .store-page .classified-list li {
    background: #fff;
    border-radius: 3px;
    margin-bottom: 15px;
    border: 1px solid #dcdcdc;
}

select, input, textarea, optgroup {
    font: 12px "Lucida Grande","LucidaGrande",Arial,sans-serif;
}
.store-page .search-in-store .search-box {
    height: 40px;
    color: #999;
    opacity: 1;
    padding: 0 30px 0 12px;
}	
.store-page .search-in-store .search-submit {
    height: 22px;
    width: 30px;
    border: 0;
    box-shadow: none;
    cursor: pointer;
    background: url(/assets/site/img/storeHomePage.png) no-repeat 4px -47px;
    position: absolute;
    top: 13px;
    right: 0;
}
.store-page .categories h4 {
    padding: 8px;
    border-bottom: 1px solid #dcdcdc;
    font-size: 12px;
    background: #efefef;
    background: linear-gradient(to bottom,#fff 0,#efefef 100%);
}
.store-page .categories ul {
    padding: 7px 15px 15px 15px;
    max-height: 450px;
    overflow: auto;
}
.store-page .categories li {
    padding-top: 7px;
}	
.store-page .categories .top-category {
    font-weight: 700;
}
.store-page .categories a {
    color: #00339f;
    font-size: 12px;
}
.store-page .categories .level1 {
    margin-left: 8px;
}
.store-page .categories span {
    color: #959595;
}
.store-page .categories .button-container {
    display: none;
}
.store-page .categories .button-container a.show-button {
    background-position: 90px -499px;
}
.store-page .categories .button-container a {
    font-weight: bold;
    padding-right: 20px;
    cursor: pointer;
    background: url(/bahriamall/assets/site/img/icon_16.png) no-repeat;
}
.store-page .categories .button-container a.hide-button {
    background-position: 28px -526px;
    display: none;
}
.store-page .about {
    word-wrap: break-word;
}
.store-page .our-consultants h4, .store-page .about h4 {
    padding: 8px 8px 25px 8px;
    font-size: 12px;
    position: relative;
}
.store-page .our-consultants h4:before, .store-page .about h4:before {
    content: '';
    display: block;
    width: 218px;
    border-bottom: 1px solid #dcdcdc;
    position: absolute;
    top: 35px;
    left: 0;
}
.store-page .about h2 {
    padding: 0 9px 15px 9px;
    font-size: 12px;
    line-height: 18px;
    color: #333;
    font-weight: 200;
    max-height: 250px;
    overflow: auto;
}	
.store-page .categories ul ul {
    padding: 0;
    max-height: 350px;
}
.store-page .classified-list-box {
    float: left;
    width: 874px;
    margin: 7px 0 0 259px;
    position: relative;
}
.store-page .classified-list-header {
    height: 57px;
}
.store-page .account-year {
    height: 39px;
    width: 100px;
    padding: 5px 0 0 15px;
    margin-bottom: 7px;
    float: left;
}
.store-page .account-year span {
    color: #999;
    font-size: 11px;
}
.store-page .account-year strong {
    color: #1a3a68;
    font-size: 18px;
    display: block;
    margin: 2px 0 0 24px;
    position: relative;
}
.store-page .account-year strong:before {
    content: '';
    display: block;
    height: 25px;
    width: 20px;
    background-image: url(/assets/site/img/badge.png);
    background-repeat: no-repeat;
    background-size: 18px;
    position: absolute;
    top: 0;
    left: -26px;
}	
.store-page .account-year strong span {
    font-size: 14px;
    color: #1a3a68;
}
.store-page .sorting-menu {
    float: right;
    margin-top: 12px;
}
.store-page .sorting-menu>li {
    position: relative;
    width: 70px;
    height: 26px;
    z-index: 100;
    width: 215px;
}
.store-page .sorting-menu>li>a {
    display: block;
    width: 192px;
    height: 17px;
    background: #f5f5f5;
    border-radius: 3px;
    padding: 5px 12px 1px 9px;
    border: 1px solid #fff;
    font-size: 11px;
    position: absolute;
    z-index: 10;
    text-decoration: none;
    color: #333;
}
.store-page .sorting-menu>li>a:after {
    content: ' ';
    width: 10px;
    height: 6px;
    background: url(/bahriamall/assets/site/img/faceted_search.png) right -1050px no-repeat;
    margin-left: 5px;
    position: absolute;
    right: 7px;
    top: 9px;
}	
.store-page .sorting-menu>li ul {
    display: none;
    position: absolute;
    top: 27px;
    right: 0;
    border: 1px solid #bebebe;
    background-color: #fff;
}
.store-page .sorting-menu ul a {
    display: block;
    padding: 7px 5px 7px 12px;
    border-bottom: 1px solid #dadada;
}
.store-page .classified-count {
    height: 50px;
    width: 120px;
    padding: 5px 0 0 7px;
    margin-bottom: 7px;
    float: right;
    border-left: 1px solid #dcdcdc;
    margin-right: 10px;
}
.store-page .classified-count span {
    color: #999;
    font-size: 11px;
}
.store-page .classified-count strong {
    color: #1a3a68;
    font-size: 18px;
    display: block;
    margin-top: 2px;
}
.store-page .searched-keys {
    overflow: hidden;
    padding: 10px 10px 10px 0;
    margin-bottom: 10px;
    border: 1px solid #f3f3f3;
    border-radius: 2px;
}
.store-page .searched-keys li strong {
    float: left;
    font-size: 11px;
    margin: 5px 5px 0 0;
    position: relative;
}
.store-page .searched-keys li strong:before {
    content: '';
    display: block;
    height: 10px;
    width: 10px;
    position: absolute;
    top: 0;
    right: -11px;
}
.store-page .searched-keys li a {
    float: left;
    padding: 5px 25px 5px 7px;
    margin: 1px 0 1px 4px;
    background: #eee;
    color: #666;
    font-size: 11px;
    border-radius: 3px;
    text-decoration: none;
    position: relative;
}
.store-page .searched-keys li a:before {
    display: block;
    content: '';
    height: 11px;
    width: 11px;
    background-image: url(/assets/site/img/newSearchRevised.png);
    background-position: -52px -49px;
    position: absolute;
    top: 6px;
    right: 6px;
}	
.store-page .searched-keys li {
    float: left;
    margin-left: 10px;
}	
.store-page .classified-list {
    margin-bottom: 25px;
}	

table {
    border-collapse: collapse;
    border-spacing: 0;
    border: 0;
}
tr {
    display: table-row;
    vertical-align: inherit;
    border-color: inherit;
}
.store-page .classified-list table tr:hover {
    background-color: #f0f6ff;
}
.store-page .classified-list table tr {
    border-bottom: 1px solid #e9e9e9;
}
.store-page .classified-list table th {
    height: 35px;
    background: #f8f8f8;
    font-size: 13px;
    color: #000;
    padding: 5px 10px;
    border-right: 1px solid #fff;
}
.store-page .classified-list table a {
    text-decoration: none;
}
tbody {
    display: table-row-group;
    vertical-align: middle;
    border-color: inherit;
}
.store-page .classified-list table tr {
    border-bottom: 1px solid #e9e9e9;
}
.store-page .classified-list table td {
    font-size: 13px;
    color: #000;
    padding: 11px 4px;
}
.store-page .classified-list table .classified-image {
    display: block;
    height: 130px;
    width: 172px;
    position: relative;
    border: 1px solid #e9e9e9;
}

.store-page .classified-list table a {
    text-decoration: none;
}
.store-page .classified-list table .classified-image img {
    display: block;
    width: 164px;
    height: 124px;
}	
.listings-list-2 .item .info .category{
	text-align: left;
}	
.listings-list-2 .item .info .name span.title{
	text-align: left;	
}
.listings-list-2 .item .info .name span{
	text-align: left;	
}
.listings-list-2 .item .info .location{
	text-align: left;
}
.listings-list-2 .item .info {
    box-shadow: none;
    border: none;
}	
</style>


<div class="container">
    <div class="row">
        <div class="mb10 col-lg-8 col-lg-push-2 col-md-8 col-md-push-2 col-sm-12 hidden-xs">
            <?php app()->trigger('store.above.results', new \app\yii\base\Event()); ?>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="mobile-advert mb10 col-xs-12 hidden-lg hidden-md hidden-sm">
            <?php app()->trigger('mobile.store.above.results', new \app\yii\base\Event()); ?>
        </div>
    </div>
</div>
<div id="container">
	<div class="store-page">
	  <div class="theme">
		<img src="<?=$store->company_banner?>" height="250" width="1150">
	  </div>
	  <div class="information-area">
		  <div class="info with-logo with-phone">
			  <a href="#" class="top-category">
                    <img src="<?php echo $store->company_logo;?>" alt="<?=$store->store_name?>">
              </a>
			  <h1><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?= html_encode($store->store_name); ?></font></font></h1>
			  <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?=$store->company_phone?></font></font></p>
			  <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?=$store->company_mobile?></font></font></p>
		  </div>
		  <div class="search-in-store">
			  <form name="searchInStore">
				<input type="text" name="query_text" placeholder="Search In Store" class="search-box">
				<input type="submit" value="" class="search-submit">
			  </form>
		  
	 	 </div>	
	  	  <div class="categories">
			<h4><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Our Portfolio</font></font></h4>

			<ul>
				<li class="level0">
						<a href="#" class="top-category"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Estate</font></font></a>
					</li>
				<ul>
						<li class="level1">
								<a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
									Housing </font></font><span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
										(9)
									</font></font></span>
								</a>
							</li>
						<li class="level1">
								<a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
									Land </font></font><span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
										(3)
									</font></font></span>
								</a>
							</li>
						<li class="button-container">
							<a class="show-button"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Show all of them</font></font></a>
							<a class="hide-button"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Close</font></font></a>
						</li>
					</ul>
				</ul>
       </div>	
	      <div class="about">
                <h4><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">about us</font></font></h4>

                <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                   <p align="justify"><?=html_encode($store->company_about_us)?></p>
        </div>	
	  </div>	
      <div class="classified-list-box">

            <!-- classified list header -->
            <div class="classified-list-header">
				
				<div class="account-year">
                        <span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">MEMBERSHIP</font></font></span>
                        <strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                            1 </font></font><span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">year</font></font></span>
                        </strong>
                    </div>
            	<div class="classified-count">
                    <span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">NUMBER OF POSTS</font></font></span>
                    <strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                        <?php //=count($storeAds)?></font></font></strong>
                </div>
               
			</div>
            
            <div class="searched-keys">
                    <ul>
                        <li>
                                <strong><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Counselor</font></font></strong>
                                <a href="/"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">GREEN CONSTRUCTION</font></font></a>
                            </li>
                        <li>
                                <a href="/"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Clear All</font></font></a>
                            </li>
                        </ul>
            </div>
            
		    <div class="classified-list listings-list-2" data-total-matches="12">
					
				     <?= ListView::widget([
								'id'               => 'store-listings',
								'dataProvider'     => $storeAds,
								'layout'           => '
									<div class="row">
										{items}
									</div>
									<div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="pagination-custom">
												<div class="row">
													{pager}
												</div>
											</div>
										</div>
									</div>
								',
								'itemView'         => '_ad-item',
								'emptyText'        => '',
								'itemOptions'      => [
									'tag'   => 'div',
									'class' => 'col-lg-12 col-md-12 col-sm-12 col-xs-12 item',
								],
								'emptyTextOptions' => ['tag' => 'ul', 'class' => 'list store'],
								'pager'            => [
									'class'         => 'app\widgets\CustomLinkPager',
									'prevPageLabel' => SvgHelper::getByName('arrow-left'),
									'nextPageLabel' => SvgHelper::getByName('arrow-right')
								]
							]); ?>
						  <?php if ($isNothingFound) { ?>
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<span class="no-results"><?= t('app', 'No results found') ?></span>
								</div>
							</div>
						<?php } ?>

		    </div>

      </div>	 
    </div>
</div>