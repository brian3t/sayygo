<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "team".
 *
 * @property integer $id
 * @property string $name
 *
 * @property CuserTeam[] $cuserTeams
 * @property Cuser[] $cusers
 * @property GroupConversation[] $groupConversations
 */
class Team extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'team';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
	public function getCuserTeams()
    {
	    return $this->hasMany( CuserTeam::className(),[ 'team_id' => 'id' ] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
	public function getCusers()
    {
	    return $this->hasMany( Cuser::className(),[ 'id' => 'cuser_id' ] )->viaTable( 'cuser_team',[ 'team_id' => 'id' ] );
    }

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getGroupConversations() {
		return $this->hasMany( GroupConversation::className(),[ 'toteam' => 'id' ] );
    }
}
