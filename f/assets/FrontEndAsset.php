<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Brian 3T
 */
class FrontEndAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $bower = '@bower';
    public $css = [
        "css/full.css",
	    "css/brianadd.css"
    ];
    public $js = [
        "js/brianadd.js",
        "js/underscore-min.js"

    ];
    public $depends = [
    ];
}
