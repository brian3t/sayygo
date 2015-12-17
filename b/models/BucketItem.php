<?php

namespace backend\models;

use Yii;
use \backend\models\base\BucketItem as BaseBucketItem;

/**
 * This is the model class for table "bucket_item".
 */
class BucketItem extends BaseBucketItem
{
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'bucket_list_id'], 'required'],
            [['bucket_list_id'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }
	
}
