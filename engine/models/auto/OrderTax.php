<?php

namespace app\models\auto;

use Yii;

/**
 * This is the model class for table "{{%order_tax}}".
 *
 * @property int $order_tax_id
 * @property int $order_id
 * @property string $tax_name
 * @property double $tax_price
 * @property string $tax_percent
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Order $order
 */
class OrderTax extends \app\yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%order_tax}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'tax_name', 'tax_price', 'tax_percent', 'created_at', 'updated_at'], 'required'],
            [['order_id'], 'integer'],
            [['tax_price', 'tax_percent'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['tax_name'], 'string', 'max' => 255],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'order_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'order_tax_id' => Yii::t('app', 'Order Tax ID'),
            'order_id' => Yii::t('app', 'Order ID'),
            'tax_name' => Yii::t('app', 'Tax Name'),
            'tax_price' => Yii::t('app', 'Tax Price'),
            'tax_percent' => Yii::t('app', 'Tax Percent'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['order_id' => 'order_id']);
    }

    /**
     * {@inheritdoc}
     * @return OrderTaxQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderTaxQuery(get_called_class());
    }
}
