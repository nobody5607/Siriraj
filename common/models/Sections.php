<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_sections".
 *
 * @property int $id
 * @property string $name
 * @property string $content
 * @property int $list_content 0 ไม่มี content,  1 แสดง content ทั้งหมดในตัวมัน,   2 แสดง content ทั้งหมดใต้ตัว
 * @property int $parent_id
 * @property int $forder
 * @property int $public ห้อง public, private
 * @property int $rstat
 */
class Sections extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_sections';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'list_content', 'parent_id', 'forder', 'public', 'rstat'], 'integer'],
            [['content'], 'string'],
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
            'name' => Yii::t('knowledges', 'Section Name'),
            'content' => Yii::t('knowledges', 'Content'),
            'list_content' => Yii::t('knowledges', '0 ไม่มี content,  1 แสดง content ทั้งหมดในตัวมัน,   2 แสดง content ทั้งหมดใต้ตัว'),
            'parent_id' => Yii::t('knowledges', 'Parent'),
            'forder' => Yii::t('knowledges', 'Forder'),
            'public' => Yii::t('knowledges', 'ห้อง Public'),
            'rstat' => Yii::t('knowledges', 'Rstat'),
        ];
    }
}
