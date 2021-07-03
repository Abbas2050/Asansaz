<?php
use app\helpers\SvgHelper;
$segment = app()->controller->action->id;

$navigation = [
        'my-listings' => [
            'url'   => 'account/my-listings',
            'label' => t('app', 'My Ads'),
        ],
        'favorites' => [
            'url'   => 'account/favorites',
            'label' => t('app', 'Favorite Ads'),
        ],
        'conversations' => [
            'url'   => 'account/conversations',
            'label' => t('app', 'Inbox'),
        ],
        'invoices' => [
            'url'   => 'account/invoices',
            'label' => t('app', 'Invoices'),
        ],
        'info' => [
            'url'   => 'account/info',
            'label' => t('app', 'Account Info'),
        ],
    ];

//Event to modify array navigation.
$event = new \app\yii\base\Event();
$event->params = [
    'navigation' => $navigation,
];
app()->trigger('app.account.navigation.list', $event);

$accountNavigation = $event->params['navigation'];

?>
<style>
    @media only screen and (min-width: 768px){
        .my-account-navigation .myaccount-menu #account-nav {
            margin-top: 0;
        }
        
        .my-account-navigation {
            min-height: auto;
            padding: 0 0 0 0;
        }
    }
        
        .my-account-navigation .myaccount-menu #account-nav a {
                position: relative;
                font-family: 'Quicksand', sans-serif;
                color: #b1b1b1;
                text-decoration: none;
                line-height: 18px;
                display: inline-block;
                padding: 20px 0 0 0;
                height: 60px;
                font-size: 14px;
        }
        
        #account-nav {
            zoom: 1;
            height: 60px;
            background: #fff;
            -webkit-box-shadow: 1px 1px 4px 0 rgb(0 0 0 / 10%);
            box-shadow: 1px 1px 4px 0 rgb(0 0 0 / 10%);
        }
        
        #account-nav a.active {
                color: #438ed8 !important;
                border-bottom: 2px solid #438ed8;
        }
        
         #account-nav a {
                color: #333 !important;
                font-weight:700;
        }
        
        .my-account-navigation {
            text-align:left;
        }
        
        .indicater {
            display:none !important;
        }

</style>

<section class="my-account-navigation">
    
    <div class="myaccount-menu">
        <div id="account-nav">
            <div class="container">
            <?php foreach ($accountNavigation as $key => $value){?>
                <a href="<?= url([$value['url']]);?>" class="<?=($segment == $key) ? 'active' : '';?>"><?= $value['label'];?></a>
            <?php } ?>
            </div>
        </div>
    </div>
    <div class="myaccount-menu-mobile">
        
        <div class="menu-subtitles">
            <?php foreach ($accountNavigation as $key => $value){ ?>
                <ul>
                    <li class="<?=($segment == $key) ? 'active' : '';?>">
                        <a href="javascript:;" data-toggle="collapse" data-target="#menu-options" aria-expanded="false">
                            <?= $value['label'];?><?= SvgHelper::getByName('arrow-top');?><?= SvgHelper::getByName('arrow-bottom');?>
                        </a>
                    </li>
                </ul>
            <?php } ?>
        </div>
        <div id="menu-options" class="menu-options collapse">
            <?php foreach ($accountNavigation as $key => $value){ ?>
                <ul>
                    <li class="<?=($segment == $key) ? 'active' : '';?>"><a href="<?= url([$value['url']]);?>"><?= $value['label'];?></a></li>
                </ul>
            <?php } ?>
        </div>
    </div>
</section>
