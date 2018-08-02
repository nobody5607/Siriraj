<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_contents".
 *
 * @property int $id
 * @property string $name
 * @property string $ description
 * @property int $section_id  tbl_section
 * @property int $rstat
 * @property int $public ห้อง public, private
 * @property string $content_date
 * @property string $create_date
 * @property int $user_create
 */
class Contents extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_contents';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'section_id', 'rstat', 'public', 'user_create'], 'integer'],
            [['description'], 'string'],
            [['content_date', 'create_date'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('knowledges', 'ID'),
            'name' => Yii::t('knowledges', 'Name'),
            'description' => Yii::t('knowledges', 'Description'),
            'section_id' => Yii::t('knowledges', ' tbl_section'),
            'rstat' => Yii::t('knowledges', 'Rstat'),
            'public' => Yii::t('knowledges', 'ห้อง public'),
            'content_date' => Yii::t('knowledges', 'Content Date'),
            'create_date' => Yii::t('knowledges', 'Create Date'),
            'user_create' => Yii::t('knowledges', 'User Create'),
        ];
    }
    public function getSections()
    {
        return $this->hasOne(Sections::class, ['id' => 'section_id']);
    }
}
