<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "website".
 *
 * @property integer $id
 * @property integer $member_id
 * @property string $url
 * @property string $status
 * @property string $status_updated
 * @property string $structure_type
 */
class Website extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'website';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'url'], 'required'],
            [['member_id'], 'integer'],
            [['status', 'structure_type'], 'string'],
            [['status_updated'], 'safe'],
            [['url'], 'string', 'max' => 100],
            [['member_id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'member_id' => 'Member ID',
            'url' => 'Url',
            'status' => 'Status',
            'status_updated' => 'Status Updated',
            'structure_type' => 'Structure Type',
        ];
    }

}
