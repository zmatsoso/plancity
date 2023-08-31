<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php if (is_user_logged_in()){ ?>
 <header class="site-header">
    <div class="container">
      <h1 class="school-logo-text float-left"><strong>Plan</strong>City</h1>
       <div class="site-header__menu group">
        <div class="site-header__util">
          <?php if(is_user_logged_in()) {
			$CurrentUser = wp_get_current_user();
			if(count($CurrentUser->roles)==1 AND $CurrentUser->roles[0] == 'administrator'){
			?>
            <a href="<?php echo esc_url(site_url('/monty')); ?>" class="btn btn--small btn--orange float-left push-right">Main Menu</a>
			<?php } 
			
			
			if(count($CurrentUser->roles)==1 AND $CurrentUser->roles[0] == 'subscriber'){
			?>
            <a href="<?php echo esc_url(site_url('/control-panel')); ?>" class="btn btn--small btn--orange float-left push-right">Main Menu</a>
			<?php } ?>

			
            <a href="<?php echo wp_logout_url();  ?>" class="btn btn--small  btn--dark-orange float-left btn--with-photo">

            <span class="btn__text">Log Out</span>
            </a>
            <?php } else { ?>
              <a href="<?php echo wp_login_url(); ?>" class="btn btn--small btn--orange float-left push-right">Login</a>
              <a href="<?php echo esc_url(site_url('/wp-signup.php')); ?>" class="btn btn--small  btn--dark-orange float-left">Sign Up</a>
             <?php } ?>
          
           </div>
      </div>
    </div>
  </header>

<?php } 

 if (!is_user_logged_in()){ ?>
       <!--================Header Menu Area =================-->
        <header class="header_area">
            <div class="main_menu">
            	<nav class="navbar navbar-expand-lg navbar-light">
					<div class="container box_1620">
						<!-- Brand and toggle get grouped for better mobile display -->
						<a class="navbar-brand logo_h" href="<?php echo esc_url(site_url('/')) ?>"><img src="<?php echo get_theme_file_uri('/img/logo.png') ?>" alt=""></a>
						
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
							<ul class="nav navbar-nav menu_nav ml-auto">
								<li class="nav-item"><a class="nav-link" href="<?php echo wp_login_url(); ?>">Login</a></li>
								<li class="nav-item"><a class="nav-link" href="#">Advertise</a></li>
							</ul>
							
						</div> 
					</div>
            	</nav>
            </div>
        </header>
        <!--================Header Menu Area =================-->
<?php } ?>
