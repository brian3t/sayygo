<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cuser_team".
 *
 * @property integer $team_id
 * @property integer $cuser_id
 * @property string $teamrole
 *
 * @property Team $team
 * @property Cuser $cuser
 */
class CuserTeam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
	    return 'cuser_team';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
	        [ [ 'team_id','cuser_id' ],'required' ],
	        [ [ 'team_id','cuser_id' ],'integer' ],
            [['teamrole'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'team_id' => 'Team ID',
            'cuser_id' => 'Cuser ID',
            'teamrole' => 'Teamrole',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
	public function getTeam()
    {
	    return $this->hasOne( Team::className(),[ 'id' => 'team_id' ] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
	public function getCuser()
    {
	    return $this->hasOne( Cuser::className(),[ 'id' => 'cuser_id' ] );
    }
}
