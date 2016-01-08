<?php

namespace backend\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "bucket_list".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $type
 * @property string $created_at
 * @property string $updated_at
 * @property integer $tbl_lock
 *
 * @property \backend\models\BucketItem[] $bucketItems
 * @property \backend\models\User $user
 */
class BucketList extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bucket_list';
    }

    /**
     * 
     * @return string
     * overwrite function optimisticLock
     * return string name of field are used to stored optimistic lock 
     * 
     */
    public function optimisticLock() {
        return 'tbl_lock';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'name' => 'Name',
            'type' => 'Type',
            'tbl_lock' => 'Tbl Lock',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBucketItems()
    {
        return $this->hasMany(\backend\models\BucketItem::className(), ['bucket_list_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\backend\models\User::className(), ['id' => 'user_id']);
    }

/**
     * @inheritdoc
     * @return type mixed
     */ 
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \backend\models\BucketListQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\BucketListQuery(get_called_class());
    }
}
