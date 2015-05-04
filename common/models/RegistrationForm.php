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
	/** @var string $password_repeat */
	public $password_repeat;
	public $email_repeat;

	/** @inheritdoc */
	public function rules()
	{
		$rules = parent::rules();
		array_push($rules,['password_repeat', 'compare', 'compareAttribute' => 'password']);
		array_push($rules,['email_repeat', 'compare', 'compareAttribute' => 'email']);
		return $rules;
	}

}