<?php
/**
 * For SB Admin 2.0
 */
namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Brian 3T
 */
class AdminAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $bower = '@bower';
	public $css = [
		"css/sb-admin.css",
		"css/brianadd.css"
	];
	public $js = [
		"js/sb-admin.js",
		"js/brianadd.js",
		"js/plugins/metisMenu/jquery.metisMenu.js",
		"//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"

	];
	public $depends = [
		'backend\assets\AppAsset',
	];
}
