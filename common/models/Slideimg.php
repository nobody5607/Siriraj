<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_slideimg".
 *
 * @property int $id
 * @property string $name
 * @property string $detail
 * @property string $file_path
 */
class Slideimg extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_slideimg';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['detail', 'file_path','view_path'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('section', 'ID'),
            'name' => Yii::t('section', 'Name'),
            'detail' => Yii::t('section', 'Detail'),
            'file_path' => Yii::t('section', 'File Path'),
            'view_path'=>Yii::t('section', 'View Path'),
        ];
    }
}
