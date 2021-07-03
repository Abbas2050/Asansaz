<?php

use app\assets\AdAsset;

use app\helpers\SvgHelper;

use app\models\ListingStat;

use app\models\Category;

use app\components\AdsListWidget;

use app\components\SendMessageWidget;

use \app\models\CustomerStore;

use \app\yii\base\Event;

AdAsset::register($this);


$showGalleryArrows = (count($images) > 1) ? true : false;

$fullWidthGallery = (count($images) < 4) ? 'full-width' : '';


?>

<style>
    .separator-text {
        display: none;
    }

    #newCategories {
        display: none;
    }

    #classifiedDetail {
        width: 100%;
        padding: 0;
        margin: auto;
    }

    .classifiedDetail {
        zoom: 1;
        /*	border-bottom: 1px solid #dbdbdb;*/
    }

    .classifiedDetail:before, .classifiedDetail:after {
        display: table;
        content: "";
        zoom: 1;
    }

    .classifiedDetail:after {
        clear: both;
    }

    .classifiedDetailTitle {
        margin-bottom: 10px;
        zoom: 1;
        color: #333;
    }

    .classifiedDetailTitle:before, .classifiedDetailTitle:after {
        display: table;
        content: "";
        zoom: 1;
    }

    .classifiedDetailTitle h2 {
        font-size: 18px;
        color: #333;
        padding: 15px 0 12px;
        height: 18px;
        float: left;
        max-width: 710px;
        white-space: nowrap;
        -o-text-overflow: ellipsis;
        text-overflow: ellipsis;
        line-height: 0px !important;
    }

    .classifiedDetailTitle .classifiedEvents {
        zoom: 1;
        width: 300px;
        float: right;

    }

    .classifiedDetailTitle .classifiedEvents:before, .classifiedDetailTitle .classifiedEvents:after {
        display: table;
        content: "";
        zoom: 1;
    }

    .classifiedDetailTitle .classifiedEvents li.add-to-favorites {
        position: relative;
    }

    .classifiedDetailTitle .classifiedEvents li:first-child {
        margin-right: 10px;
        width: 115px;
    }

    .classifiedDetailTitle .classifiedEvents li {
        padding-top: 10px;
        float: left;
    }

    .classifiedDetailTitle .classifiedEvents a {
        display: inline-block;
        padding-left: 17px;
        color: #00339f;
        font-size: 11px;
        height: 18px;
    }

    .classifiedDetail a {
        cursor: pointer;
    }

    .disable {
        display: none !important;
    }

    .classifiedDetailTitle .classifiedEvents a {
        display: inline-block;
        padding-left: 17px;
        color: #00339f;
        font-size: 11px;
        height: 18px;
    }

    .classifiedDetailTitle .classifiedRemoveFavorite {
        background: url(/assets/site/img/detail.png) 0 -1078px no-repeat;
    }

    .save-favorite-submenu {
        display: none;
        position: absolute;
        right: 0;
        top: -1px;
        z-index: 100000;
        background: #fff;
        padding: 10px 0;
        -webkit-box-shadow: 0 1px 5px rgb(32 32 32 / 30%);
        box-shadow: 0 1px 5px rgb(32 32 32 / 30%);
        border-radius: 3px;
        width: 263px;
    }

    .classifiedDetailTitle .classifiedEvents li.share-icons {
        float: right;
        margin-right: 0;
    }

    .classifiedDetailTitle .classifiedEvents a.share-icon.facebook {
        margin-left: 0;
        background-position: 0 0;
    }

    .classifiedDetailTitle .classifiedEvents a.share-icon {
        display: inline-block;
        text-indent: -999px;
        overflow: hidden;
        width: 19px;
        height: 19px;
        background: url(/assets/site/img/paylas.png) no-repeat;
        padding: 0;
        margin-left: 6px;
    }

    .classifiedDetailTitle .classifiedEvents a.share-icon.email {
        background-position: -75px 0;
    }

    .classifiedDetailTitle .classifiedEvents a.share-icon.twitter {
        background-position: -25px 0;
    }

    .classifiedDetailTitle .classifiedPrint {
        background: url(/assets/site/img/detail.png) 0 -71px no-repeat;
    }

    ol, ul {
        list-style: none;
    }

    .classifiedDetailTitle .classifiedAddFavorite {
        background: url(/assets/site/img/detail.png) 0 -23px no-repeat;
    }

    #container .classifiedDetailContent .classifiedDetailPhotos {
        margin-right: 30px;
        width: 528px;
    }

    .classifiedDetailPhotos {
        width: 100%;
        margin-right: 13px;
        float: left;
        zoom: 1;
    }

    .classifiedDetailPhotos:before, .classifiedDetailPhotos:after {
        display: table;
        content: "";
        zoom: 1;
    }

    .classifiedDetailMainPhoto {
        width: 600px;
        height: auto;
        overflow: hidden;
        position: relative;
        z-index: 7;
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
        margin-top: 9%;
        margin-bottom: 5%;
    }

    #container .classifiedDetailContent .classifiedDetailPhotos .classifiedDetailMainPhoto {
        width: 528px;
        height: 396px;
    }

    .classifiedDetailPhotos .classifiedDetailMegaVideo {
        padding-top: 9px;
        height: 23px;
        border-bottom: 1px solid #d7d7d7;
        background-color: #ededed;
        background-repeat: repeat-x;
        background-image: -webkit-linear-gradient(top, #fefefe, #ededed);
        background-image: -moz-linear-gradient(top, #fefefe, #ededed);
        background-image: -o-linear-gradient(top, #fefefe, #ededed);
        background-image: -ms-linear-gradient(top, #fefefe, #ededed);
        background-image: linear-gradient(to bottom, #fefefe, #ededed);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=fullcolor(#fefefe), endColorstr=fullcolor(#ededed), GradientType=1);
        width: 100%;
        zoom: 1;
        text-shadow: 1px 1px 0 #fff;
        text-align: center;
    }

    .classifiedDetailPhotos .classifiedDetailMegaVideo li {
        display: block;
        width: 38%;
        float: left;
        border-right: 1px solid #ddd;
        border-left: 1px solid #fff;
        height: 18px;
    }

    .classifiedDetailPhotos .classifiedDetailMegaVideo li.no-matterport {
        border: 0;
        width: 29%;
        float: left;
    }

    .classifiedDetailPhotos .classifiedDetailMegaVideo li.no-matterport {
        border: 0;
        width: 29%;
        float: left;
    }

    .classifiedDetailPhotos .classifiedDetailMegaVideo li.right {
        width: 20%;
        float: right;
    }

    .classifiedDetailPhotos .classifiedDetailMegaVideo:before, .classifiedDetailPhotos .classifiedDetailMegaVideo:after {
        display: table;
        content: "";
        zoom: 1;
    }

    .classifiedDetailPhotos .classifiedDetailMegaVideo:after {
        clear: both;
    }

    .classifiedDetailPhotos .classifiedDetailMegaVideo:before, .classifiedDetailPhotos .classifiedDetailMegaVideo:after {
        display: table;
        content: "";
        zoom: 1;
    }

    .classifiedDetailPhotos:after {
        clear: both;
    }

    .classifiedDetailPhotos:before, .classifiedDetailPhotos:after {
        display: table;
        content: "";
        zoom: 1;
    }

    .classifiedDetailMainPhoto input:checked + label {
        display: block;
        z-index: 10;
    }

    .classifiedDetailMainPhoto label {
        display: none;
        position: absolute;
        left: 0;
        z-index: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
        top: 10%;
    }

    .classifiedDetailMainPhoto label:before {
        position: absolute;
        z-index: 11;
        width: 100%;
        height: 100%;
        content: " ";
    }

    .classifiedDetailMainPhoto label img:first-child {
        z-index: 1;
    }

    .classifiedDetailMainPhoto label img {
        position: absolute;
        left: 0;
    }

    .classifiedDetailMainPhoto img {
        width: 100%;
        height: 100%;
    }

    .view-listing .listing-heading .listing-heading-wrapper.sticky {
        position: revert;
    }

    .classifiedOtherDetails {
        padding-top: 35px;
    }

    #classified-tabs {
        height: 37px;
    }

    .classifiedOtherDetails .uiTabStyleOne {
        margin-bottom: 3px;
    }

    .uiTabStyleOne {
        float: left;
        width: 100%;
        position: relative;
    }

    .uiTabStyleOne.classifiedDetailTabs:before {
        top: 33px;
    }

    .uiTabStyleOne:before {
        position: absolute;
        width: 100%;
        height: 2px;
        z-index: 10;
        top: 27px;
        left: 0;
        content: " ";
        border-bottom: 2px solid #ffc000;
    }

    .uiTabStyleOne.classifiedDetailTabs li {
        height: 36px;
    }

    .uiTabStyleOne li {
        float: left;
        margin-left: 10px;
        height: 29px;
    }

    .uiTabStyleOne.classifiedDetailTabs a {
        padding: 9px 17px 11px 17px;
        font-size: 14px;
    }

    .uiTabStyleOne a {
        font-weight: bold;
        color: #1064bc;
        display: block;
        border: 1px solid #c0c0c0;
        padding: 7px 15px 7px 15px;
        border-bottom: 0;
        background: #fff;
        background: -moz-linear-gradient(top, #fff 0, #f0f0f0 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #fff), color-stop(100%, #f0f0f0));
        background: -webkit-linear-gradient(top, #fff 0, #f0f0f0 100%);
        background: -o-linear-gradient(top, #fff 0, #f0f0f0 100%);
        background: -ms-linear-gradient(top, #fff 0, #f0f0f0 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#f0f0f0', GradientType=0);
        background: linear-gradient(top, #fff 0, #f0f0f0 100%);
        zoom: 1;
        -webkit-box-shadow: inset 0 1px 1px #fff;
        -moz-box-shadow: inset 0 1px 1px #fff;
        box-shadow: inset 0 1px 1px #fff;
        -moz-border-radius-topleft: 8px;
        -moz-border-radius-topright: 8px;
        -moz-border-radius-bottomright: 0;
        -moz-border-radius-bottomleft: 0;
        -webkit-border-radius: 3px 3px 0 0;
        border-radius: 3px 3px 0 0;
        height: 15px;
    }

    uiTabStyleOne.classifiedDetailTabs li {
        height: 36px;
    }

    .uiTabStyleOne li {
        float: left;
        margin-left: 10px;
        height: 29px;
    }

    .uiTabStyleOne.classifiedDetailTabs li {
        height: 36px;
    }

    .uiBox.closed {
        border-bottom: 0;
    }

    .classifiedOtherDetails .uiBox {
        margin-bottom: 10px;
        clear: both;
    }

    .uiBox {
        border: 1px solid #dedede;
        position: relative;
    }

    .uiBox {
        border: 1px solid #dedede;
        overflow: hidden;
    }

    .uiBoxTitle, .uiInlineBoxTitle {
        border-bottom: 1px solid #dedede;
        padding: 6px 10px 7px 10px;
        background: #efefef;
        background: -moz-linear-gradient(top, #fff 0, #efefef 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #fff), color-stop(100%, #efefef));
        background: -webkit-linear-gradient(top, #fff 0, #efefef 100%);
        background: -o-linear-gradient(top, #fff 0, #efefef 100%);
        background: -ms-linear-gradient(top, #fff 0, #efefef 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFFFFF', endColorstr='#EFEFEF', GradientType=0);
        background: linear-gradient(top, #fff 0, #efefef 100%);
        *zoom: 1;
    }

    .uiBoxTitle h3 {
        font-size: 14px;
        font-weight: bold;
    }

    .uiTabStyleOne.classifiedDetailTabs li {
        height: 36px;
    }

    #classifiedDescription {
        word-wrap: break-word;
        line-height: 1.3em;
        font-size: 14px;
    }

    .uiBoxContainer {
        padding: 15px;
        color: #000;
        background-color: #fff;
    }

    #classifiedDescription p, #classifiedDescription span, #classifiedDescription b, #classifiedDescription font {
        line-height: normal;
    }

    #classifiedDescription p {
        padding-bottom: 10px;
    }

    .uiBox.closed {
        border-bottom: 0;
    }

    .classifiedOtherDetails .uiBox {
        margin-bottom: 10px;
        clear: both;
    }

    #container .classifiedDetailContent .classifiedInfo {
        width: 300px;
    }

    .classifiedDetailContent .classifiedInfo {
        display: inline-block;
        width: 300px;
        margin-right: 13px;
        float: left;
    }

    .classifiedDetailContent .classifiedInfo > h3, .classifiedDetailContent .classifiedInfo .getBox .priceInfo h3 {
        font-size: 14px;
        color: #039;
        padding-bottom: 20px;
    }

    .classifiedDetail h3 {
        position: relative;
    }

    .classifiedDetailContent .classifiedInfo > h3, .classifiedDetailContent .classifiedInfo .getBox .priceInfo h3 {
        font-size: 14px;
        color: #039;
        padding-bottom: 20px;
    }

    .price-history-wrapper {
        position: relative;
        display: inline-block;
        letter-spacing: 0 !important;
    }

    .price-history-wrapper.price-history-icon {
        cursor: pointer;
        width: 17px;
        height: 15px;
        margin-left: 5px;
    }

    .price-history-wrapper {
        position: relative;
        display: inline-block;
        letter-spacing: 0 !important;
    }

    .price-history-wrapper.price-history-icon:after {
        top: 2px;
        content: " ";
        position: absolute;
        background-image: url(/assets/site/img/classifiedPriceHistory.png);
        background-position: -127px -185px;
        width: 17px;
        height: 15px;
        content: '';
        display: inline-block;
        vertical-align: middle;
    }

    .price-history-wrapper .price-history-info {
        display: none;
        position: absolute;
        width: 340px;
        padding: 0 10px 10px 10px;
        background: #fafafa;
        -webkit-box-shadow: 2px 0 5px 0 rgb(0 0 0 / 10%), 0 2px 4px 0 rgb(0 0 0 / 10%), -2px 0 5px 0 rgb(0 0 0 / 10%);
        box-shadow: 2px 0 5px 0 rgb(0 0 0 / 10%), 0 2px 4px 0 rgb(0 0 0 / 10%), -2px 0 5px 0 rgb(0 0 0 / 10%);
        z-index: 400;
        top: 27px;
        left: -165px;
    }

    .price-history-wrapper .price-history-info .section-top {
        padding: 20px 0 9px 10px;
        height: 14px;
        padding-top: 20px;
        border-bottom: 1px solid #eaeaea;
        background-color: #fafafa;
    }

    .price-history-wrapper .price-history-info .section-top .section-title {
        position: relative;
        font-size: 12px;
        color: #438ed8;
        font-weight: bold;
        cursor: default;
    }

    .price-history-wrapper .price-history-info .price-history-summary {
        list-style: none;
        margin-top: 10px;
        position: relative;
        display: -webkit-box;
        display: -moz-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: box;
        display: flex;
        background-color: #fff;
        border: 1px solid #ececed;
        padding-top: 15px;
        padding-bottom: 15px;
    }

    .price-history-wrapper .price-history-info .price-history-summary .price-history-summary-item.first-price {
        margin-left: 5px;
    }

    .price-history-wrapper .price-history-info .price-history-summary .price-history-summary-item {
        float: left;
        text-align: center;
        width: calc(100% / 2 - 23px);
    }

    .price-history-wrapper .price-history-info .price-history-summary .price-history-summary-item.price-holder {
        display: inline-block;
        width: 46px;
    }

    .price-history-wrapper .price-history-info .table-wrapper {
        background-color: #fff;
        border: 1px solid #ececec;
        padding: 15px;
        margin-top: 10px;
        padding-bottom: 0;
        padding-top: 0;
    }

    .price-history-wrapper .price-history-info .price-history-table {
        width: 100%;
    }

    .price-history-wrapper .price-history-info .price-history-table tr:first-child {
        padding-bottom: 9px;
        padding-top: 9px;
    }

    .price-history-wrapper .price-history-info .price-history-table tr:last-child td {
        border-bottom: 0;
    }

    .price-history-wrapper .price-history-info .price-history-table td {
        font-family: 'Lucida Grande', LucidaGrande, Arial, sans-serif;
        font-size: 12px;
        font-weight: normal;
        text-align: left;
        letter-spacing: -0.1px;
        color: #333;
        padding-top: 17.5px;
        padding-bottom: 17.5px;
        border-bottom: 1px solid #dedede;
    }

    .price-history-wrapper .inner-date {
        font-size: 10px;
        color: #999;
        margin-top: 3px;
    }

    .price-history-wrapper .price-history-info .price-history-table td {
        font-family: 'Lucida Grande', LucidaGrande, Arial, sans-serif;
        font-size: 12px;
        font-weight: normal;
        text-align: left;
        letter-spacing: -0.1px;
        color: #333;
        padding-top: 17.5px;
        padding-bottom: 17.5px;
        border-bottom: 1px solid #dedede;
    }

    .price-history-wrapper .no-price-history {
        font-size: 14px;
        font-weight: normal;
        text-align: center;
        padding-left: 20px;
        padding-right: 20px;
        border-top: 1px solid #dedede;
        padding-top: 20px;
        padding-bottom: 10px;
        color: rgba(153, 153, 153, 0.6);
        background-color: #fafafa;
    }

    .price-history-wrapper .price-history-info .price-all {
        font-size: 12px;
        letter-spacing: -0.1px;
        text-align: center;
        color: #039;
        margin-top: 15px;
        margin-bottom: 5px;
        font-weight: normal;
    }

    .classifiedDetailContent .classifiedInfo h2 {
        font-size: 12px;
        color: #039;
        padding: 3px 10px 10px 0;
        border-bottom: 1px solid #dedede;
    }

    .classifiedDetailContent .classifiedInfo .classifiedInfoList {
        padding-top: 4px;
    }

    .classifiedDetailContent .classifiedInfo .classifiedInfoList li {
        border-bottom: 1px dotted #ccc;
        padding: 5px 0;
        zoom: 1;
    }

    .classifiedDetailContent .classifiedInfo .classifiedInfoList li:before, .classifiedDetailContent .classifiedInfo .classifiedInfoList li:after {
        display: table;
        content: "";
        zoom: 1;
    }

    .classifiedDetailContent .classifiedInfo .classifiedInfoList .hiddenAttributes {
        display: none !important;
        width: 0;
        height: 0;
    }

    .dialog.paris-dialog {
        display: none;
        position: fixed;
        background-color: rgba(0, 0, 0, 0.6);
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 30000;
        -webkit-box-align: center;
        -moz-box-align: center;
        -o-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: center;
        -webkit-box-pack: center;
        -moz-box-pack: center;
        -o-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
    }

    .dialog.paris-dialog .dialog-holder {
        width: 55%;
        height: auto;
    }

    .type-individual .dialog.paris-dialog .classified-owner {
        display: block;
    }

    .dialog.paris-dialog .dialog-holder .dialog-container {
        -webkit-box-shadow: 0 1px 4px 0 rgb(0 0 0 / 50%);
        box-shadow: 0 1px 4px 0 rgb(0 0 0 / 50%);
        background-color: #fff;
        padding: 20px;
        display: none;
    }

    .dialog.paris-dialog .dialog-holder .dialog-container .header {
        position: relative;
    }

    .dialog.paris-dialog .dialog-holder .dialog-container .line {
        width: 100%;
        height: 1px;
        background-color: #d8d8d8;
        margin-top: 15px;
    }

    .dialog.paris-dialog .dialog-holder .dialog-container .header .title {
        font-size: 18px;
        color: #454545;
        letter-spacing: .45px;
        font-weight: bold;
        padding-right: 20px;
    }

    .dialog.paris-dialog .dialog-holder .dialog-container .header .close {
        position: absolute;
        right: 0;
        top: 0;
        width: 16px;
        height: 16px;
        background: url(/assets/site/img/controls.png) 0 -113px no-repeat;
        border: 0;
        cursor: pointer;
    }

    .classifiedDetailContent .classifiedOtherBoxes {

        width: 100%;
    }

    .classifiedDetailContent .classifiedOtherBoxes .classifiedUserBox {
        width: 100%;
        display: inline-block;
        border: 1px solid #dbdbdb;
        padding: 3px;
        color: #333;
        margin-bottom: 12px;
        position: relative;
        margin-top: 12%;
    }

    .classifiedDetailContent .classifiedOtherBoxes .classifiedUserContent {
        background: #efefef;
        padding: 12px 14px;
    }

    .classifiedDetailContent .classifiedOtherBoxes .username-info-area {
        overflow: auto;
    }

    .classifiedDetailContent .classifiedOtherBoxes h5 {
        font-size: 14px;
        font-weight: bold;
        word-wrap: break-word;
        text-shadow: 1px 1px 0 #fff;
        padding-top: 5px;
    }

    .classifiedDetailContent .classifiedOtherBoxes .getUserInfo.noBorder:not(.halfBorder) {
        border: 0;
        padding: 0;
    }

    .classifiedDetailContent .classifiedOtherBoxes .getUserInfo {
        text-shadow: 1px 1px 0 #fff;
        border-top: 1px solid #ccc;
        padding-bottom: 10px;
        border-bottom: 1px solid #ccc;
        position: relative;
    }

    .classifiedDetailContent .classifiedOtherBoxes .classifiedUserBox .getUserInfo:before {
        content: ' ';
        display: block;
        border-bottom: 1px solid #fff;
        width: 263px;
        height: 1px;
        position: absolute;
        bottom: -2px;
        left: 0;
    }

    .classifiedDetailContent .classifiedOtherBoxes .getUserInfo .userRegistrationDate {
        padding: 10px 0 0;
        margin-bottom: 6px;
    }

    .classifiedDetailContent .classifiedOtherBoxes .userRegistrationDate {
        font-size: 11px;
        padding-bottom: 10px;
    }

    .classifiedDetailContent .classifiedOtherBoxes p {
        display: inline-block;
    }

    .disable {
        display: none !important;
    }

    .classifiedDetailContent .classifiedOtherBoxes .getUserInfo:after {
        content: ' ';
        display: block;
        border-bottom: 1px solid #fff;
        width: 263px;
        height: 1px;
        position: absolute;
        top: -1px;
        left: 0;
    }

    .classifiedDetailContent .classifiedOtherBoxes .userContactInfo {
        margin-top: 10px;
        background: #fff;
        margin-bottom: 5px;
        border: 1px solid #c0c0c0;
        border-radius: 3px;
        padding: 0 12px;
        font-size: 14px;
        -webkit-box-shadow: 1px 2px 3px #ccc;
        box-shadow: 1px 2px 3px #ccc;
        background-color: #f5f5f5;
        background-repeat: repeat-x;
        background-image: -moz--webkit-linear-gradient(top, #fff, #f5f5f5);
        background-image: -moz--moz-linear-gradient(top, #fff, #f5f5f5);
        background-image: -moz--o-linear-gradient(top, #fff, #f5f5f5);
        background-image: -moz--ms-linear-gradient(top, #fff, #f5f5f5);
        background-image: -moz-linear-gradient(to bottom, #fff, #f5f5f5);
        background-image: -ms--webkit-linear-gradient(top, #fff, #f5f5f5);
        background-image: -ms--moz-linear-gradient(top, #fff, #f5f5f5);
        background-image: -ms--o-linear-gradient(top, #fff, #f5f5f5);
        background-image: -ms--ms-linear-gradient(top, #fff, #f5f5f5);
        background-image: -ms-linear-gradient(to bottom, #fff, #f5f5f5);
        background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #fff), color-stop(100%, #f5f5f5));
        background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #fff), color-stop(100%, #f5f5f5));
        background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #fff), color-stop(100%, #f5f5f5));
        background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #fff), color-stop(100%, #f5f5f5));
        background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #fff), color-stop(100%, #f5f5f5));
        background-image: -webkit--webkit-linear-gradient(top, #fff, #f5f5f5);
        background-image: -webkit--moz-linear-gradient(top, #fff, #f5f5f5);
        background-image: -webkit--o-linear-gradient(top, #fff, #f5f5f5);
        background-image: -webkit--ms-linear-gradient(top, #fff, #f5f5f5);
        background-image: -webkit-linear-gradient(to bottom, #fff, #f5f5f5);
        background-image: -o--webkit-linear-gradient(top, #fff, #f5f5f5);
        background-image: -o--moz-linear-gradient(top, #fff, #f5f5f5);
        background-image: -o--o-linear-gradient(top, #fff, #f5f5f5);
        background-image: -o--ms-linear-gradient(top, #fff, #f5f5f5);
        background-image: -o-linear-gradient(to bottom, #fff, #f5f5f5);
        background-image: -webkit-linear-gradient(top, #fff, #f5f5f5);
        background-image: -moz-linear-gradient(top, #fff, #f5f5f5);
        background-image: -o-linear-gradient(top, #fff, #f5f5f5);
        background-image: -ms-linear-gradient(top, #fff, #f5f5f5);
        background-image: linear-gradient(to bottom, #fff, #f5f5f5);
    }

    .classifiedDetailContent .classifiedOtherBoxes .userContactInfo li:first-child {
        border-top: 0;
    }

    .classifiedDetailContent .classifiedOtherBoxes .userContactInfo li {
        padding: 10px 7px;
        border-top: 1px solid #c9c9c9;
    }

    .classifiedDetailContent .classifiedOtherBoxes .userContactInfo strong {
        width: 27px;
        display: inline-block;
        font-weight: bold;
    }

    .classifiedDetailContent .classifiedOtherBoxes .userContactInfo span.show-part {
        display: inline-block;
    }

    .classifiedDetailContent .classifiedOtherBoxes .userContactInfo span {
        text-align: right;
        display: inline-block;
        font-size: 13px;
        float: right;
    }

    .classifiedDetailContent .classifiedOtherBoxes .classifiedUserContent .link-wrapper {
        text-align: center;
    }

    .classifiedDetailContent .classifiedOtherBoxes .askQuestion {
        display: inline-block;
        padding: 8px 0;
        font-size: 11px;
        text-shadow: 1px 1px 0 #fff;
    }

    .classifiedDetailContent .classifiedIdBox {
        font-size: 11px;
        color: #333;
        text-align: left;
        padding: 0px 0px 0px 50px;
    }

    .classifiedDetailContent .classifiedFeedback {
        display: inline-block;
        position: relative;
        height: 20px;
        padding: 0;
        margin-left: 10px;
        text-decoration: none;
    }

    .nav-tabs {
        border-bottom: 1px solid #ffc000 !important;
    }

    .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover {
        color: #555;
        cursor: default;
        background-color: #ffc000 !important;
        border: 1px solid #ddd;
        border-bottom-color: transparent;
        font-weight: bold;
    }

    .classifiedDetailContent .classifiedInfo .classifiedInfoList strong {
        width: 130px;
        padding-right: 10px;
        float: left;
    }

    .classifiedId {
        float: right;
    }

    .classifiedBreadCrumbBackground {
        position: absolute;
        left: 0;
        width: 100%;
        height: 27px;
        z-index: 1;
        background-color: #f2f2f2;
        background-repeat: repeat-x;
        -webkit-box-shadow: 0 2px 3px 0 rgb(0 0 0 / 10%), 0 0 4px 0 rgb(0 0 0 / 6%), 1px 0 2px 0 rgb(0 0 0 / 8%);
        box-shadow: 0 2px 3px 0 rgb(0 0 0 / 10%), 0 0 4px 0 rgb(0 0 0 / 6%), 1px 0 2px 0 rgb(0 0 0 / 8%);
    }

    .classifiedBreadCrumb {
        position: relative;
        width: 100%;
        height: 27px;
        z-index: 1;
    }

    .classifiedBreadCrumb ol {
        margin: auto;
        zoom: 1;
        line-height: 15px;
    }

    .classifiedBreadCrumb ol li {
        float: left;
        padding: 5px 0 0 0;
        margin-right: 15px;
    }

    .classifiedBreadCrumb .breadcrumbItem a {
        max-width: 110px;
        overflow: hidden;
        white-space: nowrap;
        -o-text-overflow: ellipsis;
        text-overflow: ellipsis;
    }

    .classifiedBreadCrumb ol li a {
        color: #00339f;
        padding-left: 10px;
        background: url(/assets/site/img/detail.png) 1px -915px no-repeat;
        font-size: 11px;
        display: inline-block;
    }

    .classifiedBreadCrumb ol:after {
        clear: both;
    }

    .classifiedBreadCrumb ul:before, .classifiedBreadCrumb ol:after {
        display: table;
        content: "";
        zoom: 1;
    }

    .view-listing .listing-heading .listing-heading-wrapper {
        padding: revert;
    }

    ol#uiBreadCrumb.wide-container {
        padding: initial;
    }

    .view-listing .listing-heading .listing-heading-wrapper .link {
        display: inline-block;
        color: #00339f !important;
        font-size: 11px;
        margin-right: 10px;
        opacity: 1;
        transition: all 0.3s ease;
    }

    .classifiedDetailContent .classifiedFeedback:before {
        content: '';
        background-image: url(/assets/site/img/classifiedDetail.png);
        background-position: -93px -166px;
        width: 13px;
        height: 13px;
        content: '';
        display: inline-block;
        vertical-align: middle;
        height: 13px;
        display: block;
        width: 13px;
        position: absolute;
        top: 8px;
        left: -20px;
    }

    .view-listing .listing-gallery .img-wrapper {
        width: 100%;
    }

    .view-listing .listing-gallery .thb-wrapper ul li img {
        opacity: 1;
    }

    .classifiedDetailThumbListContainer {
        border-width: 0 1px 1px 1px;
        border-style: solid;
        border-color: #dbdbdb;
        overflow: hidden;
    }

    .classifiedDetailThumbListContainer .classifiedDetailThumbListPages {
        -webkit-transition-property: transform;
        -moz-transition-property: transform;
        -o-transition-property: transform;
        -webkit-transition-property: -webkit-transform;
        -moz-transition-property: -moz-transform;
        -o-transition-property: -o-transform;
        -ms-transition-property: -ms-transform;
        transition-property: transform;
        -webkit-transition-duration: .4s;
        -moz-transition-duration: .4s;
        -o-transition-duration: .4s;
        -webkit-transition-duration: .4s;
        -moz-transition-duration: .4s;
        -o-transition-duration: .4s;
        -ms-transition-duration: .4s;
        transition-duration: .4s;
    }

    .classifiedDetailThumbListContainer li {
        float: left;
    }

    .classifiedDetailThumbList {
        width: 480px;
        height: auto;
        overflow: hidden;
        zoom: 1;
    }

    #container .classifiedDetailContent .classifiedDetailPhotos .classifiedDetailThumbList {
        width: 528px;
        height: 165px;
    }

    .classifiedDetailThumbList:before, .classifiedDetailThumbList:after {
        display: table;
        content: "";
        zoom: 1;
    }

    .classifiedDetailThumbList li {
        float: left;
        margin: 5px 0 0 5px;
        cursor: pointer;
        position: relative;
        width: 90px;
        height: 68px;
    }


    .classifiedDetailThumbList li label {
        cursor: pointer;
        width: 88px;
        height: 66px;
    }

    .classifiedDetailThumbList li label:before {
        position: absolute;
        z-index: 11;
        width: 100%;
        height: 100%;
        content: " ";
    }

    .classifiedDetailThumbList li label img:first-child {
        z-index: 1;
    }

    .classifiedDetailThumbList li label img {
        width: 88px;
        height: 66px;
        position: absolute;
        left: 0;
    }

    .classifiedDetailThumbList:after {
        clear: both;
    }

    .clearfix:after {
        visibility: hidden;
        display: block;
        font-size: 0;
        content: " ";
        clear: both;
        height: 0;
    }

    .tab {
        overflow: hidden;
        border-bottom: 2px solid #ffc000;

    }

    /* Style the buttons inside the tab */
    .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-size: 17px;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
        background-color: #ffc000;
    }

    /* Style the tab content */
    .tabcontent {
        display: none;
        padding: 4px 12px 0 0;
        border: 2px solid #ccc;
        border-top: none;
        padding-left: 30px;
        margin-top: 18px;

        margin-bottom: 2%;
    }

    .fix-pad {
        padding: 0 50px;
    }

    .classifiedDetailContent .col-lg-3, .classifiedDetailContent .col-lg-5, .classifiedDetailContent .col-lg-4 {
        display: flex;
        justify-content: center;
    }

    .classifiedDetailContent .col-lg-4 {
        justify-content: flex-end !important;
    }



        @media only screen and (max-width: 1348px) {
            .classifiedDetailMainPhoto {
                width: 800px;
            }

            .classifiedDetailContent .col-lg-3 {
                display: block !important;
                float: none !important;
                width: 50%;
            }

            .classifiedDetailContent .col-lg-4 {
                justify-content: flex-end !important;
                width: 58% !important;
            }
        }

        @media only screen and (max-width: 1057px) {
            .classifiedDetailMainPhoto {
                width: 250px;
            }

            .classifiedDetailContent .classifiedInfo h2 {
                margin-left: 0 !important;
            }

            .classifiedInfoList {
                padding-left: 0;
            }

            #classifiedDetail {
                padding: 30px 0 0 0 !important;
            }

            .classifiedDetailMainPhoto {
                width: 600px !important;
            }

        }

        @media only screen and (max-width: 1034px) {
            .classifiedDetailMainPhoto {
                width: 800px !important;
            }

            .classifiedDetailConte .col-md-3 {
                width: 51% !important;
            }
        }

        @media only screen and (max-width: 580px) {
            .classifiedDetailMainPhoto {
                width: 250px !important;
            }

            .classifiedDetailThumbListContainer {
                width: 250px;
            }

            .classifiedOtherDetails .mini-tab-content {
                margin-top: 20%;
            }

            .classifiedInfo h2 {
                margin-left: 0;
            }

            .classifiedInfoList {
                padding-left: 0;
            }

            .classifiedDetailContent .classifiedInfo {
                width: 240px;
            }

            .classifiedDetailContent .classifiedOtherBoxes .classifiedUserContent {
                width: 240px;
            }
            .classifiedDetailContent .col-lg-4
            {
                display: block;
            }
        }


</style>
<link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src = "https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
   $(document).ready(function () {
      $(".inappropriate-reporting-button").html("I Have A Complaint About The Ad");
      $(".inappropriate-reporting-button").removeClass("btn-as");
   });

</script>
<div class = "view-listing">
   <section class = "listing-heading">
      <div class = "listing-heading-wrapper">
         <div class = "container-fluid">
            <div class = "fix-pad">
               <div class = "classifiedBreadCrumbBackground"></div>
               <div class = "classifiedBreadCrumb" data-search-type = "category/category_breadcrumb">
                  <ol id = "uiBreadCrumb" class = "wide-container" itemscope = "" itemtype = "http://schema.org/BreadcrumbList">
                     <li class = "breadcrumbItem" itemprop = "itemListElement" itemscope = "" itemtype = "http://schema.org/ListItem">
                        <a itemprop = "item" href = "<?= url(['/']); ?>">
									   <span itemprop = "name">
										   <font style = "vertical-align: inherit;">
											   <font style = "vertical-align: inherit;">
										           Home
											   </font>
										   </font>
									    </span>
                        </a>
                        <meta itemprop = "position" content = "1">
                     </li>
                      <?php $_categoryParents = Category::getAllParents($ad->category_id);
                      $categoryParents = array_reverse($_categoryParents);
                      foreach ($categoryParents as $categoryParent) { ?>
                         <li class = "breadcrumbItem" itemprop = "itemListElement" itemscope = "" itemtype = "">
                            <a itemprop = "item" href = "<?= url(['category/index', 'slug' => $categoryParent['slug']]); ?>">
											   <span itemprop = "name">
												   <font style = "vertical-align: inherit;">
													   <font style = "vertical-align: inherit;">
														   <?= html_encode($categoryParent['name']); ?>
													   </font>
												   </font>
												</span>
                            </a>
                            <meta itemprop = "position" content = "1">
                         </li>

                      <?php } ?>
                      <?php if ($ad->isOwnedBy(app()->customer->id)) { ?>

                         <li class = "breadcrumbItem actions hidden-xs" itemprop = "itemListElement" itemscope = "" itemtype = "">
                            <a itemprop = "item" href = "<?= url(['/listing/update/', 'slug' => $ad->slug]); ?>" class = "btn-as danger-action">
											   <span itemprop = "name">
												   <font style = "vertical-align: inherit;">
													   <font style = "vertical-align: inherit;">
														  <?= t('app', 'Revise'); ?>
													   </font>
												   </font>
												</span>
                            </a>
                            <meta itemprop = "position" content = "1">
                         </li>

                      <?php } ?>

                  </ol>
               </div>
               <div id = "classifiedDetail">
                  <div class = "classifiedDetail">
                     <div class = "classifiedDetailTitle">
                        <h2 style = "width: 100%"><?= html_encode(mb_strtoupper($ad->title)); ?></h2><br/>
                        <ul class = "classifiedEvents ">
                            <?php if (!$ad->isExpired) { ?>
                               <li class = "add-to-favorites last">
                                   <?php if ($ad->isFavorite) { ?>
                                      <a href = "#" rel = "nofollow" class = "link classifiedRemoveFavorite add-to-favorites favorite-listing" data-stats-type = "<?= ListingStat::FAVORITE; ?>" data-add-msg = "<?= t('app', 'Add to Favorites'); ?>" data-remove-msg = "<?= t('app', 'Remove From My Favorites'); ?>" data-favorite-url = "<?= url(['/listing/toggle-favorite']); ?>" data-listing-id = "<?= (int)$ad->listing_id; ?>">
                                         <span><?= t('app', 'Remove From My Favorites'); ?></span>
                                      </a>
                                   <?php } else { ?>
                                      <a href = "#" rel = "nofollow" class = "link classifiedAddFavorite add-to-favorites favorite-listing" data-stats-type = "<?= ListingStat::FAVORITE; ?>" data-add-msg = "<?= t('app', 'Add to Favorites'); ?>" data-remove-msg = "<?= t('app', 'Remove From My Favorites'); ?>" data-favorite-url = "<?= url(['/listing/toggle-favorite']); ?>" data-listing-id = "<?= (int)$ad->listing_id; ?>">
                                         <span><?= t('app', 'Add to Favorites'); ?></span>
                                      </a>
                                   <?php } ?>

                               </li>
                            <?php } ?>
                           <li>
                              <a rel = "nofollow" class = "classifiedPrint" id = "yazdir" onClick = "window.print()">
                                 Print
                              </a>
                           </li>
                           <li class = "share-icons">
                              <a target = "_blank" id = "shareOnFacebook" href = "https://www.facebook.com/sharer/sharer.php?u=<?= url(['/listing/index/', 'slug' => $ad->slug], true); ?>" rel = "nofollow" class = "pop-link tipitip-trigger share-icon facebook trackClick" data-content = "" data-position = "north" data-click-category = "İlan Detay Events" data-click-event = "" data-click-label = "Facebook" data-listing-id = "<?= (int)$ad->listing_id; ?>" data-stats-type = "<?= ListingStat::FACEBOOK_SHARES; ?>">
                                 Share with Facebook
                              </a>
                              <a id = "shareOnTwitter" target = "_blank" href = "https://twitter.com/intent/tweet?text=<?= html_encode($ad->title); ?>&url=<?= url(['/listing/index/', 'slug' => $ad->slug], true); ?>" rel = "nofollow" class = "pop-link tipitip-trigger share-icon twitter trackClick" data-content = "" data-position = "north" data-click-category = "İlan Detay Events" data-click-event = "" data-click-label = "Twitter">
                                 Share with Twitter
                              </a>
                              <a id = "shareOnEmail" href = "mailto:?subject=<?= html_encode($ad->title); ?>&body=<?= t('app', 'Read More:'); ?><?= url(['/listing/index/', 'slug' => $ad->slug], true); ?>" rel = "nofollow" class = "tipitip-trigger share-icon email trackClick" data-content = "" data-position = "north" data-click-category = "" data-click-event = "" data-click-label = "E-mail" data-listing-id = "<?= (int)$ad->listing_id; ?>" data-stats-type = "<?= ListingStat::MAIL_SHARES; ?>">
                                 Send by email
                              </a>
                           </li>
                        </ul>
                     </div>
                     <div class = "classifiedDetailContent">
                        <div class = "row">
                           <div class = "col-lg-5 col-md-6 col-sm-12">
                              <div class = "classifiedDetailPhotos">
                                 <div class = "classifiedDetailMainPhoto">
                                    <div dir = "ltr" class = "listing-gallery">
                                       <div dir = "ltr" class = "img-wrapper <?= $fullWidthGallery; ?>">

                                          <span dir = "ltr" class = "zoom"><i dir = "ltr" class = "fa fa-search-plus" aria-hidden = "true"></i></span>


                                          <div dir = "ltr" class = "small-gallery owl-carousel owl-theme">
                                              <?php foreach ($images as $image) { ?>

                                                 <div dir = "ltr" class = "item open-full-gallery"><img class = "resizeImg" src = "<?= $image->image; ?>" alt = ""/></div>

                                              <?php } ?>
                                          </div>
                                           <?php if ($showGalleryArrows) { ?>
                                              <a href = "javascript:void(0);" class = "arrow-gallery gallery-left"><?= SvgHelper::getByName('arrow-left'); ?></a>
                                              <a href = "javascript:void(0);" class = "arrow-gallery gallery-right"><?= SvgHelper::getByName('arrow-right'); ?></a>
                                           <?php } ?>


                                       </div>

                                    </div>
                                 </div>
                                 <div class = "classifiedDetailThumbListContainer">
                                    <ul class = "classifiedDetailThumbListPages clearfix page-one" style = "padding: 0">
                                       <li>
                                          <ul class = "classifiedDetailThumbList" style = "padding: 0">
                                              <?php $counterImage = 0;

                                              foreach ($images as $image) {

                                                  $counterImage++;

                                                  if ($counterImage == 1) continue; ?>
                                                 <li>
                                                    <label for = "images_0" class = "" data-megaindex = "0">
                                                       <img class = "thmbImg" src = "<?= $image->image; ?>" alt = "">
                                                    </label>
                                                 </li>
                                                  <?php if ($counterImage == 4) break;

                                              } ?>

                                          </ul>
                                       </li>

                                    </ul>

                                 </div>
                              </div>
                           </div>
                           <div class = "col-lg-4 col-md-3 col-sm-12">
                              <div class = "classifiedInfo ">


                                 <h2 style = "font-size:16px;margin-top: 14%;margin-left: 13%;">
                                     <?= html_encode($ad->getPriceAsCurrency($ad->currency->code)); ?><span>&nbsp;<?= $ad->isNegotiable() ? t('app', 'Negotiable') : ''; ?>
								 <div id = "price-history-wrapper" class = "price-history-wrapper">
									<div id = "price-icon-wrapper" class = "price-history-wrapper tipitip-trigger price-history-icon" data-class = "price-history" data-position = "south" data-content = "İlan Fiyat Tarihçesi">
									</div>
                                    <span id = "splash-price-history-icon"></span>

								</div>
                                 </h2>


                                 <ul class = "classifiedInfoList">
                                     <?php if (!empty($ad->categoryFieldValues)) {

                                         $labelValueFields = [];

                                         foreach ($ad->categoryFieldValues as $field) {

                                             if ($field->field->type->name != 'checkbox' && $field->field->type->name != 'url' && !empty($field->value)) {

                                                 $labelValueFields[] = $field;

                                             }

                                         }

                                         if ($labelValueFields) {
                                             foreach ($labelValueFields as $field) { ?>
                                                <li>
                                                   <strong>
                                                      <font style = "vertical-align: inherit;">
                                                         <font style = "vertical-align: inherit;">
                                                             <?= html_encode($field->field->label); ?>
                                                         </font>
                                                      </font>
                                                   </strong>&nbsp;
                                                   <span class = "classifiedId" id = "classifiedId">
												<font style = "vertical-align: inherit;">
													<font style = "vertical-align: inherit;">
														<?= html_encode($field->value); ?> <?= ($field->field->unit) ? html_encode($field->field->unit) : ''; ?>
													</font>
												</font>
											</span>
                                                </li>
                                                 <?php
                                             }
                                         }
                                     } ?>


                                 </ul>


                                 <p class = "classifiedIdBox  ">
                                    <a href = "javascript:" rel = "nofollow" class = "classifiedFeedback">
                                        <?php app()->trigger('app.ad.under.listingInfo', new Event(['params' => ['ad' => $ad]])); ?>
                                    </a>
                                 </p>
                              </div>
                           </div>
                           <div class = "col-lg-3 col-md-4 col-sm-12">
                              <div class = "classifiedOtherBoxes ">
                                 <div class = "classifiedUserBox classified-owner-info">

                                    <div class = "classifiedUserContent ">

                                       <div class = "username-info-area" data-hj-suppress = "">
                                          <h5>
                                             <font style = "vertical-align: inherit;">
                                                <font style = "vertical-align: inherit;">
                                                    <?php if (empty($ad->customer->stores) || $ad->customer->stores->status !== CustomerStore::STATUS_ACTIVE) {

                                                        echo html_encode($ad->customer->getFullName());

                                                    }
                                                    else { ?>

                                                       <a href = "<?= url(['/store/index', 'slug' => $ad->customer->stores->slug]); ?>">

                                                           <?= html_encode($ad->customer->stores->store_name); ?>

                                                       </a>

                                                    <?php } ?>
                                                </font>
                                             </font>
                                          </h5>
                                       </div>

                                       <div class = "getUserInfo noBorder">

                                          <p class = "userRegistrationDate">
                                             <font style = "vertical-align: inherit;">
                                                <font style = "vertical-align: inherit;">
                                                   Address: <?= html_encode($ad->location->getAddress()); ?>
                                                </font>
                                             </font>

                                          </p>

                                       </div>
                                       <ul id = "phoneInfoPart" class = "userContactInfo" data-hj-suppress = "">
                                          <li>
                                             <strong class = "mobile"><font style = "vertical-align: inherit;"><font style = "vertical-align: inherit;">Number</font></font></strong>
                                             <span class = "pretty-phone-part show-part">
																	<font style = "vertical-align: inherit;">
																		<font style = "vertical-align: inherit;">
																			<?php if (((options()->get('app.settings.common.guestContactSellers', 1) == 1) && (app()->customer->isGuest == true)) || (app()->customer->isGuest == false)) { ?>
                                                             <?php if (!$ad->hide_phone) { ?>
                                                               <a href = "#" id = "listing-show-phone" class = "track-stats" data-stats-type = "<?= ListingStat::SHOW_PHONE; ?>" data-listing-id = "<?= (int)$ad->listing_id; ?>" data-url = "<?= url(['/listing/get-customer-contact']); ?>" data-customer-id = "<?= (int)$ad->customer->customer_id; ?>"><?= t('app', 'Show Number'); ?></a>
                                                             <?php }
                                                         } ?>

																		</font>
																	</font>
															   </span>
                                          </li>
                                          <li style = "margin-top: 2%">
                                             <strong class = "mobile"><font style = "vertical-align: inherit;"><font style = "vertical-align: inherit;">Email</font></font></strong>
                                             <span class = "pretty-phone-part show-part">
																	<font style = "vertical-align: inherit;">
																		<font style = "vertical-align: inherit;">
																			<?php if (((options()->get('app.settings.common.guestContactSellers', 1) == 1) && (app()->customer->isGuest == true)) || (app()->customer->isGuest == false)) { ?>
                                                             <?php if (!$ad->hide_email) { ?>
                                                               <a href = "#" id = "listing-show-email" class = "track-stats" data-stats-type = "<?= ListingStat::SHOW_MAIL; ?>" data-listing-id = "<?= (int)$ad->listing_id; ?>" data-url = "<?= url(['/listing/get-customer-contact']); ?>" data-customer-id = "<?= (int)$ad->customer->customer_id; ?>"><?= t('app', 'Show Email'); ?></a>
                                                             <?php }
                                                         } ?>

																		</font>
																	</font>
															   </span>
                                          </li>
                                       </ul>
                                       <div class = "link-wrapper">
                                          <a rel = "nofollow" href = "#" id = "askQuestionLink" class = "askQuestion trackClick link send-message" data-click-category = "İlan Detay Events" data-click-event = "Click - İlan Sahibi Alanı" data-click-label = "İlan Sahibine Soru Sor"
                                             data-toggle = "modal" data-target = "#send-message-form">
                                             <font style = "vertical-align: inherit;">
                                                <font style = "vertical-align: inherit;">
                                                   Send Message
                                                </font>
                                             </font>
                                          </a>
                                       </div>

                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class = "classifiedOtherDetails">
                     <div class = "row">
                        <div class = "col-12">
                           <div id = "classified-tabs" class = "mini-tab">
                              <div class = "tab">
                                 <button class = "tablinks active" onclick = "openDetail(event, 'listing')">Listing Detail</button>
                                 <button class = "tablinks" onclick = "openDetail(event, 'location')">Locations</button>
                                 <button class = "tablinks" onclick = "openDetail(event, 'specifications')">Technical Specifications</button>
                              </div>
                           </div>
                        </div>
                        <div class = "col-12">
                           <div id = "classified-detail" class = "mini-tab-content">
                              <div id = "listing" class = "tabcontent" style = "display: block">
                                 <h3>Listing Detail</h3>
                                 <p><?= html_purify($ad->description); ?></p>
                              </div>

                              <div id = "location" class = "tabcontent">
                                 <h3>Location</h3>
                                 <p> <?php if (options()->get('app.settings.common.disableMap', 0) == 0){ ?>

                                 <div id = "map" style = "height: 500px;background-color: #eeebe8; filter: blur(10px);

											-webkit-filter: blur(5px);

											-moz-filter: blur(5px);

											-o-filter: blur(5px);

											-ms-filter: blur(5px);">
                                 </div>

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

                                 <script src = "https://maps.googleapis.com/maps/api/js?key=<?= html_encode(options()->get('app.settings.common.siteGoogleMapsKey', '')); ?>"></script>

                                  <?php } ?>
                                 </p>
                              </div>

                              <div id = "specifications" class = "tabcontent classifiedDetailContent">

                                 <h3>Technical Specification</h3>
                                 <div class = "classifiedInfo" style = "display: contents">

                                    <ul class = "classifiedInfoList" style = "padding: 0;">
                                        <?php if (!empty($ad->categoryFieldValues)) {

                                            $labelValueFields = [];

                                            foreach ($ad->categoryFieldValues as $field) {

                                                if ($field->field->type->name != 'checkbox' && $field->field->type->name != 'url' && !empty($field->value)) {

                                                    $labelValueFields[] = $field;

                                                }

                                            }

                                            if ($labelValueFields) {
                                                foreach ($labelValueFields as $field) { ?>
                                                   <li>
                                                      <strong>
                                                         <font style = "vertical-align: inherit;">
                                                            <font style = "vertical-align: inherit;">
                                                                <?= html_encode($field->field->label); ?>
                                                            </font>
                                                         </font>
                                                      </strong>&nbsp;
                                                      <span class = "classifiedId" id = "classifiedId">
													<font style = "vertical-align: inherit;">
														<font style = "vertical-align: inherit;">
															<?= html_encode($field->value); ?> <?= ($field->field->unit) ? html_encode($field->field->unit) : ''; ?>
														</font>
													</font>
												</span>
                                                   </li>
                                                    <?php
                                                }
                                            }
                                        } ?>


                                    </ul>


                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<div class = "modal fade" id = "send-message-form" tabindex = "-1" role = "dialog" aria-labelledby = "exampleModalLabel" aria-hidden = "true">
   <div class = "modal-dialog" role = "document">
      <div class = "modal-content">
         <div class = "modal-header">
            <h5 class = "modal-title" id = "exampleModalLabel">Send Message</h5>
            <!--        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
            -->
         </div>
         <div class = "modal-body">
             <?php if (((options()->get('app.settings.common.guestContactSellers', 1) == 1) && (app()->customer->isGuest == true)) || (app()->customer->isGuest == false)) { ?>
                 <?= SendMessageWidget::widget(['listingSlug' => $ad->slug]); ?>
             <?php } ?>
         </div>
         <div class = "modal-footer">
            <button type = "button" class = "btn btn-secondary" data-dismiss = "modal">Close</button>

         </div>
      </div>
   </div>
</div>
<script>
   function openDetail(evt, cityName) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
         tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
         tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";
   }

</script>


