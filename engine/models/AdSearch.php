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
class AdSearch extends \app\models\auto\AdSearch
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['search_word','category'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id'                => 'ID',
            'search_word'       => 'Search Word',
            'category'          => 'Category',
            'created_at'        => 'Created At',
            'updated_at'        => 'Updated At',
        ]);
    }
}
