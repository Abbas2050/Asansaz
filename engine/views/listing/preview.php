<?php

use app\assets\AdAsset;
use app\helpers\SvgHelper;
use app\models\ListingStat;
use app\models\Category;
use app\components\AdsListWidget;
use app\components\SendMessageWidget;
use \app\yii\base\Event;

AdAsset::register($this);

$showGalleryArrows = (count($images) > 1) ? true : false;
$fullWidthGallery = (count($images) < 4) ? 'full-width' : '';
?>
<style>
    #newCategories {
        display: none;
    }

    .progressbar {
        counter-reset: step;
        font-family: 'Poppins', sans-serif;
        margin-bottom: 30px;
    }

    .progressbar li {
        list-style: none;
        display: inline-block;
        width: 24.7%;
        position: relative;
        text-align: center;
    }

    .progressbar li:before {
        content: counter(step);
        counter-increment: step;
        width: 30px;
        height: 30px;
        font-weight: bold;
        line-height: 26px;
        border: 2px solid #ddd;
        border-radius: 100%;
        display: block;
        text-align: center;
        margin: 0 auto 12px auto;
        color: #b9b7b7;
    }

    .progressbar li:after {
        content: "";
        position: absolute;
        width: 92%;
        height: 3px;
        background-color: #ddd;
        top: 14px;
        left: -47%;
        z-index: 0;
    }

    .progressbar li:first-child:after {
        content: none;
    }

    .progressbar li.active {
        color: #438ed8;
    }

    .progressbar li.active:before {
        background: transparent;
        color: #438ed8;
        border: 2px solid #438ed8;
    }


    .progressbar li.active + li:after {
        background-color: #438ed8;
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
            background-color: #438ed8;
            counter-increment: none;

        }

    }

    .inforbar {
        text-align: center;
        font-weight: bold;
    }

    .btn-edit {
        background: #fff;
        box-shadow: 0 0 10px 1px #e2e2e2;
        color: #438ed8;
        display: inline-block;
        padding: 10px 15px;
        border-radius: 4px;
        margin: 10px;
        font-weight: bold;
    }

    .btn-continue {
        background: #438ed8;
        box-shadow: 0 0 1px 1px #438ed8;
        color: #fff;
        display: inline-block;
        padding: 10px 15px;
        border-radius: 4px;
        margin: 10px;
        font-weight: bold;
    }

    .preview_box {
        border: 3px solid #8a8a8a;
    }

    .triangle-down {
        width: 0;
        height: 0;
        border-left: 25px solid transparent;
        border-right: 25px solid transparent;
        border-top: 25px solid #8a8a8a;
        display: block;
        margin: 0 auto;
    }

    .triangle-up {
        width: 0;
        height: 0;
        border-left: 25px solid transparent;
        border-right: 25px solid transparent;
        border-bottom: 25px solid #8a8a8a;
        display: block;
        margin: 0 auto;
    }

    .breadcrumb {
        background: rgb(242, 242, 242);
        background: linear-gradient(201deg, rgba(242, 242, 242, 1) 35%, rgba(255, 255, 255, 1) 100%);
        margin-bottom: 0px;
    }

    .breadcrumb li a {
        font-family: 'Quicksand', sans-serif;
        color: #292929;
        text-decoration: none;
        text-transform: uppercase;
        padding: 5px 0 4px 40px;
        position: relative;
        display: block;
        float: left;
        background: transparent;
        min-height: 25px;

    }

    .preview_box_inner {
        font-family: 'Poppins', sans-serif;
        padding: 10px;
        border-bottom: 1px solid #e2e2e2;
    }

    .preview_box_inner_title {
        font-size: 18px;
        font-family: 'Poppins', sans-serif;
    }

    .add_to_favorites a {
        font-family: 'Poppins', sans-serif;
        padding-right: 10px !important;
        padding-left: 5px !important;
        font-weight: bold;
    }

    .preview_box_inner_2 {
        font-family: 'Poppins', sans-serif;
        padding: 10px;
    }

    .bottom-border {
        font-family: 'Poppins', sans-serif;
        border-bottom: 1px solid #e2e2e2;
        font-size: 12px;
    }
    .bottom-border div {
        padding: 4px;
    }

    .view-listing .listing-info {
        padding: 4px;
    }

    .view-listing .listing-info .listing-user {
        font-family: 'Poppins', sans-serif;
        padding: 6px 6px;
        padding-left: 10px;
        background-color: #efefef;
    }

    @media only screen and (min-width: 768px){
        .view-listing .listing-info .listing-user div.name {
            font-size: 18px;
            font-weight: bold;
        }

        .view-listing .listing-info .listing-user div.email:before, .view-listing .listing-info .listing-user div:before , .view-listing .listing-info .listing-user div {
            font-size: 13px;
            font-weight: bold;
            margin-top: 5px;
        }
    }
