<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "email_log".
 *
 * @property integer $id
 * @property integer $email_queue_id
 * @property string $old_status
 * @property string $current_status
 * @property string $created_on
 * @property string $log
 *
 * @property EmailQueue $emailQueue
 */
class EmailLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'email_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email_queue_id'], 'integer'],
            [['old_status', 'current_status'], 'string'],
            [['created_on'], 'safe'],
            [['log'], 'string', 'max' => 1000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email_queue_id' => 'Email Queue ID',
            'old_status' => 'Old Status',
            'current_status' => 'Current Status',
            'created_on' => 'Created On',
            'log' => 'Log',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmailQueue()
    {
        return $this->hasOne(EmailQueue::className(), ['id' => 'email_queue_id']);
    }
}
