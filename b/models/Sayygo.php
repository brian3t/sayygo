<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sayygo".
 *
 * @property integer $id
 * @property string $full_text
 * @property integer $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $type_id
 * @property string $status
 */
class Sayygo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sayygo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['full_text', 'user_id'], 'required'],
            [['user_id', 'type_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['status'], 'string'],
            [['full_text'], 'string', 'max' => 10000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_text' => 'Full Text',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'type_id' => 'Type ID',
            'status' => 'Status',
        ];
    }
}
