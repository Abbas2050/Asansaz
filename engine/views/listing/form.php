<?php

use app\assets\AdAsset;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;
use dosamigos\ckeditor\CKEditor;
use app\helpers\FrontendHelper;
use yii\helpers\ArrayHelper;
use app\models\Currency;
use app\models\Country;
use yii\bootstrap\Html;

AdAsset::register($this);
$adsImagesNumber = (int)options()->get("app.settings.common.adsImagesLimit", 4);

$listing_id = (int)($action == 'update') ? $ad->listing_id : 0;
$category_id = (int)($action == 'update') ? $ad->category_id : 0;

$script = <<< JS
$(document).ready(function() {
    var actionMade ='$action';
    if(actionMade == 'update'){
        $(".category_items_panel").hide();
        $(".no-category-selected").hide();
        $('#success-selection').trigger('click');
        var categoryIdUpdate = '$category_id';
       
        $.post($('#category-fields').data('url'), {
                category_id: '$category_id',
                listing_id: '$listing_id',
            }, function (json) {
                if (json.html) {
                    $('.category-fields').show();
                    $('#category-fields').html(json.html);
                    $('#categortNextbutton').css("display", "block");
                    $('#listing-category_id').val(categoryIdUpdate);
                    $('select').select2({
                        width: '100%',
                        language: site.language,
                        dir: site.dir,
                    });
                } else {
                    $('.category-fields').hide();
                }
            }, 'json');
            
        
    }

    $('#post-form').yiiActiveForm('add',
        {
            "id":"listingimage-imagesgallery",
            "name":"imagesGallery[]",
            "container":".field-listingimage-imagesgallery",
            "input":"#listingimage-imagesgallery",
            "error":".help-block.help-block-error",
            "validate":function (attribute, value, messages, deferred) {
                if ($('.file-preview-frame').length == 0) {
                    yii.validation.required(value, messages, {"message": $('#post-form').data('err-msg-gallery')});
                }
                if ($('.file-preview-frame').length > 2*$adsImagesNumber) {
                    yii.validation.addMessage(messages, $('#post-form').data('err-msg-img-limit'), value);
                }
            }
        }
    );
}); 
JS;

