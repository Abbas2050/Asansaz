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
                      </font></font></strong>
                </div>
               
			</div>
            
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