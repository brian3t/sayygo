<?php
/**
 * Created by PhpStorm.
 * User: tri
 * Date: 4/14/15
 * Time: 3:23 PM
 */

namespace common\controllers;

use dektrium\user\controllers\ProfileController as BaseProfileController;
use yii\helpers\BaseFileHelper;
use dektrium\user\Finder;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;


class ProfileController extends BaseFileHelper{

	function __construct() {
		print "In ProfileController constructor\n";
	}

	/**
	 * Shows user's profile.
	 * @param  integer $id
	 * @return \yii\web\Response
	 * @throws \yii\web\NotFoundHttpException
	 */
	public function actionShow($id)
	{
		$profile = $this->finder->findProfileById($id);

		if ($profile === null) {
			throw new NotFoundHttpException;
		}

		return $this->render('show', [
			'profile' => $profile,
		]);
	}
}