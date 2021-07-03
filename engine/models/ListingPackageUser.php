<?php

/**
 *
 * @package    EasyAds
 * @author     CodinBit <contact@codinbit.com>
 * @link       https://store.codinbit.com
 * @copyright  2017 EasyAds (https://store.codinbit.com)
 * @license    https://www.codinbit.com
 * @since      1.0
 */

namespace app\models;

use app\helpers\CommonHelper;
use yii\helpers\ArrayHelper;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/**
 * Class Category
 * @package app\models
 */
class ListingPackageUser extends \app\models\auto\ListingPackageUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['user_id','package_id','remaining_ads'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id'                => 'ID',
            'user_id'           => 'User Id',
            'package_id'        => 'Package Id',
            'remaining_ads'     => 'Remaining Ads',
            'created_at'        => 'Created At',
            'updated_at'        => 'Updated At',
        ]);
    }
    public function getPackage()
    {
        return $this->hasOne(ListingPackage::className(), ['package_id' => 'package_id']);
    }
}
