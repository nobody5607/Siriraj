<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_files".
 *
 * @property int $id
 * @property string $name
 * @property string $file_type image, video , sound
 * @property string $description files
 * @property int $rstat file ใหญ่ 1000X768,
 * @property string $file_name
 * @property string $file_thumbnail ไฟล์เล็ก,
 * @property string $file_name_org file ต้นฉบับ ทุกคนไม่เห็น
 * @property string $meta_text
 * @property int $content_id
 * @property int $public public, private
 */
class Files extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            [['id'], 'required'],
            [['id', 'rstat', 'content_id', 'public','user_create'], 'integer'],
            [['meta_text','file_path','dir_path'], 'string'],
            [['name', 'file_type', 'description', 'file_name', 'file_thumbnail', 'file_name_org'], 'string', 'max' => 255],
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
            'file_type' => Yii::t('knowledges', 'image, video , sound'),
            'description' => Yii::t('knowledges', 'files'),
            'rstat' => Yii::t('knowledges', 'file ใหญ่ 1000X768,'),
            'file_name' => Yii::t('knowledges', 'File Name'),
            'file_thumbnail' => Yii::t('knowledges', 'ไฟล์เล็ก,'),
            'file_name_org' => Yii::t('knowledges', 'file ต้นฉบับ ทุกคนไม่เห็น'),
            'meta_text' => Yii::t('knowledges', 'Meta Text'),
            'content_id' => Yii::t('knowledges', 'Content ID'),
            'public' => Yii::t('knowledges', 'public, private'),
        ];
    }
}
