<?php

namespace backend\models;

use Yii;
use \backend\models\base\Brian3t as BaseBrian3t;

/**
 * This is the model class for table "brian3t".
 */
class Brian3t extends BaseBrian3t
{
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'date_to_search'], 'safe'],
            [['name'], 'string', 'max' => 45]
        ];
    }
	
}
