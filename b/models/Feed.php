<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "feed".
 *
 * @property integer $id
 * @property string $url
 * @property string $description
 */
class Feed extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feed';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url'], 'string', 'max' => 500],
            [['description'], 'string', 'max' => 2000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'description' => 'Description',
        ];
    }
}
