<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "group_conversation".
 *
 * @property integer $id
 * @property integer $from
 * @property integer $toteam
 * @property string $message
 * @property string $timestamp
 *
 * @property Cuser $from0
 * @property Team $toteam0
 */
class GroupConversation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group_conversation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['from', 'toteam'], 'integer'],
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
            'toteam' => 'Toteam',
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
    public function getToteam0()
    {
        return $this->hasOne(Team::className(), ['id' => 'toteam']);
    }
}
