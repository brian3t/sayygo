<?php
/**
 * Created by PhpStorm.
 * User: tri
 * Date: 4/7/15
 * Time: 3:42 PM
 * Overriding dektrium profile
 * @property string $my_experience
 *
 * @property string $home_location
 * @property string $phone_number
 * @property string $languages
 */

namespace common\models;

use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use dektrium\user\models\Profile as BaseProfile;
//use yii\web\User;


/**
 * This is the model class for table "profile".
 *
 * @property string  $avatar
 * @property string  $isShowFullName
 * @property string $languages
 *
 * @var UploadedFile avatarFile attribute
 * @author Dmitry Erofeev <dmeroff@gmail.com
 */
class Profile extends BaseProfile {
	public $avatarFile;
	public $isShowFullName;
	public $nameOrFullName;//depends on isShowFullName
    private $languages;
	public function rules() {
		$rules                        = parent::rules();
		$rules['avatarLength']        = [ 'avatar','string','max' => 255 ];
		$rules['avatarFileSkipEmpty'] = [ 'avatarFile','file','skipOnEmpty' => true, ];
		$rules['myExp']               = [ [ 'my_experience' ],'string' ];
		$rules['homeLocation']        = [ [ 'home_location' ],'string','max' => 800 ];
		$rules['phoneNumMax']         = [ [ 'phone_number' ],'string','max' => 20 ];
//		$rules['languageMax']         = [ [ 'languages' ],'string','max' => 200 ];
		$rules['showFullName']        = [ 'is_show_full_name','safe' ];


//		$rules['avatarFileImg'] = ['avatarFile','file','extensions' => 'gif, jpg, png',];
//		$rules['avatarFileIsImage'] = [['avatarFile'], 'file', 'extensions' => 'jpg, png', 'mimeTypes' => 'image/jpeg, image/png'];
		return $rules;
	}

	public function attributeLabels() {
		$al = parent::attributeLabels();
		$al = array_merge( $al,[
			'my_experience'     => 'My Experience',
			'home_location'     => 'Home Location',
			'phone_number'      => 'Phone Number',
			'languages'         => 'Languages',
			'is_show_full_name' => 'Show full name'
		] );

	}

	public function getFullName(){
		return ($this->is_show_full_name?$this->name:false);
	}

    public function getLanguages()
    {
        return $this->languages;
    }

    public function setLanguages($new_languages = "")
    {
        $this->languages = $new_languages;
    }

}