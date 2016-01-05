<?php

namespace common\models;

use dektrium\user\models\SettingsForm as BaseSettingsForm;

class SettingsForm extends BaseSettingsForm{
	const SCENARIO_IS_TEMP = 'is_temp';

	public function scenarios()
	{
		$scenarios = parent::scenarios();
		$scenarios [self::SCENARIO_IS_TEMP] = ['username', 'email', 'new_password'];

		return $scenarios;

	}

}