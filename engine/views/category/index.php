<?php
use yii\widgets\ListView;
use yii\helpers\Html;
use app\helpers\SvgHelper;
use app\assets\AppAsset;
use app\components\AdsListWidget;

AppAsset::register($this);

$this->registerCssFile('../../../assets/site/css/sidebar-accordion.css',[yii\web\JqueryAsset::className()]);
$this->registerJsFile('https://code.jquery.com/jquery-3.4.1.min.js', [yii\web\JqueryAsset::className()]);
$this->registerJsFile('../../assets/site/js/sidebar-accordion.js', [yii\web\JqueryAsset::className()]); 

?>
<style>
* {
  box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
  float: left;
  width: 50%;
  padding: 10px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
/* Style the buttons */
.btn {
  border: none;
  outline: none;
  padding: 12px 16px;

  cursor: pointer;
  
}

.btn:hover {
  background-color: #ddd;
}

.btn.active {
  background-color: #666;
  color: white;
}


</style>

<style>
 .uiInlineBoxTitle h1 {
    font-size: 16px;
    font-weight: bold;
    line-height: 16px;
}

.uiInlineBoxTitle h1::after{
    display:none;
}
 .uiInlineBoxContent {
    padding: 10px 15px 10px 15px;
    border: 1px solid #eaeaea;
    
}
.uiInlineBoxContent ul {
    max-height:310px;
    overflow-y:auto;
}
.uiInlineBoxContent ul li {
    padding: 0;
}

.listings-list {
    margin-top:16px;
}

.uiInlineBoxContent ul li a {
    font-size: 13px;
    line-height: 23px;
    color: #039 !important;
    font-weight:700;
}

#category-listings li {
    float: left;
    width: 11%;
    max-height: 109px;
    padding: 7px 16px 5px 0;
    text-align: left;
    font-size: 11px;
    list-style:none;
}



#category-listings li a {
    color: #039 !important;
    font-weight:700;
}





#category-listings li img {
    display: block;
    border: 1px solid #e6e6e6;
    width: 100%;
    height: 78px;
    background: #f5f5f5;
    list-style:none;
}

#category-listings li span {
    width: 98%;
    display: block;
    white-space: nowrap;
    overflow: hidden;
    -o-text-overflow: ellipsis;
    text-overflow: ellipsis;
    max-height: 17px;
    line-height: 18px;
}
.vitrin-list {
    padding-left:0px;
}

@media screen and (max-width: 768px) {
    div.hh {
    display: none;
    }
    div.card-grid{
    display: block;
    align-items: center;
    border: 0px solid #1abc9c;
    margin: 5px 5px;
    width: 40%;
    max-width: 500px;
 }
 #category-listings li {
    float: left;
    width: 33%;
 }
}

</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<section class="listings-list">
    <div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="uiInlineBoxTitle">
            <h1><?= !empty($category) ? html_encode($category->name) : t('app', 'All categories'); ?></h1>
				<!-- child categories -->
                <?php if (!empty($childCategories)) { ?>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<?//= SvgHelper::getByName('arrow-top');?>
			
                            <div class="contenedor-menu uiInlineBoxContent" >
                                
								<ul class="menu" style="padding: 0px;width: 100%!important;font-weight: normal;position: relative;left:0.6rem;top:1rem">
							    <?php foreach ($childCategories as $childCat) 
									{ ?>		
									<li><?= Html::a(html_encode($childCat->name), ['category/index', 'slug' => $childCat->slug, $paramsSearch['key'] => $paramsSearch['ListingSearch']]) ?></li>
								<?php } ?>
								</ul>
								
							
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="mb10 col-lg-9  col-md-9 col-sm-9">
            <div class="hidden-xs">
                <?php app()->trigger('category.above.results', new \app\yii\base\Event()); ?>
            </div>
            <section class="main-search" style="background-image:url('../../assets/site/img/bg-live.png')!important;">
                <?= $this->render('_main-search', [
                    'categories'              => $categories,
                    'categoryPlaceholderText' => $categoryPlaceholderText,
                    'searchModel'             => $searchModel,
                    'customFields'            => $customFields,
                    'locationDetails'         => $locationDetails,
                    'selectedCategory'        => $category,
                    'advanceSearchOptions'    => $advanceSearchOptions
                ]); ?>
            </section>
            <?= ListView::widget([
                    'id'               => 'category-listings',
                    'dataProvider'     => $adsProvider,
                    'layout'           => '
                        <ul class="vitrin-list clearfix">
                            {items}
                        </ul>
                        <div class="row">
						    <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
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
                        'tag'   => 'li',
                        'class' => 'item',
                    ],
                    'emptyTextOptions' => ['tag' => 'ul', 'class' => 'list invoice'],
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
<div class="container">
    <div class="row">
        <div class="mobile-advert mb10 col-xs-12 hidden-lg hidden-md hidden-sm">
            <?php app()->trigger('mobile.category.above.results', new \app\yii\base\Event()); ?>
        </div>
    </div>
</div>
    <div class="container">
        <div class="row">
			<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
				
			</div>
			<div class="hh" id="btnContainer" style="float:right;margin-right:5px;display:none;">
			    <button class="btn active" onclick="gridView()"><i class="fa fa-th-large"></i> Grid</button>
                <button class="btn" onclick="listView()"><i class="fa fa-bars"></i> List</button> 
                <button class="btn" onclick="autoView()"><i class="fa fa-th"></i> Auto</button>
            </div>
            
        </div>
    </div>
</section>
<section class="others-listings">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php if ($isNothingFound) { ?>
                    <?= AdsListWidget::widget([
                        'listType'  => AdsListWidget::LIST_TYPE_PROMOTED,
                        'title'     => t('app', 'Other ads'),
                        'quantity'  => 6
                    ]);
                    ?>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<script>
// Get the elements with class="column"
var elements = document.getElementsByClassName("column");
for (i = 0; i < elements.length; i++) {
    elements[i].classList.add("card-grid");
  }

// Declare a loop variable
var i;

// Auto View
function autoView() {
  for (i = 0; i < elements.length; i++) {
    elements[i].style.width = "20%";
    elements[i].classList.remove("card-grid");
    elements[i].classList.remove("card-list");
    elements[i].classList.add("card-auto");
  }
  
}
// List View
function listView() {
  for (i = 0; i < elements.length; i++) {
    elements[i].style.width = "100%";
     elements[i].classList.remove("card-grid");
    elements[i].classList.add("card-list");
    elements[i].classList.remove("card-auto");
  }
}

// Grid View
function gridView() {
    for (i = 0; i < elements.length; i++) {
    elements[i].style.width = "50%";
    elements[i].classList.add("card-grid");
    elements[i].classList.remove("card-list");
    elements[i].classList.remove("card-auto");
  }
}

/* Optional: Add active class to the current button (highlight it) */
var container = document.getElementById("btnContainer");
var btns = container.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}
</script>
<style>


.card-grid{
    display: flex;
    align-items: center;
    border: 1px solid #1abc9c;
    margin: 10px 5px;
    width: 50%;
    max-width: 500px;
}
.card-list{
    display: flex;
    align-items: center;
    border: 1px solid #1abc9c;
    margin: 10px 5px;
    width: 50%;
}
.card-auto{
    border: 1px solid #1abc9c;
    margin: 10px;
    width: 20%;
}
.info.info-card {
    max-width: 360px;
    word-break: break-all;
}
.listings-list .item .info.info-card {
    min-height: 85px;
    max-width: 360px;
    word-break: break-all;
}
</style>
