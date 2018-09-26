<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_shipper".
 *
 * @property int $id
 * @property int $user_id
 * @property string $firstname ขื่อ
 * @property string $lastname นามสกุล
 * @property string $sitecode หน่วยงาน
 * @property string $companey_name ที่อยู่
 * @property string $tel เบอร์โทรศัพท์
 * @property string $note
 * @property string $date
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
            [['id', 'firstname', 'lastname'], 'required'],
            [['id', 'user_id'], 'integer'],
            [['companey_name', 'note'], 'string'],
            [['date'], 'safe'],
            [['firstname', 'lastname'], 'string', 'max' => 100],
            [['sitecode'], 'string', 'max' => 255],
            [['tel'], 'string', 'max' => 10],
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
            'user_id' => Yii::t('order', 'User ID'),
            'firstname' => Yii::t('order', 'ขื่อ'),
            'lastname' => Yii::t('order', 'นามสกุล'),
            'sitecode' => Yii::t('order', 'หน่วยงาน'),
            'companey_name' => Yii::t('order', 'ที่อยู่'),
            'tel' => Yii::t('order', 'เบอร์โทรศัพท์'),
            'note' => Yii::t('order', 'Note'),
            'date' => Yii::t('order', 'Date'),
        ];
    }
}
