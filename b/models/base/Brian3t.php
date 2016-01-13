<?php

namespace backend\models\base;

use Yii;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "brian3t".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $name
 * @property string $date_to_search
 */
class Brian3t extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brian3t';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'date_to_search' => 'Date To Search',
        ];
    }

/**
     * @inheritdoc
     * @return type mixed
     */ 
    public function behaviors()
    {
        return [
            [
                'class' => UUIDBehavior::className(),
                'column' => 'id',
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \backend\models\Brian3tQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\Brian3tQuery(get_called_class());
    }
}
