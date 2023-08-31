<?php get_header(); 

if (!is_user_logged_in()){
	wp_redirect(esc_url(site_url('/')));
	exit;
}

?>
   <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">Control Panel</h1>
      <div class="page-banner__intro">
        <p>Main Menu</p>
      </div>
    </div>  
  </div>

  <div class="container container--narrow page-section">

 
    <div class="page-links">
     <ul class="min-list">
		<li class="current_page_item"><a href="<?php echo site_url('product_cats'); ?>">Categories</a></li>
        <li><a href="<?php echo site_url('product_types'); ?>">Product Types</a></li>
		<li class="current_page_item"><a href="<?php echo site_url('products'); ?>">Products</a></li>
        <li><a href="<?php echo site_url('provinces'); ?>">Provinces</a></li>		
		<li class="current_page_item"><a href="<?php echo site_url('agess'); ?>">Ages</a></li>
      </ul>
    </div>

 
    <div class="page-links">
      <ul class="min-list">
        <li class="current_page_item"><a href="<?php echo site_url('clients'); ?>">Clients</a></li>
        <li><a href="<?php echo site_url('services'); ?>">Services</a></li>
        <li class="current_page_item"><a href="<?php echo site_url('operating_hourss'); ?>">Operating Hours</a></li>
        <li><a href="<?php echo site_url('areas'); ?>">Areas</a></li>
      </ul>
    </div>
	


    <div class="generic-content">
      <h2 class="headline headline--medium"><p>What would you like to do?</p></h2>
    </div>

  </div>


<?php get_footer(); ?>