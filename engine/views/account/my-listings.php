<?php

use yii\helpers\Html;
use app\assets\AccountAsset;
use app\helpers\SvgHelper;

AccountAsset::register($this);

echo $this->render('_navigation.php', []);

?>
<style>
    .list-group-item.active, .list-group-item.active:hover, .list-group-item.active:focus {

        color: #438ed8;
        font-weight: bold;
        margin: 0;
        background-color: #e7f2fc;
        position: relative;
        border-color: #e7f2fc;
    }

    .list-group-item {
        color: #666;
        font-size: 14px;
        padding: 17px 24px 17px 15px;
        line-height: 14px;
        display: block;
        background: #fff;
        position: relative;
        border: 1px solid #e7e7e7;
    }

    .my-account-box {
        height: 131px;
        width: 245px;
        padding: 15px;
        float: left;
        -webkit-transition: 0.1s ease-in-out;
        -moz-transition: 0.1s ease-in-out;
        -o-transition: 0.1s ease-in-out;
        -ms-transition: 0.1s ease-in-out;
        transition: 0.1s ease-in-out;
        zoom: 1;
        margin-top: 10px;
        padding: 13px 10px 10px 10px;
        background-color: #fff;
        -webkit-box-shadow: 0 1px 1px #e8e8e8;
        box-shadow: 0 1px 1px #e8e8e8;
        position: relative;
        margin-right: 30px;
        border: 1px solid #e2e2e2;
    }

    .my-account-box p {
        font-size: 14px;
        color: #999;
        margin: 5px 0 8px 0;
        text-align: right;
    }

    .my-account-box strong {
        color: #6990ad;
        font-size: 44px;
        float: right;
        font-family: ProximaNovaRgRegular;
    }

    .package-box {
        font-family: 'Quicksand', sans-serif;
        font-weight: normal;
        border: 1px solid lightgrey;
        padding: 10px;
        margin-bottom: 5%;
    }
    .package-box-header p{
        font-size: large;
        color: #6990ad;
    }
    .p-name
    {
        border-right: 1px solid dimgray;
    }
    .package-box-body h1
    {
        color: #6990ad;
        font-size: 30px;
      text-align: center;
    }
    .package-box-body p
    {
        color: #6990ad;
        font-size: 18px;
        text-align: center;
    }
    @media only screen and (max-width: 999px){
        .p-name
        {
            margin-bottom: 10px;
        }

    }
</style>
<script>
   function openTab(tabopen) {
      // alert(tabopen);
      $('.dynamicClassTab').hide();
      $('.' + tabopen).show();
   }
