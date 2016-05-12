<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php wp_head(); ?>
</head>
<body>
	<div class="header">
		<div class="mainheader">
			<div class="wrap mainmenu">
				<?php
					global $current_user;
	      			get_currentuserinfo();
	      		?>
				<div class="logo">
					<img src="<?php echo get_theme_mod('main_logo'); ?>">
				</div>
				<ul class="top">
					<li class="helloname">Hello, <b><?php echo $current_user->user_firstname ?></b></li>
					<li><a href="#">Social</a></li>
					<li><a target="_blank" href="http://www.deltahotels.com">DeltaHotels.com</a></li>
					<li><a target="_blank" href="#">Employee Directory</a></li>
					<li><a target="_blank" href="http://drive.google.com">Google Drive</a></li>
				</ul>
			</div>
		</div>
		<div class="siteheader">
			<div class="wrap sitemenu">
				<ul class="site">
					<li><a href="/">Home</a></li>
					<li>Apps</li>
					<li>Departments</li>
					<li>Hotels</li>
					<li>Committees</li>
					<li>Programs and Promotions</li>
				</ul>
				<div class="search">
					<form action="search">
						<input type="text" name="search">
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="body">
		<div class="wrap">
			<div class="left sidebar">
			</div>
			<div class="content">
			</div>
			<div class="right sidebar">
			</div>

