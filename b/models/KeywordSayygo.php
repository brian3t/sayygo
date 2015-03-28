<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "keyword_sayygo".
 *
 * @property integer $id
 * @property integer $keyword_id
 * @property integer $sayygo_id
 *
 * @property Sayygo $sayygo
 * @property Keyword $keyword
 */
class KeywordSayygo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'keyword_sayygo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['keyword_id', 'sayygo_id'], 'required'],
            [['keyword_id', 'sayygo_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'keyword_id' => 'Keyword ID',
            'sayygo_id' => 'Sayygo ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSayygo()
    {
        return $this->hasOne(Sayygo::className(), ['id' => 'sayygo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKeyword()
    {
        return $this->hasOne(Keyword::className(), ['id' => 'keyword_id']);
    }
}
