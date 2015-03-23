<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "action".
 *
 * @property integer $id
 * @property string $type
 * @property string $detail
 * @property string $timestamp
 * @property integer $cuser_id
 * @property integer $project_id
 *
 * @property Cuser $cuser
 * @property Project $project
 */
class Action extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'action';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'string'],
            [['timestamp'], 'safe'],
            [ [ 'cuser_id','project_id' ],'required' ],
            [ [ 'cuser_id','project_id' ],'integer' ],
            [['detail'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'detail' => 'Detail',
            'timestamp' => 'Timestamp',
            'cuser_id' => 'Cuser ID',
            'project_id' => 'Project ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuser()
    {
        return $this->hasOne( Cuser::className(),[ 'id' => 'cuser_id' ] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }
}
