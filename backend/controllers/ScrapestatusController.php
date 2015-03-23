<?php
/**
 * Created by PhpStorm.
 * User: tri
 * Date: 1/5/15
 * Time: 1:02 AM
 */
namespace backend\controllers;

use yii\web\Controller;

class ScrapestatusController extends Controller {
	public function actionGet() {
		$stat = 0;
		$stat = file_get_contents(__DIR__. '/scrapestatus.txt');
		return $stat;//1 or 0;
	}
	public function actionToggle() {
		$stat = 0;
		$stat = file_get_contents(__DIR__. '/scrapestatus.txt');
		$stat = ($stat == 0 ? 1 : 0);
		file_put_contents(__DIR__.'/scrapestatus.txt', $stat);
		return $stat;//1 or 0;
	}
}