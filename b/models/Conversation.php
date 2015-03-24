<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "conversation".
 *
 * @property integer $id
 * @property integer $from
 * @property integer $to
 * @property string $message
 * @property string $timestamp
 *
 * @property Cuser $from0
 * @property Cuser $to0
 */
class Conversation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'conversation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['from', 'to'], 'integer'],
            [['timestamp'], 'safe'],
            [['message'], 'string', 'max' => 800]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from' => 'From',
            'to' => 'To',
            'message' => 'Message',
            'timestamp' => 'Timestamp',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrom0()
    {
        return $this->hasOne( Cuser::className(),[ 'id' => 'from' ] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTo0()
    {
        return $this->hasOne( Cuser::className(),[ 'id' => 'to' ] );
    }
}
