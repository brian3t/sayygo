<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "keyword".
 *
 * @property integer $id
 * @property string $description
 *
 * @property KeywordSayygo[] $keywordSayygos
 * @property Sayygo[] $sayygos
 */
class Keyword extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'keyword';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'required'],
            [['description'], 'string', 'max' => 800]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKeywordSayygos()
    {
        return $this->hasMany(KeywordSayygo::className(), ['keyword_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSayygos()
    {
        return $this->hasMany(Sayygo::className(), ['id' => 'sayygo_id'])->viaTable('keyword_sayygo', ['keyword_id' => 'id']);
    }
}
