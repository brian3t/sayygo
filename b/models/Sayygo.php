<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "sayygo".
 *
 * @property integer $id
 * @property string $full_text
 * @property integer $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $type_id
 * @property string $status
 * @property string $start_date
 * @property string $end_date
 * @property integer $is_active_mode
 * @property string $notification_frequency
 * @property string $partner_sex
 * @property string $partner_experience
 * @property string $partner_num_preference
 * @property integer $num_of_partner
 *
 * @property KeywordSayygo[] $keywordSayygos
 * @property Keyword[] $keywords
 * @property User $user
 *
 * @property string keywordIds;
 */
class Sayygo extends \yii\db\ActiveRecord {
	protected static $MATCH_THRESHOLD = 0.7;
	public $keywordIds = '';//to be used for ActiveForm
	public $updatedAtFormatted;//foobar attr for formatting date
	public $createdAtFormatted;//foobar attr for formatting date

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'sayygo';
	}

	/**
	 * @inheritdoc
	 * @var \backend\models\Sayygo $model
	 */
	public function rules() {
		return [
			[ [ 'full_text','user_id' ],'required' ],
			[ [ 'user_id','type_id','is_active_mode','num_of_partner' ],'integer' ],
			[ [ 'created_at','updated_at','start_date','end_date' ],'safe' ],
			[
				[ 'status','notification_frequency','partner_sex','partner_experience','partner_num_preference' ],
				'string'
			],
			[ [ 'full_text' ],'string','max' => 10000 ],
			[
				'num_of_partner',
				'required',
				'when'       => function ( $model ) {
					return ( $model->partner_num_preference == '2 to 10' );
				},
				'whenClient' => "function (attribute, value) {
							        return $('#sayygo-partner_num_preference').val() == '2 to 10';
							    }"
			],
			[
				'num_of_partner',
				'compare',
				'operator'     => '>=',
				'compareValue' => 2,
				'message'      => 'Please select at least 2 partners'
			],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'id'                     => 'ID',
			'full_text'              => 'Full text',
			'user_id'                => 'User ID',
			'created_at'             => 'Created at',
			'CreatedAtFormatted'     => 'Created at',
			'updated_at'             => 'Updated at',
			'UpdatedAtFormatted'     => 'Updated at',
			'type_id'                => 'Type ID',
			'status'                 => 'Status',
			'start_date'             => 'Preferred start date',
			'end_date'               => 'Preferred end date',
			'is_active_mode'         => 'Is Active Mode',
			'notification_frequency' => 'Notification frequency',
			'partner_sex'            => 'Partner\' sex',
			'partner_experience'     => 'Partner\'s experience',
			'partner_num_preference' => 'How many partners is preferred',
			'num_of_partner'         => 'Ideal number of partners',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getKeywordSayygos() {
		return $this->hasMany( KeywordSayygo::className(),[ 'sayygo_id' => 'id' ] );
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getKeywords() {
		return $this->hasMany( Keyword::className(),[ 'id' => 'keyword_id' ] )->viaTable( 'keyword_sayygo',
		                                                                                  [ 'sayygo_id' => 'id' ] );
	}

	public function afterSave( $insert,$changedAttributes ) {
		//associate keywords with sayygo
		$keywordIds = preg_split( '@,@',$this->keywordIds,null,PREG_SPLIT_NO_EMPTY );
		$this->unlinkAll( 'keywords',true );
		foreach ( $keywordIds as $keywordId ) {
			$keyword = keyword::findOne( $keywordId );
			$this->link( 'keywords',$keyword );
		}
		$this->populateKeywordIds();
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUser() {
		return $this->hasOne( User::className(),[ 'id' => 'user_id' ] );
	}

	//getter for Select2 dropdown
	public function getDropdownKeywords() {
		$data = Keyword::find()->asArray()->all();

		return ArrayHelper::map( $data,'id','description' );
	}

	//re-populate the current set of keywords in this sayygo in [1,2,3] format, so that it can be used for the input in ActiveForm
	public function populateKeywordIds() {
		$this->keywordIds = ArrayHelper::getColumn(
			$this->getKeywordSayygos()->asArray()->all(),
			'keyword_id'
		);
		$this->keywordIds = implode( ',',$this->keywordIds );
	}

	/**find matching pairs between two sayygos
	 * max points is defined in $MAX_POINTS
	 * @var $source \backend\models\Sayygo
	 * @var $target \backend\models\Sayygo
	 *
	 * @return: ['key' => ['source value' => 'target value']
	 */
//	public function getMatch($sourceId, $targetId) {
	public static function getMatch( $source,$target ) {
		$source        = $source->getAttributes( null,[ 'id' ] );
		$target        = $target->getAttributes( null,[ 'id' ] );
		$points        = 0;
		$percentCompat = 0;
		unset( $source['id'],$target['id'],$source['created_at'],$target['created_at'],$source['updated_at'],$target['updated_at'],$source['full_text'],$target['full_text'],$source['user_id'],$target['user_id'] );
		$closeMatches = [ ];
		$exactMatches = [ ];
		foreach ( $source as $k => $v ) {
			if ( empty( $v ) && empty( $target[ $k ] ) ) {
				continue;
			}
			$distance = levenshtein( strval( $v ),strval( $target[ $k ] ) ) / max( strlen( strval( $v ) ),
			                                                                       strlen( strval( $target[ $k ] ) ) );
			if ( $distance === 0 ) {
				$exactMatches[ $k ] = [ $v => $target[ $k ] ];
			} elseif
			( $distance < self::$MATCH_THRESHOLD
			) {
				$closeMatches[ $k ] = [ $v => $target[ $k ] ];
				$points += $distance;
			}
		}
		if ( $points > 0 ) {
			$closeMatches['points'] = $points;
		}
		$percentCompat = count( $exactMatches );
		if ( count( $closeMatches ) !== 0 ) {
			$percentCompat += $points / count( $closeMatches );
		}

		return [
			'percentCompat' => $percentCompat,
			'closeMatches'  => $closeMatches,
			'exactMatches'  => $exactMatches
		];
	}

	public function getUpdatedAtFormatted() {
		return \yii::$app->formatter->asDatetime( $this->updated_at,'full' );
	}

	public function getCreatedAtFormatted() {
		return \yii::$app->formatter->asDatetime( $this->created_at,'full' );
	}
}
