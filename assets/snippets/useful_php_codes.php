<?php
/**
 * Created by PhpStorm.
 * User: tri
 * Date: 2/3/15
 * Time: 8:17 AM
 */
NavBar::begin( [
	'brandLabel' => 'Sayygo',
	'brandUrl'   => Yii::$app->homeUrl,
	'options'    => [
		'class' => 'navbar-inverse navbar-fixed-top',
	],
] );
$menuItems = [
	[ 'label' => 'Home','url' => [ '/site/index' ] ],
];
if ( Yii::$app->user->isGuest ) {
	$menuItems[] = [ 'label' => 'Login','url' => [ '/site/login' ] ];
} else {
	$menuItems[] = [
		'label'       => 'Logout (' . Yii::$app->user->identity->username . ')',
		'url'         => [ '/site/logout' ],
		'linkOptions' => [ 'data-method' => 'post' ]
	];
}
echo Nav::widget( [
	'options' => [ 'class' => 'navbar-nav navbar-right' ],
	'items'   => $menuItems,
] );
NavBar::end();
?>
<div class="container">
	<?= Breadcrumbs::widget( [
		'links' => isset( $this->params['breadcrumbs'] ) ? $this->params['breadcrumbs'] : [ ],
	] ) ?>

