<?php   
 if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }

get_header(); 

  while(have_posts()) {
    the_post();
?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">Manage Service</h1>
      <div class="page-banner__intro">
        <p><?php the_title(); ?></p>
      </div>
    </div>  
  </div>

  <div class="container container--narrow page-section">
   <?php 
   
   ?>
    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo site_url('services'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to All Services</a> <span class="metabox__main">Service Info</span></p>
    </div>
	
     <ul class="min-list link-list" id="ma_services">

            <li data-id="<?php the_ID(); ?>">
              <input id="service_title" readonly  class="note-title-field" value="<?php echo esc_attr(get_the_title()); ?>">
              <span id="edit-service" class="edit-note"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</span>
              <span id="delete-service" class="delete-note"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</span>
              <textarea id="service_content" readonly  class="note-body-field"><?php echo esc_attr(get_the_content()); ?></textarea>
              <span id="save_service" class="update-note btn btn--blue btn--small"><i class="fa fa-arrow-right" aria-hidden="true"></i> Save</span>
            </li>
       </ul>

  </div>
  
<?php 

}//Close While have posts

get_footer(); ?>  