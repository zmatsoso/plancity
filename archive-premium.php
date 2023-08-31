<?php 
if (!is_user_logged_in()){
	wp_redirect(esc_url(site_url('/')));
	exit;
}

get_header(); ?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">All Premiums</h1>
      <div class="page-banner__intro">
        <p>See what is going on in our world.</p>
      </div>
    </div>  
  </div>

  <div class="container container--narrow page-section">
  <?php
	$Gender = "Male and Female";
	$Plan = "Elegance Plan";
	$Amount = 200;
       $Premiums = new WP_Query(array(
	  'posts_per_page' => -1,
	  'post_type' => 'premium',
	  'meta_query' => array(
		//Filter by Gender
		array(
			'key' => 'gender',
			'compare' => '==',
			'value' => $Gender
		),
		//End Filter by Gender
		
		//Filter by Amount
		array(
			'key' => 'premium_amount',
			'compare' => '==',
			'value' => $Amount,
			'type' => 'numeric'
		)
		//End Filter by Amount
		
		
		
	  )
	  ));

  
	while($Premiums->have_posts()){
		$Premiums->the_post(); ?>
		<div class="event-summary">
          <a class="event-summary__date t-center" href="<?php the_permalink(); ?>">
            <span class="event-summary__month"><?php the_time('M'); ?></span>
            <span class="event-summary__day"><?php the_time('d'); ?></span>  
          </a>
          <div class="event-summary__content">
            <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
            <p><?php 
			//the_field('premium_amount');
			//$Test = the_field('related_premium_plan');
			//print_r($Test);
			//the_meta('province'); 
			
			?><a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>
          </div>
        </div>
 	<?php }
  ?>
  </div>

<?php get_footer(); ?>