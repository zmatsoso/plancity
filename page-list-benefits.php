<?php 
 if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }
get_header(); 
$client_id= $_GET['ID'];
$plan_id= $_GET['PlanId'];
$Service_Type='Included';



?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">Service List</h1>
      <div class="page-banner__intro">
        <p><?php echo $ClientName;	?>
		</p>
      </div>
    </div>  
  </div>

  <div class="container container--narrow page-section">

    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo site_url('clients'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to Client List</a> <span class="metabox__main">Services</span></p>
    </div>
	
    	<table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; background-color:#E1E1E1" width="100%">
 		<?php
		echo '<tr bgcolor="#CCCCCC" style="font-weight:bold"><td>Service(s)</td><td>Benefits</td></tr>';
		
		$Plan_Services_Posts = new WP_Query(array(
			'post_type' => 'plan_service',
			'posts_per_page' => -1,
			'meta_query' => array(
			'relation'      => 'AND',
				array(
				'key' => 'related_plan',
				'compare' => 'LIKE',
				'value' => $plan_id  //get_current_user_id()
				),
				array(
				'key' => 'service_type',
				'compare' => 'LIKE',
				'value' => $Service_Type
				)
			)
		));
			while($Plan_Services_Posts->have_posts()){
			$Plan_Services_Posts->the_post(); 
			$plan_service_id = get_the_ID();
			
			$Related_Services = get_field('related_service');
			
			foreach($Related_Services as $Service){
						$Service_title = get_the_title($Service);
						$Service_Content = get_the_content($Service);
						
			}
			

		
		if($colour_select==1){
				$selected_colour="FFFFCC";
				$colour_select=2;
				}else{
				$selected_colour="FFFFFF";
				$colour_select=1;
				}

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
                    <td align="left"><?php echo $Service_title ?></td>
                    <td><a href="<?php echo site_url('edit-benefits/?ID=' . $plan_service_id . '&PlanId=' . $plan_id); ?>">View / Update</a>
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

		Total Branches: <?php echo $counter; ?> |
		Total Active: <?php echo $counter_active; ?> |
		Total InActive: <?php echo $counter_inactive; ?>

  </div>
  
<?php get_footer(); ?>  