</script>
<div class = "container">
   <div class = "row">
      <div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <div class = "box-header hidden-lg hidden-md hidden-sm">
            <div class = text-center">
                <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-database fa-fw']) . t('app', 'Export Ads Data '), ['export-listings-data'], ['class' => 'btn-as wide']) ?>
            </div>
         </div>
      </div>
   </div>
   <div class = "row">
      <div class = "col-md-2">
         <div class = "list-group">
            <a href = "javascript:void(0)" class = "list-group-item active" onclick = "openTab('summary')">Summary</a>
            <a href = "javascript:void(0)" class = "list-group-item" onclick = "openTab('online')">Online</a>
            <a href = "javascript:void(0)" class = "list-group-item" onclick = "openTab('unpublished')">Unpublished</a>
            <a href = "javascript:void(0)" class = "list-group-item" onclick = "openTab('package')">Packages</a>
         </div>
      </div>
      <div class = "summary dynamicClassTab" style = "display:block;">
          <?php \yii\widgets\Pjax::begin([
                                                 'enablePushState' => true,
                                         ]); ?>
          <?= \yii\widgets\ListView::widget([
                                                    'id'               => 'my-listings',
                                                    'dataProvider'     => $myAdsProvider,
                                                    'itemView'         => '_ad_item',
                                                    'layout'           => '
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                        <a class="my-account-box active-classified">
                            <p><span style="vertical-align: inherit;">
                                    <span style="vertical-align: inherit;">The publication </span>
                                    <br>
                                    <span style="vertical-align: inherit;">
                                        <span style="vertical-align: inherit;">Total ad</span>
                                    </span></p><strong class="ng-binding">
                                <span style="vertical-align: inherit;">
                                    <span style="vertical-align: inherit;">' . $totalAds . '</span>
                                </span>
                            </strong>
                        </a>
                        <a class="my-account-box active-classified">
                            <p><span style="vertical-align: inherit;">
                                    <span style="vertical-align: inherit;">The number of ads you have </span>
                                    <br>
                                    <span style="vertical-align: inherit;">
                                        <span style="vertical-align: inherit;">added to your favorites</span>
                                    </span></p><strong class="ng-binding">
                                <span style="vertical-align: inherit;">
                                    <span style="vertical-align: inherit;">' . $totalfavorites . '</span>
                                </span>
                            </strong>
                        </a>
                        <a class="my-account-box active-classified">
                            <p><span style="vertical-align: inherit;">
                                    <span style="vertical-align: inherit;">The number of messages sent to  </span>
                                    <br>
                                    <span style="vertical-align: inherit;">
                                        <span style="vertical-align: inherit;">your advertisements</span>
                                    </span></p><strong class="ng-binding">
                                <span style="vertical-align: inherit;">
                                    <span style="vertical-align: inherit;">' . $totalMessage . '</span>
                                </span>
                            </strong>
                        </a>
                        <br>
                        <br>
                        <ul class="list list-my-listings">
                            <li class="list-head">
                                <ul>
                                    <li class="image"></li>
                                    <li class="name">' . t('app', 'Name') . '</li>
                                    <li class="category">' . t('app', 'Category') . '</li>
                                    <li class="status">' . t('app', 'Status') . '</li>
                                    <li class="actions icons">' . Html::a(Html::tag('i', '', ['class' => 'fa fa-database fa-fw']) . t('app', 'Export Ads Data'), ['export-listings-data'], ['class' => 'btn-as transparent', 'data-pjax' => '0']) . '</li>
                                </ul>
                            </li>
                            <li class="list-body">
                                {items}
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="pagination-custom">
                            <div class="row">
                                {pager}
                            </div>
                        </div>
                    </div>
                ',
                                                    'itemOptions'      => [
                                                    ],
                                                    'emptyText'        => '
                <li class="list-head">
                    <ul>
                        <li class="number">' . t('app', 'My Ads') . '</li>
                        <li class="date"></li>
                        <li class="total"></li>
                        <li class="actions"></li>
                    </ul>
                </li>
                <li class="list-body">
                    <ul>
                        <li class="empty">' . t('app', 'No results found') . '</li>
                    </ul>
                </li>',
                                                    'emptyTextOptions' => ['tag' => 'ul', 'class' => 'list list-my-listings'],
                                                    'pager'            => [
                                                            'class'         => 'app\widgets\CustomLinkPager',
                                                            'prevPageLabel' => SvgHelper::getByName('arrow-left'),
                                                            'nextPageLabel' => SvgHelper::getByName('arrow-right')
                                                    ],
                                            ]); ?>
          <?php \yii\widgets\Pjax::end(); ?>
      </div>
      <div class = "online dynamicClassTab" style = "display:none;">
          <?php \yii\widgets\Pjax::begin([
                                                 'enablePushState' => true,
                                         ]); ?>
          <?= \yii\widgets\ListView::widget([
                                                    'id'               => 'my-listings',
                                                    'dataProvider'     => $myAdsProviderOnline,
                                                    'itemView'         => '_ad_item',
                                                    'layout'           => '
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                        <a class="my-account-box active-classified">
                            <p><span style="vertical-align: inherit;">
                                    <span style="vertical-align: inherit;">The publication </span>
                                    <br>
                                    <span style="vertical-align: inherit;">
                                        <span style="vertical-align: inherit;">Total ad</span>
                                    </span></p><strong class="ng-binding">
                                <span style="vertical-align: inherit;">
                                    <span style="vertical-align: inherit;">' . $totalAds . '</span>
                                </span>
                            </strong>
                        </a>
                        <a class="my-account-box active-classified">
                            <p><span style="vertical-align: inherit;">
                                    <span style="vertical-align: inherit;">The number of ads you have </span>
                                    <br>
                                    <span style="vertical-align: inherit;">
                                        <span style="vertical-align: inherit;">added to your favorites</span>
                                    </span></p><strong class="ng-binding">
                                <span style="vertical-align: inherit;">
                                    <span style="vertical-align: inherit;">' . $totalfavorites . '</span>
                                </span>
                            </strong>
                        </a>
                        <a class="my-account-box active-classified">
                            <p><span style="vertical-align: inherit;">
                                    <span style="vertical-align: inherit;">The number of messages sent to  </span>
                                    <br>
                                    <span style="vertical-align: inherit;">
                                        <span style="vertical-align: inherit;">your advertisements</span>
                                    </span></p><strong class="ng-binding">
                                <span style="vertical-align: inherit;">
                                    <span style="vertical-align: inherit;">' . $totalMessage . '</span>
                                </span>
                            </strong>
                        </a>
                        <br>
                        <br>
                        <ul class="list list-my-listings">
                            <li class="list-head">
                                <ul>
                                    <li class="image"></li>
                                    <li class="name">' . t('app', 'Name') . '</li>
                                    <li class="category">' . t('app', 'Category') . '</li>
                                    <li class="status">' . t('app', 'Status') . '</li>
                                    <li class="actions icons">' . Html::a(Html::tag('i', '', ['class' => 'fa fa-database fa-fw']) . t('app', 'Export Ads Data'), ['export-listings-data'], ['class' => 'btn-as transparent', 'data-pjax' => '0']) . '</li>
                                </ul>
                            </li>
                            <li class="list-body">
                                {items}
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="pagination-custom">
                            <div class="row">
                                {pager}
                            </div>
                        </div>
                    </div>
                ',
                                                    'itemOptions'      => [
                                                    ],
                                                    'emptyText'        => '
                <li class="list-head">
                    <ul>
                        <li class="number">' . t('app', 'My Ads') . '</li>
                        <li class="date"></li>
                        <li class="total"></li>
                        <li class="actions"></li>
                    </ul>
                </li>
                <li class="list-body">
                    <ul>
                        <li class="empty">' . t('app', 'No results found') . '</li>
                    </ul>
                </li>',
                                                    'emptyTextOptions' => ['tag' => 'ul', 'class' => 'list list-my-listings'],
                                                    'pager'            => [
                                                            'class'         => 'app\widgets\CustomLinkPager',
                                                            'prevPageLabel' => SvgHelper::getByName('arrow-left'),
                                                            'nextPageLabel' => SvgHelper::getByName('arrow-right')
                                                    ],
                                            ]); ?>
          <?php \yii\widgets\Pjax::end(); ?>
      </div>
      <div class = "unpublished dynamicClassTab" style = "display:none;">
          <?php \yii\widgets\Pjax::begin([
                                                 'enablePushState' => true,
                                         ]); ?>
          <?= \yii\widgets\ListView::widget([
                                                    'id'               => 'my-listings',
                                                    'dataProvider'     => $myAdsProviderUnpublished,
                                                    'itemView'         => '_ad_item',
                                                    'layout'           => '
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                        <a class="my-account-box active-classified">
                            <p><span style="vertical-align: inherit;">
                                    <span style="vertical-align: inherit;">The publication </span>
                                    <br>
                                    <span style="vertical-align: inherit;">
                                        <span style="vertical-align: inherit;">Total ad</span>
                                    </span></p><strong class="ng-binding">
                                <span style="vertical-align: inherit;">
                                    <span style="vertical-align: inherit;">' . $totalAds . '</span>
                                </span>
                            </strong>
                        </a>
                        <a class="my-account-box active-classified">
                            <p><span style="vertical-align: inherit;">
                                    <span style="vertical-align: inherit;">The number of ads you have </span>
                                    <br>
                                    <span style="vertical-align: inherit;">
                                        <span style="vertical-align: inherit;">added to your favorites</span>
                                    </span></p><strong class="ng-binding">
                                <span style="vertical-align: inherit;">
                                    <span style="vertical-align: inherit;">' . $totalfavorites . '</span>
                                </span>
                            </strong>
                        </a>
                        <a class="my-account-box active-classified">
                            <p><span style="vertical-align: inherit;">
                                    <span style="vertical-align: inherit;">The number of messages sent to  </span>
                                    <br>
                                    <span style="vertical-align: inherit;">
                                        <span style="vertical-align: inherit;">your advertisements</span>
                                    </span></p><strong class="ng-binding">
                                <span style="vertical-align: inherit;">
                                    <span style="vertical-align: inherit;">' . $totalMessage . '</span>
                                </span>
                            </strong>
                        </a>
                        <br>
                        <br>
                        <ul class="list list-my-listings">
                            <li class="list-head">
                                <ul>
                                    <li class="image"></li>
                                    <li class="name">' . t('app', 'Name') . '</li>
                                    <li class="category">' . t('app', 'Category') . '</li>
                                    <li class="status">' . t('app', 'Status') . '</li>
                                    <li class="actions icons">' . Html::a(Html::tag('i', '', ['class' => 'fa fa-database fa-fw']) . t('app', 'Export Ads Data'), ['export-listings-data'], ['class' => 'btn-as transparent', 'data-pjax' => '0']) . '</li>
                                </ul>
                            </li>
                            <li class="list-body">
                                {items}
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="pagination-custom">
                            <div class="row">
                                {pager}
                            </div>
                        </div>
                    </div>
                ',
                                                    'itemOptions'      => [
                                                    ],
                                                    'emptyText'        => '
                <li class="list-head">
                    <ul>
                        <li class="number">' . t('app', 'My Ads') . '</li>
                        <li class="date"></li>
                        <li class="total"></li>
                        <li class="actions"></li>
                    </ul>
                </li>
                <li class="list-body">
                    <ul>
                        <li class="empty">' . t('app', 'No results found') . '</li>
                    </ul>
                </li>',
                                                    'emptyTextOptions' => ['tag' => 'ul', 'class' => 'list list-my-listings'],
                                                    'pager'            => [
                                                            'class'         => 'app\widgets\CustomLinkPager',
                                                            'prevPageLabel' => SvgHelper::getByName('arrow-left'),
                                                            'nextPageLabel' => SvgHelper::getByName('arrow-right')
                                                    ],
                                            ]); ?>
          <?php \yii\widgets\Pjax::end(); ?>
      </div>
      <div class="col-md-10">
      <div class = "package dynamicClassTab" style = "display:none;">
          <?php if ($myPackage !== '') : ?>
             <div class = "row">
                <div class = "package-box-header d-head text-center">
                   <p>My Package Info</p>
                </div>
                <div class = "col-md-4 col-sm-6">
                   <div class = "package-box">
                      <div class = "package-box-body">
                       <div class="row">
                          <div class="col-md-6 col-sm-6 col-xs-6 p-name">
                            <p> Package Name</p>
                             <h1>
                                 <?= isset($myPackage['package']['title']) && $myPackage['package']['title'] !== '' ? $myPackage['package']['title'] : 'N/A' ?>
                             </h1>

                          </div>
                          <div class="col-md-6  col-sm-6 col-xs-6 ">
                             <p>Total Ads</p>
                             <h1>
                                 <?= isset($myPackage['package']['total_ads']) && $myPackage['package']['total_ads'] !== '' ? $myPackage['package']['total_ads'] : 'N/A' ?>
                             </h1>
                          </div>
                       </div>
                      </div>
                   </div>
                </div>
                <div class = "col-md-4 col-sm-6">
                   <div class = "package-box">
                      <div class = "package-box-header text-center">
                         <p>Total Remaining Ads</p>
                      </div>
                      <div class = "package-box-body">
                         <h1>
                             <?php
                             $total=isset($myPackage['package']['total_ads']) && $myPackage['package']['total_ads'] !== '' ? $myPackage['package']['total_ads'] : '';
                              $used= isset($totalPackageAds) && $totalPackageAds !== '' ? $totalPackageAds : '' ;
                              $left=$total-$used;
                             ?>
                           <?= isset($left) && $left !== '' ? $left : 'N/A' ?>
                         </h1>
                      </div>
                   </div>
                </div>
                  <div class = "col-md-4 col-sm-6">
                <div class = "package-box">
                   <div class = "package-box-header text-center">
                      <p>Total Used Ads</p>
                   </div>
                   <div class = "package-box-body">
                      <h1>
                          <?= isset($totalPackageAds) && $totalPackageAds !== '' ? $totalPackageAds : 'N/A' ?>
                      </h1>
                   </div>
                </div>
                 </div>
             </div>
          <?php endif; ?>
      </div>
      </div>
   </div>
</div>

<div class = "modal fade" id = "modal-post-listing-delete" tabindex = "-1" role = "dialog" aria-labelledby = "" aria-hidden = "true">
   <div class = "modal-dialog modal-notice" role = "document">
      <div class = "modal-content">
         <div class = "modal-header">
            <h1 class = "modal-title"><?= t('app', 'Notice'); ?></h1>
            <a href = "javascript:;" class = "x-close" data-dismiss = "modal"><i class = "fa fa-times" aria-hidden = "true"></i></a>
         </div>
         <div class = "modal-body">
            <p><?= t('app', 'Are you sure you want to delete this ad?'); ?></p>
         </div>
         <div class = "modal-footer">
            <div class = "row">
               <div class = "col-lg-6 col-md-6 col-sm-6 col-xs-6">
                  <button type = "button" class = "btn-as delete-listing" data-dismiss = "modal"><?= t('app', 'Delete'); ?></button>
               </div>
               <div class = "col-lg-6 col-md-6 col-sm-6 col-xs-6">
                  <button type = "button" class = "btn-as black pull-right" data-dismiss = "modal"><?= t('app', 'Close'); ?></button>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>



