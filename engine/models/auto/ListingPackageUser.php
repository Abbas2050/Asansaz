<?php

namespace app\models\auto;

use Yii;

class ListingPackageUser extends \app\yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ea_listing_package_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            [['user_id','package_id','remaining_ads'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'Id',
            'user_id'       => Yii::t('app', 'User Id'),
            'package_id'    => Yii::t('app', 'Package Id'),
            'remaining_ads' => Yii::t('app', 'Remaining Ads'),
            'created_at'    => Yii::t('app', 'Created At'),
            'updated_at'    => Yii::t('app', 'Updated At'),
        ];
    }

}
