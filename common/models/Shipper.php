<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_shipper".
 *
 * @property int $id
 * @property string $companey_name
 * @property string $tel
 * @property int $user_id
 */
class Shipper extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_shipper';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstname','lastname'], 'required'], 
            [['id', 'user_id'], 'integer'],
            [['companey_name','firstname','lastname','note'], 'string'],
            [['tel'], 'string', 'max' => 10],
            [['firstname','lastname'], 'string', 'max' => 100],             
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('order', 'ID'),
            'companey_name' => Yii::t('order', 'Companey Name'),
            'tel' => Yii::t('order', 'Tel'),
            'user_id' => Yii::t('order', 'User ID'),
            'Address'=>Yii::t('cart', 'Address'),
            'firstname'=>Yii::t('cart', 'Firstname'),
            'lastname'=>Yii::t('cart', 'Lastname'),
            'tel'=>Yii::t('cart', 'Tel'),
            'note'=>Yii::t('cart', 'Note'),
        ];
    }
}
