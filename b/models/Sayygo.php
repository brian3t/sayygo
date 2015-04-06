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
 *
 * @property string $start_date
 * @property string $end_date
 * @property integer $is_active_mode
 * @property string $notification_frequency
 * @property string $partner_sex
 * @property string $partner_experience
 * @property string $partner_num_preference
 * @property integer $num_of_partner

 * @property KeywordSayygo[] $keywordSayygos
 * @property Keyword[] $keywords
 * @property User $user
 *
 * @property string keywordIds;
 */
class Sayygo extends \yii\db\ActiveRecord
{
	public $keywordIds = '';//to be used for ActiveForm

	//getter for Select2 dropdown
	public function getDropdownKeywords(){
		$data = Keyword::find()->asArray()->all();
		return ArrayHelper::map($data, 'id','description');
	}
	//re-populate the current set of keywords in this sayygo in [1,2,3] format, so that it can be used for the input in ActiveForm
	public function populateKeywordIds(){
		$this->keywordIds = ArrayHelper::getColumn(
			$this->getKeywordSayygos()->asArray()->all(),
			'keyword_id'
		);
		$this->keywordIds = implode(',', $this->keywordIds);
	}

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sayygo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['full_text', 'user_id'], 'required'],
	        [['user_id', 'type_id', 'is_active_mode', 'num_of_partner'], 'integer'],
	        [['created_at', 'updated_at', 'start_date', 'end_date'], 'safe'],
	        [['status', 'notification_frequency', 'partner_sex', 'partner_experience', 'partner_num_preference'], 'string'],
            [['full_text'], 'string', 'max' => 10000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_text' => 'Full Text',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'type_id' => 'Type ID',
            'status' => 'Status',
            'start_date' => 'Preferred Start Date',
            'end_date' => 'Preferred End Date',
            'is_active_mode' => 'Is Active Mode',
            'notification_frequency' => 'Notification Frequency',
            'partner_sex' => 'Partner\' sex',
            'partner_experience' => 'Partner\'s Experience',
            'partner_num_preference' => 'How many Partners Preferred',
            'num_of_partner' => '#Partner',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKeywordSayygos()
    {
        return $this->hasMany(KeywordSayygo::className(), ['sayygo_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKeywords()
    {
        return $this->hasMany(Keyword::className(), ['id' => 'keyword_id'])->viaTable('keyword_sayygo', ['sayygo_id' => 'id']);
    }

	public function afterSave($insert, $changedAttributes){
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
	public function getUser()
	{
		return $this->hasOne(User::className(), ['id' => 'user_id']);
	}


}
