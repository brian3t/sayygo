<?php
Yii::setAlias('common', dirname(__DIR__));
Yii::setAlias('frontend', dirname(dirname(__DIR__)) . '/f');
Yii::setAlias('backend', dirname(dirname(__DIR__)) . '/b');
Yii::setAlias('console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@appRootFolder', realpath(dirname(__FILE__).'/../../'));