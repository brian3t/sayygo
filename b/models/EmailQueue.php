<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "email_queue".
 *
 * @property integer $id
 * @property integer $to_user_id
 * @property integer $send_copy
 * @property string $type
 * @property string $matching_sayygos
 * @property string $subject
 * @property string $body
 * @property string $notification_frequency
 * @property string $dday
 * @property string $created_on
 * @property string $updated_on
 * @property string $status
 *
 * @property EmailLog[] $emailLogs
 * @property User $toUser
 */
class EmailQueue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'email_queue';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['to_user_id', 'send_copy'], 'integer'],
            [['type', 'notification_frequency', 'status'], 'string'],
            [['dday', 'created_on', 'updated_on'], 'safe'],
            [['matching_sayygos'], 'string', 'max' => 2000],
            [['subject'], 'string', 'max' => 255],
            [['body'], 'string', 'max' => 8000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'to_user_id' => 'To User ID',
            'send_copy' => 'Send Copy',
            'type' => 'Type',
            'matching_sayygos' => 'Matching Sayygos',
            'subject' => 'Subject',
            'body' => 'Body',
            'notification_frequency' => 'Notification Frequency',
            'dday' => 'Dday',
            'created_on' => 'Created On',
            'updated_on' => 'Updated On',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmailLogs()
    {
        return $this->hasMany(EmailLog::className(), ['email_queue_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getToUser()
    {
        return $this->hasOne(User::className(), ['id' => 'to_user_id']);
    }
}
