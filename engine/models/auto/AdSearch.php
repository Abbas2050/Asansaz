<?php

namespace app\models\auto;

use Yii;

class AdSearch extends \app\yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ea_ad_search';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            [['search_word','category'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'Id',
            'search_word'   => Yii::t('app', 'Search Word'),
            'category'      => Yii::t('app', 'Category'),
            'created_at'    => Yii::t('app', 'Created At'),
            'updated_at'    => Yii::t('app', 'Updated At'),
        ];
    }

}
