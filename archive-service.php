<?php 
if (!is_user_logged_in()){
	wp_redirect(esc_url(site_url('/')));
	exit;
}
get_header(); 
?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">Services List</h1>
      <div class="page-banner__intro">
        <p>Manage Services.</p>
      </div>
    </div>  
  </div>

  <div class="container container--narrow page-section">

    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo site_url('monty'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to Main Manu</a> <span class="metabox__main">Services</span></p>
    </div>
	
	<div class="container">
	<nav class="codrops-demos">
					<a href="<?php echo site_url('new-service'); ?>">New Service</a>
	<nav>
	<br>	
	</div>	
    	<table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; background-color:#E1E1E1" width="100%">
 		<?php
		echo '<tr bgcolor="#CCCCCC" style="font-weight:bold"><td>Service Name</td><td>Description</td><td>Active Plans</td><td>Options</td></tr>';
		$ServicePosts = new WP_Query(array(
			'posts_per_page' => -1,
			'post_type' => 'service',
			'orderby' => 'title',
			'order' => 'ASC'
		));

		
        while($ServicePosts->have_posts()){
		$ServicePosts->the_post(); 
		$client_id=get_the_ID();
		$counter+=1;
		if($colour_select==1){
				$selected_colour="FFFFCC";
				$colour_select=2;
				}else{
				$selected_colour="FFFFFF";
				$colour_select=1;
				}
		
		
		?>
		
            		<tr bgcolor="<?php echo $selected_colour ?>">
					<td align="left"><?php the_title(); ?></td>
					<td align="left"><?php echo the_field('description'); ?></td>
					<td align="center"><?php echo the_field('active_plans'); ?></td>
					<td align="center"><a href="<?php echo the_permalink(); ?>">Edit</a></td>
                    </td>

				
		<?php }	?>
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

		Total Services: <?php echo $counter; ?>

  </div>
  
<?php get_footer(); ?>  