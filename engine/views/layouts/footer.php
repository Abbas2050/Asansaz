<?php
use app\components\CategoriesListWidget;
use app\components\PageSectionWidget;
use app\components\SocialMediaListWidget;
use app\models\Page;
?>
<style>

.footericon {
  display: inline-block;
  border-radius: 50%;
  padding: 1.3rem 1.5rem;
  color:#fff;
  font-size:25px;
  background-color: #B22222;	
}

</style>
<footer id="footer">

    <div class="post-add-bar">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <span class="pull-right"><?= t('app', 'The easy way to make extra money')?></span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <a href="<?= url(['/listing/post']); ?>" class="btn-as secondary"><i class="fa fa-plus" aria-hidden="true"></i><?=t('app','Post new ad');?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">

            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <?= CategoriesListWidget::widget(['title' => t('app', 'Categories')]) ?>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <?//= PageSectionWidget::widget(['sectionType' => Page::SECTION_ONE]) ?>
				<h2><?="Corporate"?></h2>
			    <ul class="links one-columns">
				  <li><a href="#">About Us</a></li>
				  <li><a href="#">Human Resources</a></li>
				  <li><a href="#">News</a></li>
				  <li><a href="#">Contact</a></li>

				</ul>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <?//= PageSectionWidget::widget(['sectionType' => Page::SECTION_TWO]) ?>
				  <h2><?="Privacy and Use"?></h2>
				  <ul class="links one-columns">
					 
					  <li><a href="#">Contact &and; Rules</a></li>
					  <li><a href="#">Membership Agreement</a></li>
					  <li><a href="/assets/site/img/privacy-statement.pdf">Privacy Policy</a></li>
					  <li><a href="#">Sitemap</a></li>
					  <li><a href="#">Protection of Personal Use</a></li>
					  <li><a href="#">Help and Operation Guide</a></li>

				   </ul>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="color:#888">
                <?= SocialMediaListWidget::widget(['title' => t('app', 'Follow Us')]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0px">
              <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			    <div class="copyright">
				  <i class="footericon fa fa-phone " aria-hidden="true" style="float: left"></i> 
					<p align="left" style="font-weight: bold;position: relative;left:1rem;top:0.5rem">
						<span style="color:#B22222">24/7 Customer Service</span><br/>
					    +92 308 81204
					</p>	
				</div>	
			  </div>	  
			  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			    <div class="copyright">
				  <i class="footericon fa fa-question-circle " aria-hidden="true" style="float: left"></i> 
					<p align="left" style="font-weight: bold;position: relative;left:1rem;top:0.5rem">
						<span style="color:#B22222">Help Center</span><br/>
					    info@appcomsol.com
					</p>	
				</div>	
			  </div>
			  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			    <div class="copyright">
				  <img src="/assets/site/img/ios.png" alt="iOS" width="160" height="60">	
				</div>	
			  </div>
			  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			    <div class="copyright">
				  <img src="/assets/site/img/and.png" alt="Android" width="160" height="60">		
				</div>	
			  </div>
			</div>
        </div>
		<div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              	<div class="copyright">
                   <p align="justify" style="border: 2px #000 dashed;padding: 1rem;background-color: #fff; color: #000">All Content, opinions and information created by the users on appcomsol.com are correct, complete and unchangeable, and legal obligations regarding their publications belong to the user who created the content. appcomsol.com is in no way responsible for any inaccurate, omissions or violations of the rules regulated by the laws of this content, opinions and information. You can contact the advertisement owner for your questions.  </p>
                </div>
			  	
            </div>
        </div>
		
		<div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0px">
                
			  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="copyright">
                   <p align="left" style="color:#888";>Copyright &#169; 2020  appcomsol.com</p>
                </div>
			  </div>
			  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="copyright">
                   <p align="right" style="color:#888" ;>(*) For Individual members, in limited quantites, specific categories and specific offers</p>
                </div>
			  </div>	
            </div>
        </div>
    </div>

</footer>