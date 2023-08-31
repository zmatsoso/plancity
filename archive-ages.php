<?php 
 if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }

get_header(); ?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">Age List</h1>
      <div class="page-banner__intro">
        <p>Manage Ages.</p>
      </div>
    </div>  
  </div>

  <div class="container container--narrow page-section">

    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo site_url('monty'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to Main Manu</a> <span class="metabox__main">Ages</span></p>
    </div>
	
	<div class="container">
	<nav class="codrops-demos">
					<a href="<?php echo site_url('new-age'); ?>">New Age</a>
	<nav>
	<br>	
	</div>	
    	<table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; background-color:#E1E1E1" width="100%">
 		<?php
		echo '<tr bgcolor="#CCCCCC" style="font-weight:bold"><td>Age</td></tr>';

		$ClientPosts = new WP_Query(array(
			'posts_per_page' => -1,
			'post_type' => 'ages',
			'orderby' => 'title',
			'order' => 'ASC',
			'type' => 'NUMERIC'
		));

		
        while($ClientPosts->have_posts()){
		$ClientPosts->the_post(); 
		
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

		Total Ages: <?php echo $counter; ?>

  </div>
  
<?php get_footer(); ?>  