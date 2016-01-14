<?php

namespace backend\models;

use yii\base\Model;

class Languages extends Model{
	public static $data = array(
        'en' => 'English',
        'es' => 'Spanish',
		'ar' => 'Arabic',
		'cs' => 'Czech',
		'da' => 'Danish',
		'de' => 'German',
		'el' => 'Greek',
		'fa' => 'Persian',
		'fi' => 'Finnish',
		'fr' => 'French',
		'he' => 'Hebrew',
		'hi' => 'Hindi',
		'id' => 'Indonesian',
		'it' => 'Italian',
		'ja' => 'Japanese',
		'ko' => 'Korean',
		'ms' => 'Malay',
		'nl' => 'Dutch',
		'pt' => 'Portuguese',
		'ru' => 'Russian',
		'sv' => 'Swedish',
		'ta' => 'Tamil',
		'th' => 'Thai',
		'tl' => 'Tagalog',
		'vi' => 'Vietnamese',
		'zh' => 'Chinese',
	);

	public function init(){

	}
}