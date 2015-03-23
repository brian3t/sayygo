<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "badge".
 *
 * @property integer $id
 * @property string $description
 * @property string $image
 */
class Badge extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'badge';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string', 'max' => 255],
            [['image'], 'string', 'max' => 800]
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
            'image' => 'Image',
        ];
    }
}
