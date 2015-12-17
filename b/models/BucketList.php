<?php

namespace backend\models;

use Yii;
use \backend\models\base\BucketList as BaseBucketList;

/**
 * This is the model class for table "bucket_list".
 */
class BucketList extends BaseBucketList
{
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'name'], 'required'],
            [['user_id', 'tbl_lock'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 500],
            [['user_id', 'name'], 'unique', 'targetAttribute' => ['user_id', 'name'], 'message' => 'You already have a bucket with this name.'],
            [['tbl_lock'], 'default', 'value' => '0'],
            [['tbl_lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }
	
}