$this->registerJs($script, yii\web\View::POS_LOAD);
?>
<style>
    .separator-text {
        margin: 0;
        margin-top: 20px;
    }

    .category_items {
        padding: 15px;
        box-shadow: 0 0 5px 0 rgb(0 0 0 / 30%);
        border-radius: 4px;
        width: 100%;
        height: 114px;
        float: left;
        margin-bottom: 16px;
        cursor: pointer;
        overflow: hidden;
        border-top: 5px #1abc9c solid;
        padding-top: 21px;
    }

    .category_items_icon {
        width: 38px;
        height: 38px;
        background: #1abc9c;
        padding: 8px;
        border-radius: 50%;
        display: block;
        margin: 0 auto;
        margin-bottom: 10px;
    }

    .category_items_icon .fa {
        color: #fff;
    }

    .choose-category .column-category {
        display: none;
    }

    .block-body-inner {
        box-shadow: 0 0 2px 0 rgb(0 0 0 / 10%);
        background: #fff;
        padding: 25px;
        margin-bottom: 30px;
        padding-bottom: 57px;
    }

    .post-listing {
        background: #f1f1f1;
    }

    .btn-primary, .btn-primary:hover, .btn-primary:focus {
        background: #1abc9c;
        border-color: #1abc9c;
    }

    #footer {
        margin-top: 1px !important;
    }

    .category_items_title {
        font-weight: bold;
    }
    
    .progressbar {
            counter-reset: step;
            font-family: 'Poppins', sans-serif;
            margin-bottom: 50px;
    }
    
    .progressbar li {
        list-style: none;
        display: inline-block;
        width: 23.7%;
        position: relative;
        text-align: center;
    }
    
    .progressbar li:before {
        content: counter(step);
        counter-increment: step;
        width: 30px;
        height: 30px;
        line-height: 30px;
        border: 1px solid #ddd;
        border-radius: 100%;
        display: block;
        text-align: center;
        margin: 0 auto 10px auto;
        background-color: #fff;
    }
    
    .progressbar li:after {
        content: "";
        position: absolute;
        width: 100%;
        height: 1px;
        background-color: #ddd;
        top: 15px;
        left: -50%;
        z-index: 0;
    }
    
    .progressbar li:first-child:after {
        content: none;
    }
    
    .progressbar li.active {
        color: #234D43;
    }
    
    .progressbar li.active:before {
        border-color: #234D43;
        background: #234D43;
        color: #fff;
    }
    
    
    .progressbar li.active + li:after {
        background-color: #234D43;
    }
    
    .progressbar li.active:before {
    }

    @media only screen and (max-width: 600px) {

        .progressbar {
            counter-reset: step;
            font-family: 'Poppins', sans-serif;
            margin-bottom: 0px;
        }


        .progressbar li {
            list-style: none;
            display: inline-block;
            width: 100%;
            position: relative;
            text-align: left;
        }

        .progressbar li span {
            padding-left: 15px;
        }

        .progressbar li:before {
            margin: 0;
            display: inline-block;
            margin-bottom: 20px;
        }


        .progressbar li:after {
            width: 30px;
            left: 0px;
            z-index: -1;
            top: -13px;
            transform: rotate(90deg);
        }

        .progressbar li.active:after {
            background-color: #234D43;
            counter-increment: none;

        }
    }

    .final_items h4 {
        position: absolute !important;
        height: 100px !important;
        width: 100px !important;
        background: #26a67c;
        border-radius: 50%;
        font-size: 50px !important;
        text-align: center;
        margin: 0 auto !important;
        color: #fff;
        left: 0;
        right: 0;
        top: 30px;
    }

    .final_items h4 i {
        font-size: 50px !important;
        color: #fff;
        margin-top: 15px !important;
        display: block;
    }

    #success-selection {
        display: block;
        margin: 0 auto;
        margin-top: 30px;
        border: 1px solid #438ed8;
        border-radius: 2px;
        color: #fff;
        background: #438ed8;
    }

    .final_items p {
        text-align: center;
        margin-top: 130px;
    }

    .column-category {
  
        box-shadow: 0 0 1px 1px #e2e2e2 !important;
        margin-right: 10px !important;
        margin-left: 1px !important;
        padding: 10px;
        background-color: #e5f0ff;
        border: 1px solid #b9d6ff !important;
    }

    .final_items {
        position: absolute !important;
        height: 312px;
    }

    .choose-category .column-category h4 {
        position: relative;
        display: table;
        height: 25px;
        width: 100%;
        font-family: 'Quicksand', sans-serif;
        font-size: 16px;
        text-transform: uppercase;
        margin: 0;
        padding: 10px 5px;

    }

    .choose-category .column-category ul li a {
        display: table;
        height: 25px;
    }

    .column-category {
    }
    
    .choose-category {
        min-height:auto !important;
    }

    .choose-category .column-category ul li a.subcateg {
        padding-left: 12px;
    }

    @media only screen and (min-width: 768px){
        .choose-category .column-subcategory .column-category {
            width: 200px !important;
        }
    }

    .choose-category .column-category ul li a.selected {
        background-color: #dedede;
        color:#000 !important;
    }

    .choose-category .column-category ul li a.selected:before {
        content: '';
        position: absolute;
        top: 3px;
        right: -8px;
        width: 19px;
        height: 19px;
        background-color: #dedede;
        -webkit-transform: rotate(
                45deg
        );
        -moz-transform: rotate(45deg);
        -o-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(
                45deg
        );
        border-radius: 2px;
    }

    .choose-category .column-category ul li a {
        width: 90%;
    }

    .choose-category .column-category ul li a.selected:focus, .choose-category .column-category ul li a.selected:active {
        background-color: #8598a9;
        color: #fff;
        z-index: 100;
    }

    .choose-category .column-category ul li a.selected:focus:before, .choose-category .column-category ul li a.selected:active:before {
        background-color: #8598a9;
    }

    .choose-category .column-category ul li a.selected .arrow {
        display: none !important;
    }

    .mCSB_scrollTools {
        display: none !important;
    }

