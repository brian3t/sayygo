<?php
namespace console\controllers;

use backend\controllers\SayygoController;
use backend\models\Sayygo;
use yii\console\Controller;


/**
 * Test controller
 */
class MatchController extends Controller{

	public function actionMatchall() {
		echo date("Y-m-d H:i:s"). " Match populating...\n";
		$result = SayygoController::actionMatchall();
		print_r($result);
		echo "Match populating ends.//\n";
	}
	public function actionPurge() {
		echo "Match purging";
	}

}
