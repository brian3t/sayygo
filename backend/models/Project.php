<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "project".
 *
 * @property integer $id
 * @property string $address
 * @property string $region
 * @property string $description
 * @property string $status
 * @property double $price
 * @property string $currency
 * @property string $lastupdated
 * @property string $note
 *
 * @property Action[] $actions
 * @property CuserProject[] $cuserProjects
 * @property Cuser[] $cusers
 * @property string $cuserIds;
 */
class Project extends \yii\db\ActiveRecord
{
	public $cuserIds = "";
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'note'], 'string'],
            [['price'], 'number'],
	        [ [ 'cuserIds' ],'safe' ],
	        [ [ 'lastupdated' ],'safe' ],
            [['address'], 'string', 'max' => 500],
            [['region'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 45],
            [['currency'], 'string', 'max' => 3]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'address' => 'Address',
            'region' => 'Region',
            'description' => 'Description',
            'status' => 'Status',
            'price' => 'Price',
            'currency' => 'Currency',
            'lastupdated' => 'Lastupdated',
            'note' => 'Note',
        ];
    }


	// Reset the current set of CUsers in this Project; so that it can be associated with the input in ActiveForm
	public function resetCuserIds() {
		$this->cuserIds = ArrayHelper::getColumn(
			$this->getCuserProjects()->asArray()->all(),
			'cuser_id'
		);
		$this->cuserIds = implode( ',',$this->cuserIds );
	}


	/**
     * @return \yii\db\ActiveQuery
     */
    public function getActions()
    {
        return $this->hasMany(Action::className(), ['project_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
	public function getCuserProjects()
    {
	    return $this->hasMany( CuserProject::className(),[ 'project_id' => 'id' ] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCusers()
    {
	    return $this->hasMany( Cuser::className(),[ 'id' => 'cuser_id' ] )->viaTable( 'cuser_project',[ 'project_id' => 'id' ] );
    }

	public function afterSave( $insert,$changedAttributes ) {
		$cuserIds = preg_split( '@,@',$this->cuserIds,null,PREG_SPLIT_NO_EMPTY );
		$this->unlinkAll( 'cusers',true );
		foreach ( $cuserIds as $cuserId ) {
			$cuser = Cuser::findOne( $cuserId );
			$this->link( 'cusers',$cuser );
		}
		$this->resetCuserIds();

	}

}
