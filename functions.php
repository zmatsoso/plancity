<?php

require get_theme_file_path('/inc/search-route.php');


function plancity_files(){
	wp_enqueue_style('font-google', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
	wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

	wp_enqueue_style('font-google-from_old_41', get_theme_file_uri('./css/bootstrap.css'));
	wp_enqueue_style('font-google-from_old_42', get_theme_file_uri('./vendors/linericon/style.css'));
	wp_enqueue_style('font-google-from_old_43', get_theme_file_uri('./css/font-awesome.min.css'));
	wp_enqueue_style('font-google-from_old_44', get_theme_file_uri('./vendors/owl-carousel/owl.carousel.min.css'));
	wp_enqueue_style('font-google-from_old_40', get_theme_file_uri('./vendors/lightbox/simpleLightbox.css'));
	wp_enqueue_style('font-google-from_old_45', get_theme_file_uri('./vendors/nice-select/css/nice-select.css'));
	wp_enqueue_style('font-google-from_old_46', get_theme_file_uri('./vendors/animate-css/animate.css'));
	wp_enqueue_style('font-google-from_old_47', get_theme_file_uri('./vendors/jquery-ui/jquery-ui.css'));
	wp_enqueue_style('font-google-from_old_48', get_theme_file_uri('./css/style2.css'));
	wp_enqueue_style('font-google-from_old_49', get_theme_file_uri('./css/responsive.css'));
	
//		if (is_user_logged_in()){
		wp_enqueue_style('plancity_main_styles', get_stylesheet_uri());
//		}

wp_enqueue_style('font-google-from_old_50', get_theme_file_uri('/dist/css/classic/zebra_dialog.min.css'));
//wp_enqueue_style('font-google-from_old_51', get_theme_file_uri('/examples.css'));

wp_enqueue_script('main-plancity-js', get_theme_file_uri('/js/plans.js'), array('jquery'), '1.0', true);

//wp_enqueue_script('main-plancity-js', get_theme_file_uri('/dist/jquery-3.3.1.min.js'), NULL, '1.0', true);
//wp_enqueue_script('main-plancity-js', get_theme_file_uri('/dist/zebra_pin.min.js'), NULL, '1.0', true);
//wp_enqueue_script('main-plancity-js', get_theme_file_uri('/dist/zebra_dialog.min.js'), NULL, '1.0', true);
	
	wp_localize_script('main-plancity-js', 'plancityData', array(
    'root_url' => get_site_url(),
    'nonce' => wp_create_nonce('wp_rest')
  ));
}

add_action('wp_enqueue_scripts', 'plancity_files');


function plancity_features(){
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'plancity_features');


function redirectSubs(){
	$CurrentUser = wp_get_current_user();
	if(count($CurrentUser->roles)==1 AND $CurrentUser->roles[0] == 'subscriber'){
		wp_redirect(esc_url(site_url('/admin')));
		exit;
	}
}

add_action('admin_init', 'redirectSubs');


function noAdminBar(){
	$CurrentUser = wp_get_current_user();
	if(count($CurrentUser->roles)==1 AND (($CurrentUser->roles[0] == 'subscriber') OR ($CurrentUser->roles[0] == 'administrator'))){
		show_admin_bar(false);
	}
}

add_action('wp_loaded', 'noAdminBar');

function MaHeaderUrl(){
	return esc_url(site_url('/'));
}
add_filter('login_headerurl', 'MaHeaderUrl');

function MaLoginCss(){
	wp_enqueue_style('plancity_main_styles', get_stylesheet_uri());
	wp_enqueue_style('font-google', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
}

add_action('login_enqueue_scripts', 'MaLoginCss');

function MaHeaderTitle(){
	return 'PlanCity';
}
add_filter('login_headertitle', 'MaHeaderTitle');




