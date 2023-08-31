<?php 
if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }

get_header(); 

$client_id= $_GET['ID'];
$ClientName= $_GET['ClientName'];


?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">Plan List</h1>
      <div class="page-banner__intro">
        <p><?php echo $_GET['ClientName']; ?></p>
      </div>
    </div>  
  </div>

  <div class="container container--narrow page-section">

    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo site_url('clients'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to Clients</a> <span class="metabox__main">Plans</span></p>
    </div>
    
    <div class="page-links">
      <h2 class="page-links__title">Premiums</h2>
      <ul class="min-list">
  	  <li class="current_page_item"><a href="<?php echo site_url('list-plans/?ID=' . $client_id . '&ClientName=' . $ClientName); ?>">Plan List</a></li>
	  <li><a href="<?php echo site_url('plans/?ID=' . $client_id . '&ClientName=' . $ClientName); ?>">Branches</a></li>
      <li class="current_page_item"><a href="<?php echo site_url('list-included-services/?ID=' . $client_id . '&ClientName=' . $ClientName); ?>">Included Services</a></li>
      <li><a href="<?php echo site_url('list-optional-services/?ID=' . $client_id . '&ClientName=' . $ClientName); ?>">Optional Services</a></li>
      <li class="current_page_item"><a href="<?php echo site_url('list-add-members/?ID=' . $client_id . '&ClientName=' . $ClientName); ?>">Additional Dependents</a></li>
      <li><a href="<?php echo site_url('list-premiums/?ID=' . $client_id . '&ClientName=' . $ClientName); ?>">Premiums / Joining Fees</a></li>
      <li class="current_page_item"><a href="<?php echo site_url('list-waiting/?ID=' . $client_id . '&ClientName=' . $ClientName); ?>">Waiting Periods</a></li>
	  <li><a href="<?php echo site_url('list-plan-benefits/?ID=' . $client_id . '&ClientName=' . $ClientName); ?>">Benefits</a></li>  </ul>
       </ul>
    </div>

    <div class="generic-content">
	
     	<table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; background-color:#E1E1E1" width="60%">
 		<?php
		echo '<tr bgcolor="#CCCCCC" style="font-weight:bold" ><td>Plan Name</td><td>Product</td><td>Status</td><td align="center">Insert</td><td align="center">Modify</td><td>Joining Fee</td></tr>';
		
		$PlanPosts = new WP_Query(array(
			'posts_per_page' => -1,
			'post_type' => 'plan',
			'orderby' => 'title',
			'order' => 'ASC',
			'meta_query' => array(
				array(
				'key' => 'related_client',
				'compare' => 'LIKE',
				'value' => '"' . $client_id . '"' //get_current_user_id()
				)
			)

		));

       while($PlanPosts->have_posts()){
		$PlanPosts->the_post(); 

		//Get Product
			$Related_Product = get_field('related_product');
			
			foreach($Related_Product as $Product){
						$Product_title = get_the_title($Product);
			}

		
		//End Get Product
		if($colour_select==1){
				$selected_colour="FFFFCC";
				$colour_select=2;
				}else{
				$selected_colour="FFFFFF";
				$colour_select=1;
				}
		$client_active= get_field('plan_active');
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
					<td align="left"><?php echo $Product_title; ?></td>
					<td align="left"><?php echo $active?></td>
                    <td align="center"><a href="<?php echo site_url('rectify-premiums/?ID=' . $client_id . '&PlanId=' . get_the_ID()); ?>">New</a></td>
					<td align="center"><a href="<?php echo site_url('edit-premiums/?ID=' . $client_id . '&PlanId=' . get_the_ID()); ?>">Edit</a></td>
					<td align="center"><a href="<?php echo site_url('list-joining-fee/?ID=' . $client_id . '&PlanId=' . get_the_ID()); ?>">List</a></td>
					
                    </tr>

				
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

		Total Plans: <?php echo $counter; ?>


		</div>

  </div>
  
<?php get_footer(); ?>  