<?php get_header(); ?>

  <div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg')?>);"></div>
    <div class="page-banner__content container t-center c-white">
     <h2 class="headline headline--medium">THE SIMPLEST WAY TO FIND</h2>
      <h3 class="headline headline--small">A Funeral Plan.</h3>
     
    </div>
  </div>

  <div class="full-width-split group">
  
  <!-- Start Events -->
  
  
    <div class="full-width-split__one">
      <div class="full-width-split__inner">
        <h2 class="headline headline--small-plus t-center">Upcoming Events</h2>
		<?php
		
      $HomePageEvents = new WP_Query(array(
	  'posts_per_page' => 2,
	  'post_type' => 'event'
	
	  ));
	  
	  while($HomePageEvents->have_posts()){
		  $HomePageEvents->the_post(); ?>
		<div class="event-summary">
          <a class="event-summary__date t-center" href="<?php the_permalink(); ?>">
            <span class="event-summary__month"><?php  
			$eventDate = get_field('event_date'); 
			echo $eventDate;
			?></span>
            <span class="event-summary__day"><?php the_time('d'); ?></span>  
          </a>
          <div class="event-summary__content">
            <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
            <p><?php echo wp_trim_words(get_the_content(), 18)?> <a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>
          </div>
        </div>
         

	  <?php }
	  ?>
         <p class="t-center no-margin"><a href="<?php echo get_post_type_archive_link('event');?>" class="btn btn--blue">View All Events</a></p>

      </div>
    </div>
	<!-- Start Ends -->
	
	<!-- Start Blogs -->
    <div class="full-width-split__two">
      <div class="full-width-split__inner">
        <h2 class="headline headline--small-plus t-center">From Our Blogs</h2>
		
		
		<?php 
		$HomePagePosts = new WP_Query(array(
		'posts_per_page' => 2
		
		));
		
		
		
		while($HomePagePosts->have_posts()){
			$HomePagePosts->the_post();
			?>
		<div class="event-summary">
          <a class="event-summary__date event-summary__date--beige t-center" href="<?php the_permalink(); ?>">
            <span class="event-summary__month"><?php the_time('M'); ?></span>
            <span class="event-summary__day"><?php the_time('d'); ?></span>  
          </a>
          <div class="event-summary__content">
            <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
            <p><?php echo wp_trim_words(get_the_content(), 18)?> <a href="<?php the_permalink(); ?>" class="nu gray">Read more</a></p>
          </div>
        </div>

			<?php
		}  wp_reset_postdata(); // after closing while to clean custom query
		
		?>
		
        
        <p class="t-center no-margin"><a href="<?php echo site_url('/blog') ?>" class="btn btn--yellow">View All Blog Posts</a></p>
      </div>
    </div>
	<!-- Ends Blogs -->
	
	  </div>
	  
	  
       <!--================Properties Area =================-->
        <section class="properties_area">
        	<div class="container">
        		<div class="main_title">
        			<h2>Our Top Rated Properties</h2>
        			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt</p>
        		</div>
        		<div class="row properties_inner">
				
				
        			<div class="col-lg-4">
        				<div class="properties_item">
        					<div class="pp_img">
        						<img class="img-fluid" src="img/properties/pp-1.jpg" alt="">
        					</div>
        					<div class="pp_content">
        						<a href="#"><h4>04 Bed Duplex</h4></a>
        						<div class="tags">
        							<a href="#">04 Beds</a>
        							<a href="#">03 Baths</a>
        							<a href="#">750 sqm</a>
        							<a href="#"><i class="fa fa-check" aria-hidden="true"></i>Pool</a>
        							<a href="#"><i class="fa fa-times" aria-hidden="true"></i>Bar</a>
        							<a href="#"><i class="fa fa-times" aria-hidden="true"></i>Pool</a>
        						</div>
        						<div class="pp_footer">
        							<h5>Total: $3.5M</h5>
        							<a class="main_btn" href="#">For Sale</a>
        						</div>
        					</div>
        				</div>
        			</div>
					
					
 					
					
        		</div>
        	</div>
        </section>
        <!--================End Properties Area =================-->
	




<?php get_footer(); ?>