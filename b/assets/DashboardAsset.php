<?php
/**
 * For SB Admin 2.0
 */
namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Brian 3T
 */
class DashboardAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
		"css/plugins/morris/morris-0.4.3.min.css",
		"css/plugins/timeline/timeline.css"
	];
	public $js = [
		"js/plugins/morris/raphael-2.1.0.min.js",
		"js/plugins/morris/morris.js",
//		"js/demo/dashboard-demo.js",

	];
	public $depends = [
		'backend\assets\AdminAsset',
	];
}
