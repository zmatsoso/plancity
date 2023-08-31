<?php 
 if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }
$client_id= $_GET['ID'];
$plan_id= $_GET['PlanId'];

get_header(); ?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">Waiting Periods</h1>
      <div class="page-banner__intro">
        <p>Manage Waiting Periods.</p>
      </div>
    </div>  
  </div>

  <div class="container container--narrow page-section">

    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo site_url('list-waiting/?ID=' . $client_id . '&ClientName=' . $ClientName . '&plan_id=' . $plan_id); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to Plan List</a> <span class="metabox__main">Waiting Periods</span></p>
    </div>
	   <div class="generic-content">
	
	           <nav class="codrops-demos">
					<a href="<?php echo site_url('waiting-on-plan/?ID=' . $client_id . '&ClientName=' . $ClientName . '&plan_id=' . $plan_id); ?>">Update multiple ages</a>
					
	           <nav>
  	<br>	

   	<table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; background-color:#E1E1E1" width="100%">
 		<?php
		echo '<tr bgcolor="#CCCCCC" style="font-weight:bold"><td>Age</td><td align="center">Natural</td><td align="center">Accidental</td><td align="center">Suicide</td><td align="center">Options</td></tr>';
	   

		$PremiumsPosts = new WP_Query(array(
			'posts_per_page' => -1,
			'post_type' => 'premium',
			'order' => 'ASC',
			'orderby' => 'related_age',
			'meta_key' => 'related_age',
			'meta_query' => array(
				array(
				'key' => 'related_plan',
				'compare' => 'LIKE',
				'value' => $plan_id //get_current_user_id()
				)
			)
		));

		
        while($PremiumsPosts->have_posts()){
		$PremiumsPosts->the_post(); 
		$Premium_Id = get_the_ID();
		$waiting_period_natural=get_field('waiting_period_natural');
		$waiting_period_accidental=get_field('waiting_period_accidental');
		$waiting_period_suicide=get_field('waiting_period_suicide');
		
		$Related_Age=get_field('related_age');
		
		
			foreach($Related_Age as $Age){
						$Age_ID2 = $Age->ID;
			}

		
			$hold_args = array(
			'p'         => $Age_ID2, // ID of a page, post, or custom type
			'post_type' => 'ages'
			);
			$AgesPosts = new WP_Query($hold_args);
			while($AgesPosts->have_posts()){
			$AgesPosts->the_post(); 
		
			$Age_ID3 = get_the_title();
			}

		
		
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
                    <td><?php echo $Age_ID3 ?></td>
					<td align="center"><?php echo $waiting_period_natural ?></td>
 					<td align="center"><?php echo $waiting_period_accidental ?></td>
 					<td align="center"><?php echo $waiting_period_suicide ?></td>
                  <td align="center"><a href="<?php echo site_url('edit-single-waiting/?ID=' . $plan_id . '&PremiumId=' . $Premium_Id . '&client_id=' . $client_id); ?>">Update</a>
				
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


  </div>
  
<?php get_footer(); ?>  