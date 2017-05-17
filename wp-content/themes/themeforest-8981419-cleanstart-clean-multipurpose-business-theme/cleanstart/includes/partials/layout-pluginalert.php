<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M			      (c) 2014-2015

Layout page: Page

*/
?><!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="utf-8">
<title><?php wp_title('|',1,'right'); ?> <?php bloginfo('name'); ?> | <?php echo __('You are just one step away!', 'cleanstart'); ?></title>
<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Raleway%3A100%2C200%2C300%2C400%2C500%2C600%2C700%2C800%2C900%7COpen+Sans%3A300%2C400%2C600%2C700%2C800%2C300italic%2C400italic%2C600italic%2C700italic%2C800italic&#038;subset=latin&#038;ver=4.0' type='text/css' media='all' />
<?php wp_head(); ?>
<style>
	body { background-color: #41acb9; margin:100px 30px;}
	a { color:#ffee5b;}
	.logo { display:block; text-align: center;}
	.content { font-family: 'Raleway'; color:#fff; text-align: center;}
</style>
</head>
<body <?php body_class(); ?>>
	<div class="overflow_wrapper">
	<div class="main">
		<div>
			<span class="logo"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/plethora_logo_white.png" /></span>
		</div>
		<div class="content">
			<h1><?php echo __('You are just one step away!', 'cleanstart'); ?></h1>
			<p><?php echo __('This theme requires the <strong>Plethora Themes Framework</strong> plugin.', 'cleanstart'); ?></p>
			<p><?php echo __('You have to ', 'cleanstart') . '<a href="'. admin_url('themes.php?page=install-required-plugins') .'">' . __('install and activate it', 'cleanstart') .'</a> ' . __('please!', 'cleanstart') .''; ?></p>
		</div>
	</div>
	</div>
<?php wp_footer(); ?>
</body>
</html>