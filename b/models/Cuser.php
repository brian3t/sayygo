<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "cuser".
 *
 * @property integer $id
 * @property string $name
 * @property string $avatar
 * @property string $phone
 * @property string $email
 * @property string $points
 * @property string $lastactive
 * @property string $password write-only password
 * @property string $apikey
 * @property string $agent_uid
 *
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $auth_key
 * @property integer $role
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Action[] $actions
 * @property Conversation[] $conversations
 * @property CuserProject[] $cuserProjects
 * @property Project[] $projects
 * @property CuserTeam[] $cuserTeams
 * @property Team[] $teams
 * @property string $teamIds
 * @property string $projectIds
 * @property GroupConversation[] $groupConversations
 */
class Cuser extends ActiveRecord {

	const STATUS_DELETED = 0;
	const STATUS_ACTIVE = 10;
	const ROLE_USER = 10;

	public $teamIds = "";
	public $projectIds = "";

	/**
	 * @inheritdoc
	 */
	public function behaviors() {
		return [
			TimestampBehavior::className(),
		];
	}

	//getter for select2 dropdown
	public function getDropdownTeams() {
		$data = Team::find()->asArray()->all();

		return ArrayHelper::map( $data,'id','name' );
	}

	// Reset the current set of Teams in this CUser; so that it can be associated with the input in ActiveForm
	public function resetTeamIds() {
		$this->teamIds = ArrayHelper::getColumn(
			$this->getCuserTeams()->asArray()->all(),
			'team_id'
		);
		$this->teamIds = implode( ',',$this->teamIds );
	}

	// Reset the current set of Projects in this CUser; so that it can be associated with the input in ActiveForm
	public function resetProjectIds() {
		$this->projectIds = ArrayHelper::getColumn(
			$this->getCuserProjects()->asArray()->all(),
			'project_id'
		);
		$this->projectIds = implode( ',',$this->projectIds );
	}

	/**
     * @inheritdoc
     */
	public static function tableName() {
        return 'cuser';
    }

    /**
     * @inheritdoc
     */
	public function rules() {
        return [
	        [ [ 'lastactive' ],'safe' ],
	        [ [ 'teamIds' ],'safe' ],
	        [ [ 'projectIds' ],'safe' ],
	        [ [ 'name' ],'string','max' => 400 ],
	        [ [ 'avatar','agent_uid' ],'string','max' => 255 ],
	        [ [ 'phone' ],'string','max' => 20 ],
	        [ [ 'email' ],'string','max' => 100 ],
	        [ [ 'points' ],'string','max' => 45 ],
	        [ [ 'password','apikey' ],'string','max' => 32 ]
        ];
    }

    /**
     * @inheritdoc
     */
	public function attributeLabels() {
        return [
	        'id'       => 'ID',
	        'name'     => 'Name',
	        'avatar'   => 'Avatar',
	        'phone'    => 'Phone',
	        'email'    => 'Email',
	        'points'   => 'Points',
            'lastactive' => 'Lastactive',
	        'password' => 'Password',
	        'apikey'   => 'Apikey',
            'agent_uid' => 'Agent Uid',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
	public function getActions() {
		return $this->hasMany( Action::className(),[ 'cuser_id' => 'id' ] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
	public function getConversations() {
		return $this->hasMany( Conversation::className(),[ 'to' => 'id' ] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
	public function getCuserProjects() {
		return $this->hasMany( CuserProject::className(),[ 'cuser_id' => 'id' ] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
	public function getProjects() {
		return $this->hasMany( Project::className(),[ 'id' => 'project_id' ] )->viaTable( 'cuser_project',[ 'cuser_id' => 'id' ] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
	public function getCuserTeams() {
		return $this->hasMany( CuserTeam::className(),[ 'cuser_id' => 'id' ] );
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getTeams() {
		return $this->hasMany( Team::className(),[ 'id' => 'team_id' ] )->viaTable( 'cuser_team',[ 'cuser_id' => 'id' ] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
	public function getGroupConversations() {
		return $this->hasMany( GroupConversation::className(),[ 'from' => 'id' ] );
    }

	public function beforeSave( $insert ) {
		if ( parent::beforeSave( $insert ) ) {
			// ...custom code here...
			if ( $insert ) {
				$this->apikey = uniqid( rand(),true );
			}

			return true;
		} else {
			return false;
		}
	}

	public function afterSave( $insert,$changedAttributes ) {
		$teamIds = preg_split( '@,@',$this->teamIds,null,PREG_SPLIT_NO_EMPTY );
		$this->unlinkAll( 'teams',true );
		foreach ( $teamIds as $teamId ) {
			$team = Team::findOne( $teamId );
			$this->link( 'teams',$team );
		}
		$this->resetTeamIds();

		$projectIds = preg_split( '@,@',$this->projectIds,null,PREG_SPLIT_NO_EMPTY );
		$this->unlinkAll( 'projects',true );
		foreach ( $projectIds as $projectId ) {
			$project = Project::findOne( $projectId );
			$this->link( 'projects',$project );
		}
		$this->resetProjectIds();
	}
}