</style>
<div class="view-listing">
    <section class="listing-heading preview" style="display: none">
        <div class="listing-heading-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="price">
                            <div class="social-mobile">
                                <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= url(['/listing/index/', 'slug' => $ad->slug], true); ?>" class="social-link track-stats" data-listing-id="<?= (int)$ad->listing_id; ?>" data-stats-type="<?= ListingStat::FACEBOOK_SHARES; ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a target="_blank" href="https://twitter.com/intent/tweet?text=<?= html_encode($ad->title); ?>&url=<?= url(['/listing/index/', 'slug' => $ad->slug], true); ?>" class="social-link track-stats" data-listing-id="<?= (int)$ad->listing_id; ?>" data-stats-type="<?= ListingStat::TWITTER_SHARES; ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a href="mailto:?subject=<?= html_encode($ad->title); ?>&body=<?= t('app', 'Read More:'); ?><?= url(['/listing/index/', 'slug' => $ad->slug], true); ?>" class="social-link track-stats" data-listing-id="<?= (int)$ad->listing_id; ?>" data-stats-type="<?= ListingStat::MAIL_SHARES; ?>"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
                            </div>
                            <h2><?= html_encode($ad->getPriceAsCurrency($ad->currency->code)); ?><span><?= $ad->isNegotiable() ? t('app', 'Negotiable') : ''; ?></span></h2>
                        </div>
                        <div class="actions hidden-lg hidden-md hidden-sm">
                            <a href="<?= url(['/listing/update/', 'slug' => $ad->slug]); ?>" class="btn-as danger-action">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i><?= t('app', 'Revise'); ?></a>
                            <a href="<?= url(['/listing/package/', 'slug' => $ad->slug]); ?>" class="btn-as">
                                <i class="fa fa-check" aria-hidden="true"></i><?= t('app', 'Finish'); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <br>
                <br>
                <ul class="progressbar">
                    <li class="active" id="category_selection"><span class="text-inner-pro">Category Selection</span></li>
                    <li class="active" id="listing_details"><span class="text-inner-pro">Listing Details</span></li>
                    <li class="active" id="ad_preivew"><span class="text-inner-pro">Preivew</span></li>
                    <li id="congratulations"><span class="text-inner-pro">Congratulations</span></li>
                </ul>
                <p class="inforbar">If the following information about your ad is correct, click on to the "Continue" button and move on to the next step.<br>if not then click the edit button.</p>
                <br>
                <br>
                <div style="margin:0 auto;display:block;text-align:center">
                    <a href="<?= url(['/listing/update/', 'slug' => $ad->slug]); ?>" class="btn-edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;<?= t('app', 'Edit'); ?></a>
                    <a href="<?= url(['/listing/package/', 'slug' => $ad->slug]); ?>" class="btn-continue"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;<?= t('app', 'Continue'); ?></a>

                </div>
                <br>
                <div class="triangle-up"></div>
                <div class="preview_box">
                    <ul class="breadcrumb">
                        <li><a href="<?= url(['/']); ?>"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <?php $_categoryParents = Category::getAllParents($ad->category_id);
                        $categoryParents = array_reverse($_categoryParents);
                        foreach ($categoryParents as $categoryParent) { ?>
                            <li>
                                <a href="<?= url(['category/index', 'slug' => $categoryParent['slug']]); ?>">
                                    <?= html_encode($categoryParent['name']); ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                    <div class="preview_box_inner">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="preview_box_inner_title"><b><?= html_encode(mb_strtoupper($ad->title, 'UTF-8')); ?></b></h1>
                            </div>
                            <div class="col-md-6 text-right add_to_favorites">
                                <a href="#" class="link add-to-favorites favorite-listing " data-stats-type="<?= ListingStat::FAVORITE; ?>" data-add-msg="<?= t('app', 'Add to favorites'); ?>" data-remove-msg="<?= t('app', 'Remove Favorite'); ?>" data-favorite-url="<?= url(['/listing/toggle-favorite']); ?>" data-listing-id="<?= (int)$ad->listing_id; ?>">
                                    <?php if ($ad->isFavorite) { ?>
                                        <i class="fa fa-heart" aria-hidden="true"></i> <span><?= t('app', 'Remove Favorite'); ?></span>
                                    <?php } else { ?>
                                        <i class="fa fa-heart-o" aria-hidden="true"></i> <span><?= t('app', 'Add to favorites'); ?></span>
                                    <?php } ?>
                                </a>
                                <a href="#send-message-widget" class="link send-message"><i class="fa fa-envelope-o" aria-hidden="true"></i> <?= t('app', 'Send a message'); ?></a>
                                <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= url(['/listing/index/', 'slug' => $ad->slug], true); ?>" class="social-link track-stats" data-listing-id="<?= (int)$ad->listing_id; ?>" data-stats-type="<?= ListingStat::FACEBOOK_SHARES; ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a target="_blank" href="https://twitter.com/intent/tweet?text=<?= html_encode($ad->title); ?>&url=<?= url(['/listing/index/', 'slug' => $ad->slug], true); ?>" class="social-link track-stats" data-listing-id="<?= (int)$ad->listing_id; ?>" data-stats-type="<?= ListingStat::TWITTER_SHARES; ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a href="mailto:?subject=<?= html_encode($ad->title); ?>&body=<?= t('app', 'Read More:'); ?><?= url(['/listing/index/', 'slug' => $ad->slug], true); ?>" class="social-link track-stats" data-listing-id="<?= (int)$ad->listing_id; ?>" data-stats-type="<?= ListingStat::MAIL_SHARES; ?>"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="preview_box_inner_2">
                        <div class="row">
                            <div class="col-md-6">
                                <div dir="ltr" class="listing-gallery">
                                    <div dir="ltr" class="img-wrapper <?= $fullWidthGallery; ?>">
                                        <span dir="ltr" class="zoom"><i dir="ltr" class="fa fa-search-plus" aria-hidden="true"></i></span>
                                        <div dir="ltr" class="small-gallery owl-carousel owl-theme">
                                            <?php foreach ($images as $image) { ?>
                                                <div dir="ltr" class="item open-full-gallery"><img dir="ltr" class="resizeImg" src="<?= $image->image; ?>" alt=""/></div>
                                            <?php } ?>
                                        </div>
                                        <?php if ($showGalleryArrows) { ?>
                                            <a href="javascript:;" class="arrow-gallery gallery-left"><?= SvgHelper::getByName('arrow-left'); ?></a>
                                            <a href="javascript:;" class="arrow-gallery gallery-right"><?= SvgHelper::getByName('arrow-right'); ?></a>
                                        <?php } ?>
                                    </div>
                                    <div dir="ltr" class="thb-wrapper">
                                        <span dir="ltr" class="zoom"><i dir="ltr" class="fa fa-search-plus" aria-hidden="true"></i></span>
                                        <ul>
                                            <?php $counterImage = 0;
                                            foreach ($images as $image) {
                                                $counterImage++;
                                                if ($counterImage == 1) continue; ?>
                                                <li><img dir="ltr" class="" src="<?= $image->image; ?>" alt=""/></li>
                                                <?php if ($counterImage == 4) break;
                                            } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <?php if (!empty($ad->categoryFieldValues)) {
                                    $labelValueFields = [];
                                    foreach ($ad->categoryFieldValues as $field) {
                                        if ($field->field->type->name != 'checkbox' && $field->field->type->name != 'url' && !empty($field->value)) {
                                            $labelValueFields[] = $field;
                                        }
                                    }
                                    if ($labelValueFields) { ?>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="listing-custom labels">
                                                    <?php foreach ($labelValueFields as $field) { ?>
                                                        <div class="row bottom-border">
                                                            <div class="col-md-6 text-left">
                                                                <b><?= html_encode($field->field->label); ?></b>
                                                            </div>
                                                            <div class="col-md-6 text-right">
                                                                <?= html_encode($field->value); ?> <?= ($field->field->unit) ? html_encode($field->field->unit) : ''; ?>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="row bottom-border">
                                                        <div class="col-md-6 text-left">
                                                            <b>Listing Date</b>
                                                        </div>
                                                        <div class="col-md-6 text-right">
                                                            <?= $ad->getUpdatedDateAsDateTimeFull(); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                                <?php if (!empty($ad->categoryFieldValues)) {
                                    $checkboxFields = [];
                                    foreach ($ad->categoryFieldValues as $field) {
                                        if ($field->field->type->name == 'checkbox' && $field->value != 0) {
                                            $checkboxFields[] = $field;
                                        }
                                    }
                                    if ($checkboxFields) { ?>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="separator-text"></div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="listing-custom">
                                                    <?php foreach ($checkboxFields as $field) { ?>
                                                        <div class="item"><?= html_encode($field->field->label); ?></div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    $urlFields = [];
                                    foreach ($ad->categoryFieldValues as $field) {
                                        if ($field->field->type->name == 'url' && $field->value !== '') {
                                            $urlFields[] = $field;
                                        }
                                    }
                                    if ($urlFields) { ?>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="separator-text">
                                                    <span><?= t('app', 'Links'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="listing-custom labels">
                                                    <?php foreach ($urlFields as $field) { ?>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="item labeled url">
                                                                <ul>
                                                                    <li><span><?= html_encode($field->field->label); ?></span></li>
                                                                    <li><span><a href="<?= $field->value ?>" target="_blank"><?= html_encode($field->value); ?></a></span></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }

                                }
                                ?>
                            </div>
                            <div class="col-md-3">
                                <div class="listing-info">
                                    <div class="listing-user">
                                        <div class="name">
                                            <?php if (empty($ad->customer->stores)) {
                                                echo html_encode($ad->customer->getFullName());
                                            } else { ?>
                                                <a href="<?= url(['/store/index', 'slug' => $ad->customer->stores->slug]); ?>">
                                                    <?= html_encode($ad->customer->stores->store_name); ?>
                                                </a>
                                            <?php } ?>
                                        </div>
                                        <?php if (!empty($ad->customer->stores)) { ?>
                                            <div class="store">
                                                <a href="<?= url(['/store/index', 'slug' => $ad->customer->stores->slug]); ?>">
                                                    <?= t('app', 'Visit Store'); ?>
                                                </a>
                                            </div>
                                        <?php } ?>
                                        <?php if (!$ad->hide_phone) { ?>
                                            <div class="phone"><a href="#" id="listing-show-phone" class="track-stats" data-stats-type="<?= ListingStat::SHOW_PHONE; ?>" data-listing-id="<?= (int)$ad->listing_id; ?>" data-url="<?= url(['/listing/get-customer-contact']); ?>" data-customer-id="<?= (int)$ad->customer->customer_id; ?>"><?= t('app', 'Show Number'); ?></a></div>
                                        <?php } ?>
                                        <?php if (!$ad->hide_email) { ?>
                                            <div class="email"><a href="#" id="listing-show-email" class="track-stats" data-stats-type="<?= ListingStat::SHOW_MAIL; ?>" data-listing-id="<?= (int)$ad->listing_id; ?>" data-url="<?= url(['/listing/get-customer-contact']); ?>" data-customer-id="<?= (int)$ad->customer->customer_id; ?>"><?= t('app', 'Show Email'); ?></a></div>
                                        <?php } ?>
                                        <div class="location"><?= html_encode($ad->location->getAddress()); ?> </div>
                                    </div>
                                    <br>
                                    <?php if (options()->get('app.settings.common.disableMap', 0) == 0) { ?>
                                        <div id="map" style="background-color: #eeebe8; filter: blur(10px);
                                            -webkit-filter: blur(5px);
                                            -moz-filter: blur(5px);
                                            -o-filter: blur(5px);
                                            -ms-filter: blur(5px);"></div>
                                        <script>
                                            var map;
                                            setTimeout(function initMap() {
                                                $('#map').css('filter', 'blur(0px)');
                                                map = new google.maps.Map(document.getElementById('map'), {
                                                    center: {lat: <?=(float)$ad->location->latitude;?>, lng: <?=(float)$ad->location->longitude;?>},
                                                    zoom: 15,
                                                    mapTypeControl: false,
                                                    zoomControl: true,
                                                    scaleControl: false,
                                                    scrollwheel: false,
                                                    streetViewControl: false,
                                                    styles: [
                                                        {
                                                            "featureType": "poi",
                                                            "stylers": [
                                                                {"visibility": "off"}
                                                            ]
                                                        },
                                                        {
                                                            "featureType": "transit",
                                                            "elementType": "labels.icon",
                                                            "stylers": [
                                                                {"visibility": "off"}
                                                            ]
                                                        }
                                                    ],
                                                    gestureHandling: 'cooperative',
                                                });
                                                marker = new google.maps.Marker({
                                                    position: new google.maps.LatLng(<?=(float)$ad->location->latitude;?>, <?=(float)$ad->location->longitude;?>),
                                                });
                                                marker.setMap(map);
                                            }, 200);

                                        </script>
                                        <script src="https://maps.googleapis.com/maps/api/js?key=<?= html_encode(options()->get('app.settings.common.siteGoogleMapsKey', '')); ?>"></script>
                                    <?php } ?>
                                </div>
                                <a href="#" class="btn-as hidden-md hidden-sm hidden-xs favorite-listing " data-stats-type="<?= ListingStat::FAVORITE; ?>" data-listing-id="<?= (int)$ad->listing_id; ?>" data-add-msg="<?= t('app', 'Add to favorites'); ?>" data-remove-msg="<?= t('app', 'Remove Favorite'); ?>" data-favorite-url="<?= url(['/listing/toggle-favorite']); ?>">
                                    <?php if ($ad->isFavorite) { ?>
                                        <i class="fa fa-heart" aria-hidden="true"></i> <span><?= t('app', 'Remove Favorite'); ?></span>
                                    <?php } else { ?>
                                        <i class="fa fa-heart-o" aria-hidden="true"></i> <span><?= t('app', 'Add to favorites'); ?></span>
                                    <?php } ?>
                                </a>
                                <?php app()->trigger('app.ad.under.listingInfo', new Event(['params' => ['ad' => $ad]])); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="separator-text">
                                    <span><?= t('app', 'Description'); ?></span>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                <p><?= html_purify($ad->description); ?></p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="triangle-down"></div>
                <br>
            </div>
        </div>
        <div dir="ltr" class="big-gallery">
            <a href="javascript:;" class="x-close"><i class="fa fa-times" aria-hidden="true"></i></a>
            <div dir="ltr" class="big-gallery-wrapper">
                <div dir="ltr" class="container">
                    <div dir="ltr" class="row">
                        <div class="col-lg-10 col-lg-push-1 col-md-10 col-md-push-1 col-sm-12 col-xs-12">
                            <div dir="ltr" class="listing-heading-gallery">
                                <div dir="ltr" class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        <h1><?= html_encode(mb_strtoupper($ad->title, 'UTF-8')); ?></h1>
                                        <a href="#" class="link add-to-favorites favorite-listing " data-stats-type="<?= ListingStat::FAVORITE; ?>" data-add-msg="<?= t('app', 'Add to favorites'); ?>" data-remove-msg="<?= t('app', 'Remove Favorite'); ?>" data-favorite-url="<?= url(['/listing/toggle-favorite']); ?>" data-listing-id="<?= (int)$ad->listing_id; ?>">
                                            <?php if ($ad->isFavorite) { ?>
                                                <i class="fa fa-heart" aria-hidden="true"></i> <span><?= t('app', 'Remove Favorite'); ?></span>
                                            <?php } else { ?>
                                                <i class="fa fa-heart-o" aria-hidden="true"></i> <span><?= t('app', 'Add to favorites'); ?></span>
                                            <?php } ?>
                                        </a>
                                        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= url(['/listing/index/', 'slug' => $ad->slug], true); ?>" class="social-link track-stats" data-listing-id="<?= (int)$ad->listing_id; ?>" data-stats-type="<?= ListingStat::FACEBOOK_SHARES; ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                        <a target="_blank" href="https://twitter.com/intent/tweet?text=<?= html_encode($ad->title); ?>&url=<?= url(['/listing/index/', 'slug' => $ad->slug], true); ?>" class="social-link track-stats" data-listing-id="<?= (int)$ad->listing_id; ?>" data-stats-type="<?= ListingStat::TWITTER_SHARES; ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                        <a href="mailto:?subject=<?= html_encode($ad->title); ?>&body=<?= t('app', 'Read More:'); ?><?= url(['/listing/index/', 'slug' => $ad->slug], true); ?>" class="social-link track-stats" data-listing-id="<?= (int)$ad->listing_id; ?>" data-stats-type="<?= ListingStat::MAIL_SHARES; ?>"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="price">
                                            <h2><?= html_encode($ad->getPriceAsCurrency($ad->currency->code)); ?></h2>
                                            <?= $ad->isNegotiable() ? t('app', 'Negotiable') : ''; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div dir="ltr" class="row">
                        <div dir="ltr" class="col-lg-10 col-lg-push-1 col-md-10 col-md-push-1 col-sm-12 col-xs-12">
                            <div dir="ltr" class="full-gallery-wrapper">
                                <div dir="ltr" class="full-gallery owl-carousel owl-theme">
                                    <?php foreach ($images as $image) { ?>
                                        <div dir="ltr" class="item"><img dir="ltr" class="" src="<?= $image->image; ?>" alt=""/></div>
                                    <?php } ?>
                                </div>
                                <?php if ($showGalleryArrows) { ?>
                                    <a href="javascript:;" class="arrow-gallery gallery-left-big"><?= SvgHelper::getByName('arrow-left'); ?></a>
                                    <a href="javascript:;" class="arrow-gallery gallery-right-big"><?= SvgHelper::getByName('arrow-right'); ?></a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="margin:0 auto;display:block;text-align:center">
            <a href="<?= url(['/listing/update/', 'slug' => $ad->slug]); ?>" class="btn-edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;<?= t('app', 'Edit'); ?></a>
            <a href="<?= url(['/listing/package/', 'slug' => $ad->slug]); ?>" class="btn-continue"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;<?= t('app', 'Continue'); ?></a>
        </div>


    </div>
    <?= SendMessageWidget::widget(['listingSlug' => $ad->slug]); ?>

    <?= AdsListWidget::widget([
        'listType' => AdsListWidget::LIST_TYPE_PROMOTED,
        'title' => t('app', 'Promoted ads'),
        'ad' => $ad,
        'quantity' => 4
    ]);
    ?>

    <?= AdsListWidget::widget([
        'listType' => AdsListWidget::LIST_TYPE_RELATED,
        'title' => t('app', 'Related ads'),
        'ad' => $ad,
        'quantity' => 4
    ]);
    ?>

</div>