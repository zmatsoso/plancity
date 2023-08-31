<?php 
 if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }

get_header(); ?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">Client List</h1>
      <div class="page-banner__intro">
        <p>Manage Clients.</p>
      </div>
    </div>  
  </div>

  <div class="container container--narrow page-section">

    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo site_url('monty'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to Main Manu</a> <span class="metabox__main">Clients</span></p>
    </div>
	
	   	<table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; background-color:#E1E1E1" width="100%">
 		<?php
		echo '<tr bgcolor="#CCCCCC" style="font-weight:bold"><td>Business Name</td><td align="center">FSP Number</td><td align="center">Status</td><td align="center">Branches</td><td align="center">Plans</td><td align="center">Options</td></tr>';

		

		$ClientPosts = new WP_Query(array(
			'posts_per_page' => -1,
			'post_type' => 'client',
			'orderby' => 'title',
			'order' => 'ASC'
		));

		
        while($ClientPosts->have_posts()){
		$ClientPosts->the_post(); 
		
		$client_id=get_the_ID();
		$ClientName=get_the_title();
		
		if($colour_select==1){
				$selected_colour="FFFFCC";
				$colour_select=2;
				}else{
				$selected_colour="FFFFFF";
				$colour_select=1;
				}
		$client_active= get_field('client_active');
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
					<td align="left"><?php the_title(); ?></td>
					<td align="center"><?php the_field('fsp_number'); ?></td>
                    <td align="center"><?php echo $active; ?></td>                   
					<td align="center"><a href="<?php echo site_url('providers/?ID=' . $client_id . '&ClientName=' . $ClientName ); ?>">Branches</a>
					<td align="center"><a href="<?php echo site_url('list-plans/?ID=' . $client_id . '&ClientName=' . $ClientName); ?>">Plans</a>
					<td align="center"><a href="<?php echo site_url('edit-client/?ID=' . $client_id . '&ClientName=' . $ClientName); ?>">Edit</a>
                 </td>
                  
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
    </tr>
</table>
    
 		Total Clients: <?php echo $counter; ?> |
		Total Active: <?php echo $counter_active; ?> |
		Total InActive: <?php echo $counter_inactive; ?>

  </div>
  
<?php get_footer(); ?>  