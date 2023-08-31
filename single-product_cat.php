<?php 
 if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }
get_header();

 while(have_posts()) {
    the_post();
	$Category_id=get_the_ID();

 ?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php the_title(); ?></h1>
      <div class="page-banner__intro">
        <p>Product List</p>
      </div>
    </div>  
  </div>

  <div class="container container--narrow page-section">

    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo site_url('product_cats'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to Categories</a> <span class="metabox__main">Products</span></p>
    </div>
	
	<div class="container">
	<nav class="codrops-demos">
					<a href="#">New Product</a>
	<nav>
	<br>	
	</div>	
    	<table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; background-color:#E1E1E1" width="100%">
 		<?php
		echo '<tr bgcolor="#CCCCCC" style="font-weight:bold"><td>Product</td><td>Plans</td></tr>';
		
		$ProductPosts = new WP_Query(array(
			'posts_per_page' => -1,
			'post_type' => 'product',
				'meta_query' => array(
				array(
				'key' => 'related_category',
				'compare' => 'LIKE',
				'value' => '"' . $Category_id . '"' //get_current_user_id()
				)
			)

		));
		
		
        while($ProductPosts->have_posts()){
		$ProductPosts->the_post(); 
		$Product_id=get_the_ID();
		
		if($colour_select==1){
				$selected_colour="FFFFCC";
				$colour_select=2;
				}else{
				$selected_colour="FFFFFF";
				$colour_select=1;
				}
		$client_active= 1;//get_the_field('client_active');
				if($client_active==1){
					$active="Active";
					$counter+=1;
					$counter_active+=1;
				}else{
					$active="InActive";
					$counter_inactive+=1;
				}
		
		?>
		
             		<tr bgcolor="<?php echo $selected_colour ?>">
                    <td align="left"><?php echo the_title(); ?></td>
                                     
                    <td><a href="<?php echo the_permalink(); ?>">View</a>
                    </td>

				
		<?php }	
		
		wp_reset_postdata();
		
		?>
        </table>
		
		<table>
		  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

		Total Products: <?php echo $counter; ?>
                </div>

  </div>
  
<?php 
 }
get_footer(); ?>  