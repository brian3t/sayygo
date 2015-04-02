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
            [['user_id', 'type_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
	        [['keywordIds'],'safe'],
            [['status'], 'string'],
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