</style>
<section class="post-listing <?= $action; ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php 
                $listing_id = (int)($action == 'update') ? $ad->listing_id : 0;
                $form = ActiveForm::begin([
                    'options' => [
                        'enctype' => 'multipart/form-data',
                        'data-listing' => $listing_id,
                        'data-err-msg-gallery' => t('app', 'Please add at least one image to your ad post'),
                        'data-err-msg-img-limit' => t('app', 'The number of uploaded images exceeds the maximum allowed limit of {limitNumber} images', [
                            'limitNumber' => $adsImagesNumber,
                        ]),
                        'data-custom-error'
                    ],
                    'id' => 'post-form',
                    'method' => 'post',
                ]); ?>
                <div class="block">
                    <div class="block-heading">
                        <div class="row">
                            <div class="col-lg-10 col-lg-push-1 col-md-10 col-md-push-1 col-sm-12 col-xs-12">
                                <h1><?= ($action == 'update') ? t('app', 'Update your ad') : t('app', 'Post your ad'); ?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="block-body">
                        <div class="row">
                            <div class="col-lg-10 col-lg-push-1 col-md-10 col-md-push-1 col-sm-12 col-xs-12">
                                
                                <ul class="progressbar">
                                    <li class="active" id="category_selection"><span class="text-inner-pro">Category Selection</span></li>
                                    <li id="listing_details"><span class="text-inner-pro">Listing Details</span></li>
                                    <li id="ad_preivew"><span class="text-inner-pro">Preivew</span></li>
                                    <li id="congratulations"><span class="text-inner-pro">Congratulations</span></li>
                                </ul>
                                <div class="block-body-inner">
                                    <!-- Category -->
                                    <div id="category-panel" class="category-select-area hide-panel-all">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="separator-text">
                                                    <span><?= t('app', 'Choose category'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div id="breadcrumbs">
                                            <?php 
                                                if($action == 'update'){
                                                    echo $breadCumData;
                                                }
                                            ?>
                                        </div>
                                        <div class="row category_items_panel" <?php if($action == 'update'){?> style="display:none" <?php }?>>
                                            <?php foreach ($categories as $category) {
                                                if (empty($category->parent_id)) { ?>
                                                    <div class="col-md-3">
                                                        <div  class="text-center category_items" id="<?= $category->category_id ?>">
                                                            <div class="category_items_icon"><i class="fa <?= html_encode($category->icon); ?>" aria-hidden="true"></i></div>
                                                            <div class="category_items_title"><?= html_encode($category->name); ?></div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                                                <div class="form-group hidden-lg hidden-md hidden-sm">
                                                    <a href="javascript:void(null);" id="choose-class-m" class="form-control choose-catg-m"><?= t('app', 'Choose category'); ?></a>
                                                </div>
                                                <?= $form->field($ad, 'category_id', [
                                                    'template' => '{input} {error}',
                                                ])->hiddenInput(['class' => 'form-control'])->label(false); ?>
                                            </div>
                                        </div>
                                        <div class="choose-category">
                                            <div class="column-category primary-category">
                                                <h4><?= t('app', 'Categories'); ?></h4>
                                                <div class="category-items mCustomScrollbar mCS-autoHide">
                                                    <ul>
                                                        <?php foreach ($categories as $category) {
                                                            if (empty($category->parent_id)) { ?>
                                                                <li>
                                                                    <a href="#" data-id="<?= (int)$category->category_id; ?>">
                                                                        <span><i class="fa <?= html_encode($category->icon); ?>" aria-hidden="true"></i></span>
                                                                        <span><?= html_encode($category->name); ?></span>
                                                                    </a>
                                                                </li>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="column-subcategory mCustomScrollbar mCS-autoHide">
                                                <div class="column-subcategory-wrapper">
                                                    <?php $sortedCategories = \app\helpers\FrontendHelper::getCategoriesSorted($categories);
                                                    foreach ($sortedCategories as $sortedCategoryId => $sortedCategory) { ?>
                                                        <div class="column-category" data-parent="<?= (int)$sortedCategoryId; ?>" style="display: none">
                                                            <h4><?= html_encode($sortedCategory['name']); ?></h4>
                                                            <div class="category-items mCustomScrollbar mCS-autoHide">
                                                                <ul>
                                                                    <?php foreach ($sortedCategory['children'] as $childCategory) { ?>
                                                                        <li>
                                                                            <a href="#" data-id="<?= (int)$childCategory->category_id; ?>" class="subcateg">
                                                                                <span><?= html_encode($childCategory->name); ?></span>
                                                                            </a>
                                                                        </li>
                                                                    <?php } ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="column-category final_items" style="display: none">
                                                        <h4 style=""><i class="fa fa-check"></i></h4>
                                                        <div class="category-items mCustomScrollbar mCS-autoHide">
                                                            <p>lorem ipsum isnds sdflkj sdfjsdflj asldjs jadsflskjd</p>
                                                            <button id="success-selection" style='display:none;' type="button" class="btn-as">Next</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="choose-category-mobile">
                                            <a href="#" class="close-x-categ-m"><i class="fa fa-times" aria-hidden="true"></i></a>
                                            <div class="maincateg-m">
                                                <div class="heading">
                                                    <a href="#" class="close-categ-m"><i class="fa fa-arrow-left" aria-hidden="true"></i></a> <?= t('app', 'Choose category'); ?>
                                                </div>
                                                <ul class="categ-items">
                                                    <?php foreach ($categories as $category) {
                                                        if (empty($category->parent_id)) { ?>
                                                            <li>
                                                                <a href="#" data-id="<?= (int)$category->category_id; ?>" class="categ-item-m" data-subcateg="<?= (!empty($category->children)) ? html_encode($category->slug) : ''; ?>">
                                                                    <span><i class="fa <?= html_encode($category->icon); ?>" aria-hidden="true"></i></span>
                                                                    <span><?= html_encode($category->name); ?></span>
                                                                </a>
                                                            </li>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                            <?php $sortedCategories = FrontendHelper::getCategoriesSorted($categories);
                                            foreach ($sortedCategories as $sortedCategoryId => $sortedCategory) { ?>
                                                <div id="subcateg-<?= html_encode($sortedCategory['slug']); ?>" class="subcateg-m">
                                                    <div class="heading">
                                                        <a href="#" data-parent="<?= (int)$sortedCategoryId; ?>" class="back-categ-m">
                                                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                                        </a>
                                                        <?= html_encode($sortedCategory['name']); ?>
                                                    </div>
                                                    <ul class="categ-items">
                                                        <?php foreach ($sortedCategory['children'] as $childCategory) { ?>
                                                            <li>
                                                                <a href="#" data-id="<?= (int)$childCategory->category_id; ?>" data-subcateg="<?= (!empty($childCategory->children)) ? html_encode($childCategory->slug) : ''; ?>" class="categ-subitem-m">
                                                                    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                                                    <?= html_encode($childCategory->name); ?>
                                                                </a>
                                                            </li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="row category-fields" style="display: none">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="separator-text">
                                                    <span><?= t('app', 'Category Fields'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row category-fields" id="category-fields" data-url="<?= url(['/listing/get-category-fields']); ?>" style="display: none">

                                        </div>
                                        <br>
                                        <span <?php if($action == 'update'){?> style="display:none;" <?php } ?> class="no-category-selected"><?= t('app', 'Please select a specific category'); ?></span>

                                        <a href="javascript:void(0)" id="categortNextbutton" class="btn btn-primary" onclick="nextprefun('title-panel','category-panel')" style="display:none;float:right;">Next</a>
                                    </div>
                                    <!-- Category -->


                                    <!-- Title Description -->
                                    <div id="title-panel" style="display:none;" class="hide-panel-all">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="separator-text">
                                                    <span>Ad Description</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <?= $form->field($ad, 'title', [
                                                    'template' => '{input} {error}',
                                                ])->textInput(['placeholder' => t('app', 'Title'), 'class' => 'form-control'])->label(false); ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <?= $form->field($ad, 'description')->widget(CKEditor::className(), [
                                                    'options' => ['rows' => 6],
                                                    'preset' => 'basic',
                                                    'clientOptions' => [
                                                        'removePlugins' => 'pastefromword, tableselection',
                                                        'contentsCss' => [Yii::getAlias('@web/assets/site/css/customCkeditor.css')],
                                                        'toolbar' => ['clipboard', 'cut, copy, paste'],
                                                    ]
                                                ])->label(); ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="separator-text">
                                                    <span><?= t('app', 'Price'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <?php $currencyNumber = count(ArrayHelper::map(Currency::getActiveCurrencies(), 'currency_id', 'name')); ?>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <?php if ($currencyNumber > 1) { ?>
                                                    <?= $form->field($ad, 'currency_id', [
                                                        'template' => '{input} {error}',
                                                    ])->dropDownList(ArrayHelper::map(Currency::getActiveCurrencies(), 'currency_id', 'name'), ['class' => '', 'prompt' => t('app', 'Currency')])->label(false);
                                                } else { ?>
                                                    <?= $form->field($ad, 'currency_id', [
                                                        'template' => '{input} {error}',
                                                        'options' => ['style' => 'display:none'],
                                                    ])->hiddenInput(['value' => Currency::getActiveCurrencies()[0]->currency_id, 'class' => 'form-control'])->label(false); ?>
                                                    <?= $form->field($ad, 'currency_id', [
                                                        'template' => '{input} {error}',
                                                    ])->dropDownList(ArrayHelper::map(Currency::getActiveCurrencies(), 'currency_id', 'name'), ['value' => Currency::getActiveCurrencies()[0]->currency_id, 'class' => '', 'prompt' => t('app', 'Currency'), 'disabled' => true])->label(false);
                                                } ?>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <?= $form->field($ad, 'price', [
                                                    'template' => '{input} {error}',
                                                ])->textInput(['placeholder' => t('app', 'Price'), 'class' => 'form-control'])->label(false); ?>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <?= $form->field($ad, 'negotiable', [
                                                    'options' => [
                                                        'class' => 'checkbox'
                                                    ],
                                                ])->checkbox(['template' => '{input} {label}'], ['value' => false]); ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="separator-text">
                                                    <span><?= t('app', 'Contact details'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <?= $form->field($customer, 'phone', [
                                                    'template' => '{input} {error}',
                                                ])->textInput(['placeholder' => t('app', 'Phone'), 'class' => 'form-control'])->label(false); ?>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <?= $form->field($ad, 'hide_phone', [
                                                    'options' => [
                                                        'class' => 'checkbox'
                                                    ],
                                                ])->checkbox(['template' => '{input} {label}'], ['value' => false]); ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <?= $form->field($customer, 'email', [
                                                    'template' => '{input} {error}',
                                                ])->textInput(['placeholder' => t('app', 'Email Address'), 'class' => 'form-control'])->label(false); ?>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <?= $form->field($ad, 'hide_email', [
                                                    'options' => [
                                                        'class' => 'checkbox'
                                                    ],
                                                ])->checkbox(['template' => '{input} {label}'], ['value' => false]); ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <?php $countryNumber = count(ArrayHelper::map(Country::getActiveCountries(), 'country_id', 'name')); ?>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <?php if ($countryNumber > 1) { ?>
                                                    <?= $form->field($location, 'country_id', [
                                                        'template' => '{input} {error}',
                                                    ])->dropDownList(ArrayHelper::map(Country::getActiveCountries(), 'country_id', 'name'), ['class' => '', 'prompt' => t('app', 'Country'),])->label(false);
                                                } else { ?>
                                                    <?= $form->field($location, 'country_id', [
                                                        'template' => '{input} {error}',
                                                        'options' => ['style' => 'display:none'],
                                                    ])->hiddenInput(['value' => Country::getActiveCountries()[0]->country_id, 'class' => 'form-control'])->label(false); ?>
                                                    <?= $form->field($location, 'country_id', [
                                                        'template' => '{input} {error}',
                                                    ])->dropDownList(ArrayHelper::map(Country::getActiveCountries(), 'country_id', 'name'), ['value' => Country::getActiveCountries()[0]->country_id, 'class' => '', 'prompt' => t('app', 'Country'), 'disabled' => true])->label(false);
                                                } ?>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="listing-select-zones-wrapper" data-url="<?= url(['/listing/get-country-zones']); ?>" data-zone= <?= (int)$location->zone_id; ?>>
                                                <?= $form->field($location, 'zone_id', [
                                                    'template' => '{input} {error}',
                                                ])->dropDownList(array(), ['class' => '', 'prompt' => t('app', 'Zone')])->label(false); ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <?= $form->field($location, 'city', [
                                                    'template' => '{input} {error}',
                                                ])->textInput(['placeholder' => t('app', 'City'), 'class' => 'form-control'])->label(false); ?>
                                            </div>
                                            <?php if (options()->get('app.settings.common.adHideZip', 'en') == 0) { ?>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <?= $form->field($location, 'zip', [
                                                        'template' => '{input} {error}',
                                                    ])->textInput(['placeholder' => t('app', 'Zip code'), 'class' => 'form-control'])->label(false); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" <?php if (options()->get('app.settings.common.disableMap', 0) == 1) { ?>  style="display: none" <?php } ?>>
                                                <div id="map-content" style="height: 414px; background-color: #eeebe8; filter: blur(10px);
                                            -webkit-filter: blur(5px);
                                            -moz-filter: blur(5px);
                                            -o-filter: blur(5px);
                                            -ms-filter: blur(5px);"></div>
                                                <script src="https://maps.googleapis.com/maps/api/js?key=<?= html_encode(options()->get('app.settings.common.siteGoogleMapsKey', '')); ?>&callback"></script>
                                            </div>
                                            <?php if (options()->get('app.settings.common.disableMap', 0) == 0) { ?>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <?= $form->field($location, 'latitude', [
                                                        'template' => '{input} {error}',
                                                    ])->hiddenInput()->label(false); ?>
                                                    <?= $form->field($location, 'longitude', [
                                                        'template' => '{input} {error}',
                                                        'options' => ['style' => 'display:none'],
                                                    ])->hiddenInput()->label(false); ?>
                                                </div>
                                            <?php } ?>
                                            <?= Html::hiddenInput('disableMap', options()->get('app.settings.common.disableMap', 0), [
                                                'id' => 'disableMap'
                                            ]) ?>

                                            <?= Html::hiddenInput('adHideZip', options()->get('app.settings.common.adHideZip', 0), [
                                                'id' => 'adHideZip'
                                            ]) ?>
                                        </div>
                                        <a href="javascript:void(0)" class="btn btn-primary" onclick="nextprefun('photo-panel','title-panel')" style="float:right;">Next</a>&nbsp;
                                        <a href="javascript:void(0)" class="btn btn-primary" onclick="nextprefun('category-panel','title-panel',true)" style="float:right;">Previous</a>
                                    </div>
                                    <!-- Title Description -->


                                    <!-- price -->
                                    <!--<div id="price-panel" style="display:none;" class="hide-panel-all">-->
                                        
                                    <!--    <a href="javascript:void(0)" class="btn btn-primary" onclick="nextprefun('contact-panel','price-panel')" style="float:right;">Next</a>&nbsp;-->
                                    <!--    <a href="javascript:void(0)" class="btn btn-primary" onclick="nextprefun('title-panel','price-panel',true)" style="float:right;">Previous</a>-->
                                    <!--</div>-->
                                    <!-- price -->


                                    <!-- contact detail -->
                                    <!--<div id="contact-panel" style="display:none;" class="hide-panel-all">-->
                                        
                                    <!--    <a href="javascript:void(0)" class="btn btn-primary" onclick="nextprefun('photo-panel','contact-panel')" style="float:right;">Next</a>&nbsp;-->
                                    <!--    <a href="javascript:void(0)" class="btn btn-primary" onclick="nextprefun('price-panel','contact-panel',true)" style="float:right;">Previous</a>-->
                                    <!--</div>-->
                                    <!-- contact detail -->


                                    <!-- Photo -->
                                    <div id="photo-panel" style="display:none;" class="hide-panel-all">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="separator-text">
                                                    <span><?= t('app', 'Photo Gallery'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <?= $form->field($images, 'image_form_key', [
                                                    'template' => '{input} {error}',
                                                    'options' => ['style' => 'display:none'],
                                                ])->hiddenInput(['value' => $image_random_key, 'class' => 'form-control'])->label(false); ?>
                                                <?php
                                                $imageRestrictionsSize = $images->getAdsImageRestrictionsSize();
                                                $imagesPreview = [];
                                                $imagesPreviewConfig = [];
                                                if ($action == 'update') {
                                                    // sort for images sort_order
                                                    usort($uploadedImages, function ($a, $b) {
                                                        return strnatcmp($a['sort_order'], $b['sort_order']);
                                                    });
                                                    if ($uploadedImages) foreach ($uploadedImages as $key => $image) {
                                                        $imagesPreview[] = $image->image;
                                                        $imagesPreviewConfig[$key]['caption'] = $image->image;
                                                        $imagesPreviewConfig[$key]['url'] = url(['/listing/remove-ad-image']);
                                                        $imagesPreviewConfig[$key]['key'] = $image->image_id;
                                                    }
                                                }
                                                echo $form->field($images, 'imagesGallery[]')->widget(FileInput::classname(), [
                                                    'options' => [
                                                        'multiple' => true,
                                                        'accept' => 'image/*', 'video/*',
                                                        'class' => 'file-loading',
                                                        'data-sort-listing-images' => url(['/listing/sort-ad-images']),
                                                        'data-get-sorted-images' => url(['/listing/get-sorted-images']),
                                                        'data-upload-url' => url(['/listing/upload-image']),
                                                        'data-remove-image' => url(['/listing/remove-ad-image']),
                                                        'data-browse' => t('app', 'Browse ...'),
                                                        'data-select-files' => t('app', 'Select files...'),
                                                        'data-action' => $action,
                                                        'data-ad-id' => $ad->listing_id,
                                                        'data-preview-data' => $imagesPreview,
                                                        'data-preview-config' => $imagesPreviewConfig,
                                                    ],
                                                    'pluginOptions' => [
                                                        'initialPreview' => $imagesPreview,
                                                        'initialPreviewConfig' => $imagesPreviewConfig,
                                                        'initialPreviewAsData' => true,
                                                        'language' => html_encode(options()->get('app.settings.common.siteLanguage', 'en')),
                                                        'uploadUrl' => url(['/listing/upload-image']),
                                                        'uploadExtraData' => [
                                                            'image_form_key' => $image_random_key,
                                                            'action' => $action,
                                                            'adId' => $ad->listing_id,
                                                        ],
                                                        'uploadAsync' => true,
                                                        'maxFileSize' => $imageRestrictionsSize,
                                                        'msgSizeTooLarge' => t('app', 'File "{name}" ({size} KB) exceeds maximum allowed upload size of {maxSize} KB. Please retry your upload!'),
                                                        'allowedFileExtensions' => ['png', 'jpg', 'jpeg', ',mp3', 'mp4', 'MPEG-4', 'WMV', 'FLV', 'AVI', 'WebM'],
                                                        'showUpload' => false,
                                                        'showRemove' => false,
                                                        'showClose' => false,
                                                        'browseOnZoneClick' => true,
                                                        'dropZoneEnabled' => false,
                                                        'browseLabel' => t('app', 'Browse ...'),
                                                        'browseClass' => 'btn btn-as',
                                                        'removeClass' => 'btn btn-as reverse',
                                                        'uploadClass' => 'btn btn-as reverse',
                                                        'msgPlaceholder' => t('app', 'Select files...'),
                                                        'captionClass' => [
                                                            'height' => '100px'
                                                        ],
                                                        'layoutTemplates' =>
                                                            [
                                                                'fileIcon' => '',
                                                                'footer' => '<div class="file-thumbnail-footer">' . '{progress} {actions}' . '</div>'
                                                            ],
                                                        'fileActionSettings' => [
                                                            'showUpload' => false,
                                                            'showDrag' => true,
                                                        ],
                                                        'overwriteInitial' => false,
                                                    ]
                                                ])->label(false);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="block">
                                            <div class="block-body">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <?php if ($action == 'create' || $ad->status != \app\models\Listing::STATUS_ACTIVE) { ?>
                                                            <div class="a-center">
                                                                <!--<button type="submit" name="process[package]" class="btn-as"><?= t('app', 'Submit'); ?></button>-->
                                                                <a href="javascript:void(0)" class="btn btn-primary" onclick="nextprefun('title-panel','photo-panel',true)" style='height: 41px;line-height: 30px;'>Previous</a>
                                                                <button type="submit" name="process[preview]" class="btn-as danger-action"><?= t('app', 'Next'); ?></button>
                                                            </div>
                                                        <?php } else { ?>
                                                            <div class="a-center">
                                                                <button type="submit" name="process[update-info]" class="btn-as"><?= t('app', 'Update Ad Info'); ?></button>
                                                                <?php if (options()->get('app.settings.common.skipPackages', 0) == 0) { ?>
                                                                    <button type="submit" name="process[package]" class="btn-as"><?= t('app', 'Update Ad Package'); ?></button>
                                                                <?php } ?>
                                                                <button type="submit" name="process[preview]" class="btn-as danger-action"><?= t('app', 'Next'); ?></button>
                                                                <a href="javascript:void(0)" class="btn btn-primary" onclick="nextprefun('title-panel','photo-panel',true)" style='height: 41px;line-height: 30px;'>Previous</a>
                                                            </div>
                                                        <?php } ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Photo -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Submit Button -->

                <!-- Submit Button -->
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>

<script>
    
         

    function nextprefun(showp, current, isprevious = false) {
        var isValid = true;
        if (isprevious == false) {
            $('#' + current + ' input,#' + current + ' textarea,#' + current + ' select').filter('[required]').each(function () {
                if ($(this).val() === '') {
                    console.log(this);
                    $('#confirm').prop('disabled', true)
                    isValid = false;
                }
            });
            $('#' + current + ' .required input,#' + current + ' .required textarea,#' + current + ' .required select').each(function () {
                // alert($(this).val());
                if ($(this).val() === '') {
                    console.log(this);
                    $('#confirm').prop('disabled', true)
                    isValid = false;
                }
            });
        }
        if (isValid) {
            $('.hide-panel-all').hide()
            $('#' + showp).show();
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        } else {
            alert('Please filled all required fields');
        }

    }
    
    
</script>