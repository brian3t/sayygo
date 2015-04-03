<?php
/**
 * Created by PhpStorm.
 * User: tri
 * Date: 4/3/15
 * Time: 9:23 AM
 *
 * Overwriting dektrium's registration form
 */

namespace common\models;

use dektrium\user\models\RegistrationForm as BaseRegistrationForm;

class RegistrationForm extends BaseRegistrationForm{
	/** @var string */
	public $password_repeat;

	/** @inheritdoc */
	public function rules()
	{
		$rules = parent::rules();
		array_push($rules,['password_repeat', 'compare', 'compareAttribute' => 'password']);
		return $rules;
	}

}