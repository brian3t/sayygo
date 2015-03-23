<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cuser_project".
 *
 * @property integer $cuser_id
 * @property integer $project_id
 * @property string $projectrole
 *
 * @property Project $project
 * @property Cuser $cuser
 */
class CuserProject extends \yii\db\ActiveRecord {
	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'cuser_project';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[ [ 'cuser_id','project_id' ],'required' ],
			[ [ 'cuser_id','project_id' ],'integer' ],
			[ [ 'projectrole' ],'string' ]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'cuser_id'    => 'Cuser ID',
			'project_id'  => 'Project ID',
			'projectrole' => 'Projectrole',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getProject() {
		return $this->hasOne( Project::className(),[ 'id' => 'project_id' ] );
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCuser() {
		return $this->hasOne( Cuser::className(),[ 'id' => 'cuser_id' ] );
	}
}
