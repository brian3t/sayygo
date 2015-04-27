<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "match_sayygo".
 *
 * @property integer $id
 * @property integer $keyword_id
 * @property integer $sayygo_first_id
 * @property integer $sayygo_second_id
 * @property string $exact_matches
 * @property string $close_matches
 * @property double $compatibility
 * @property string $date_match_start
 * @property string $date_match_end
 * @property string $created_on
 * @property string $updated_on
 *
 * @property Keyword $keyword
 * @property Sayygo $sayygoFirst
 * @property Sayygo $sayygoSecond
 */
class MatchSayygo extends \yii\db\ActiveRecord {
	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'match_sayygo';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[ [ 'keyword_id','sayygo_first_id','sayygo_second_id' ],'required' ],
			[ [ 'keyword_id','sayygo_first_id','sayygo_second_id'],'integer' ],
			[['compatibility'], 'number'],
			[
				[
					'keyword_id',
					'sayygo_first_id',
					'sayygo_second_id',
					'date_match_start',
					'date_match_end',
					'created_on',
					'updated_on',
					'compatibility'
				],
				'safe'
			],
			[ [ 'exact_matches','close_matches' ],'string','max' => 800 ],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'id'               => 'ID',
			'keyword_id'       => 'Keyword ID',
			'sayygo_first_id'  => 'Sayygo First ID',
			'sayygo_second_id' => 'Sayygo Second ID',
			'exact_matches'    => 'Exact Matches',
			'close_matches'    => 'Close Matches',
			'compatibility'    => 'Compatibility',
			'date_match_start' => 'Date Match Start',
			'date_match_end'   => 'Date Match End',
			'created_on'       => 'Created On',
			'updated_on'       => 'Updated On',
		];
	}


	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getKeyword() {
		return $this->hasOne( Keyword::className(),[ 'id' => 'keyword_id' ] );
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getSayygoFirst() {
		return $this->hasOne( Sayygo::className(),[ 'id' => 'sayygo_first_id' ] );
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getSayygoSecond() {
		return $this->hasOne( Sayygo::className(),[ 'id' => 'sayygo_second_id' ] );
	}
}
