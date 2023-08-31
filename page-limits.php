<?php
$premuim_id=$_GET['id'];
$service_type="Included";
$CanAddDepend = 0;
 get_header(); 
 
 	$premium_args = array(
	'p'         => $premuim_id, // ID of a page, post, or custom type
	'post_type' => 'premium'
	);
	$PremiumPosts = new WP_Query($premium_args);
	 while($PremiumPosts->have_posts()){
		$PremiumPosts->the_post(); 
		$Plan_Arrey = get_field('related_plan');
			foreach($Plan_Arrey as $Plan){
						$Plan_Id = $Plan->ID;
			}

	 }
 	$plan_args = array(
	'p'         => $Plan_Id, // ID of a page, post, or custom type
	'post_type' => 'plan'
	);
	$PlanPosts = new WP_Query($plan_args);
	 while($PlanPosts->have_posts()){
		$PlanPosts->the_post(); 
		$Plan_name = get_the_title();
				$no_limit_spouse=get_field('no_limit_spouse');
				$no_limit_children=get_field('no_limit_children');
				$no_limit_parents=get_field('no_limit_parents');
				$age_min1 = get_field('age_min1');
				$age_min2 = get_field('age_min2');
				$age_min3 = get_field('age_min3');
				$age_min4 = get_field('age_min4');
				$age_max1 = get_field('age_max1');
				$age_max2 = get_field('age_max2');
				$age_max3 = get_field('age_max3');
				$age_max4 = get_field('age_max4');
				$no_limit_1=get_field('no_limit1');
				$no_limit_2=get_field('no_limit2');
				$no_limit_3=get_field('no_limit3');
				$no_limit_4=get_field('no_limit4');
				
				$age_limit_main=get_field('age_limit_member');
				$age_limit_spouse=get_field('age_limit_spouse');
				$age_limit_parents=get_field('age_limit_parents');
				$age_limit_1=get_field('age_max1');
				$age_limit_2=get_field('age_max2');
				$age_limit_3=get_field('age_max3');
				$age_limit_4=get_field('age_max4');

		$Client_Array = get_field('related_client');
			foreach($Client_Array as $Client){
						$Client_Id = $Client->ID;
			}

	 }
 	$client_args = array(
	'p'         => $Client_Id, // ID of a page, post, or custom type
	'post_type' => 'client'
	);
	$ClientPosts = new WP_Query($client_args);
	 while($ClientPosts->have_posts()){
		$ClientPosts->the_post(); 
		$Client_name = get_the_title();

	 }

 ?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php echo $Plan_name; ?></h1>
      <div class="page-banner__intro">
        <p><?php echo $Client_name; ?></p>
      </div>
    </div>  
  </div>
   <div class="container container--narrow page-section">

    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><span class="metabox__blog-home-link">Plan Limits</span></p>
    </div>
<style>
p.a {
  font-style: normal;
}

p.b {
  font-style: italic;
}

p.c {
  font-style: oblique;
}
</style>
	
<?php


		
			


			?>
              
            <p><font color="blue"><strong>Maximum No of persons:</strong></font></p>
			<?php 
			if($no_limit_spouse>0 or $no_limit_children>0 or $no_limit_parents>0 or $no_limit_1>0 or $no_limit_2>0 or $no_limit_3>0 or $no_limit_4>0){
				?>
				<p class="b">Member +</p>
				<?php
			}else{
				?>
				<p class="b">Member Only</p>
				<?php
			}
			?>
			
			<p>  <table width="100%" border="0" cellspacing="0" cellpadding="2">	
							<?php
  if($no_limit_spouse>0){
  ?>
  
  <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields"><?php echo $no_limit_spouse; ?></td>
    <td width="80%"><span class="service_name">Spouse</span></td>
  </tr>
 <?php } ?>
 <?php
  if($no_limit_children>0){
  ?>
  
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields"><?php echo $no_limit_children; ?></td>
    <td width="80%"><span class="service_name">Children</span></td>
  </tr>
 <?php } ?>
 <?php
  if($no_limit_parents>0){
  ?>
  
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields"><?php echo $no_limit_parents; ?></td>
    <td width="80%"><span class="service_name">Parents</span></td>
  </tr>
 <?php } ?>
 <?php
  if($no_limit_1>0){
  ?>
  
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields"><?php echo $no_limit_1; ?></td>
    <td width="80%"><span class="service_name">Age Band 1</span></td>
  </tr>
 <?php } ?>
 <?php
  if($no_limit_2>0){
  ?>
  
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields"><?php echo $no_limit_2; ?></td>
    <td width="80%"><span class="service_name">Age Band 2</span></td>
  </tr>
 <?php } ?>
 <?php
  if($no_limit_3>0){
  ?>
  
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields"><?php echo $no_limit_3; ?></td>
    <td width="80%"><span class="service_name">Age Band 3</span></td>
  </tr>
 <?php } ?>
 <?php
  if($no_limit_4>0){
  ?>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields"><?php echo $no_limit_4; ?></td>
    <td width="80%"><span class="service_name">Age Band 4</span></td>
  </tr>
<?php } ?>
 
 </table>
 
 </p>
 
 <table width="100%" border="0" cellspacing="0" cellpadding="2">
							<p><font color="blue"><strong>Age Limits:</strong></font></p>
							
							<p>
 <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Member</td>
    <td width="80%"><span class="service_name"><?php echo $age_limit_main; ?>yrs</span></td>
  </tr>
 
 <?php
  if($age_limit_spouse>0){
  ?>
  
  <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Spouse</td>
    <td width="80%"><span class="service_name"><?php echo $age_limit_spouse; ?>yrs</span></td>
  </tr>
   <?php } ?>
   
 <?php
  if($no_limit_children>0){
  ?>
  
  <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Children</td>
    <td width="80%"><span class="service_name">21yrs (Or 25yrs if still at school)</span></td>
  </tr>
   <?php } ?>
   
 <?php
  if($age_limit_parents>0){
  ?>
    <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Parents</td>
    <td width="80%"><span class="service_name"><?php echo $age_limit_parents; ?>yrs</span></td>
  </tr>
<?php } ?>
 
 </table></p>
							
						


<?php
$service_type="Additional";

		$Plan_Services_Posts = new WP_Query(array(
			'post_type' => 'plan_service',
			'posts_per_page' => -1,
			'meta_query' => array(
			'relation'      => 'AND',
				array(
				'key' => 'related_plan',
				'compare' => 'LIKE',
				'value' => $Plan_Id  //get_current_user_id()
				),
				array(
				'key' => 'service_type',
				'compare' => 'LIKE',
				'value' => $service_type
				)
			)
		));
		
			while($Plan_Services_Posts->have_posts()){
			$Plan_Services_Posts->the_post(); 
				
				
			$spouse=get_field('cost_per_add_spouse');
			$child14_21_25=get_field('cost_per_add_child14_21_25');
			$child6_13=get_field('cost_per_add_child6_13');
			$child1_5=get_field('cost_per_add_child1_5');
			$child0_11Mnts=get_field('cost_per_add_child0_11mnts');
			$parent=get_field('cost_per_add_parent');
			$band1=get_field('cost_per_add_band1');
			$band2=get_field('cost_per_add_band2');
			$band3=get_field('cost_per_add_band3');
			$band4=get_field('cost_per_add_band4');

			$add_spouse=get_field('add_spouse');
			$add_child14_21_25=get_field('add_child14_21_25');
			$add_child6_13=get_field('add_child6_13');
			$add_child1_5=get_field('add_child1_5');
			$add_child0_11Mnts=get_field('add_child0_11mnts');
			$add_parent=get_field('add_parent');
			$add_band1=get_field('add_band1');
			$add_band2=get_field('add_band2');
			$add_band3=get_field('add_band3');
			$add_band4=get_field('add_band4');

			$add_max_spouse=get_field('add_max_spouse');
			$add_max_child14_21_25=get_field('add_max_child14_21_25');
			$add_max_child6_13=get_field('add_max_child6_13');
			$add_max_child1_5=get_field('add_max_child1_5');
			$add_max_child0_11Mnts=get_field('add_max_child0_11mnts');
			$add_max_parent=get_field('add_max_parent');
			$add_max_band1=get_field('add_max_band1');
			$add_max_band2=get_field('add_max_band2');
			$add_max_band3=get_field('add_max_band3');
			$add_max_band4=get_field('add_max_band4');
			
			
		
				If($add_spouse>0){
					$CanAddDepend = 1;
				$new_add_spouse=$add_spouse. " @ " .$spouse ."p/m" ;
				}
				If($add_child14_21_25>0){
					$CanAddDepend = 1;
				$new_add_child14_21_25=$add_child14_21_25. " child(ren) @ " .$child14_21_25 ."p/m" ;
				}
				If($add_child6_13>0){
					$CanAddDepend = 1;
				$new_add_child6_13=$add_child6_13. " child(ren)@ " .$child6_13 ."p/m" ;
				}
				If($add_child1_5>0){
					$CanAddDepend = 1;
				$new_add_child1_5=$add_child1_5. " child(ren) @ " .$child1_5 ."p/m" ;
				}
				If($add_child0_11Mnts>0){
					$CanAddDepend = 1;
				$new_add_child0_11Mnts=$add_child0_11Mnts. " child(ren) @ " .$child0_11Mnts ."p/m" ;
				}
				If($add_parent>0){
					$CanAddDepend = 1;
				$new_add_parent=$add_parent. " parent(s) @ " .$parent ."p/m" ;
				}
				If($add_band1>0){
					$CanAddDepend = 1;
				$new_add_band1=$add_band1. " person(s) @ " .$band1 ."p/m" ;
				}
				If($add_band2>0){
					$CanAddDepend = 1;
				$new_add_band2=$add_band2. " person(s) @ " .$band2 ."p/m" ;
				}
				If($add_band3>0){
					$CanAddDepend = 1;
				$new_add_band3=$add_band3. " person(s) @ " .$band3 ."p/m" ;
				}
				If($add_band4>0){
					$CanAddDepend = 1;
				$new_add_band4=$add_band4. " person(s) @ " .$band4 ."p/m" ;
				}
				
			}
			
		
?>

						<?php
						if($CanAddDepend == 1){
						?>
							<p class="b"><font color="green"><strong>Wanna add more dependants?</strong></font></p>
						<?php
						}else{
						?>
							<p class="b"><font color="red"><strong>No Additional Dependants can be added on this plan</strong></font></p>
						<?php	
						}
						?>
						
							
						
						
							<p>
							<table width="100%" border="0" cellspacing="0" cellpadding="2">

 
 <?php
  if($new_add_spouse!=''){
  ?>
   <tr>
    <td width="17%">&nbsp;</td>
    <td width="30%" class="_fields">Spouse (max: <?php echo $add_max_spouse; ?> dependant(s))</td>
    <td width="65%" class="service_name">- <?php echo $new_add_spouse?></td>
  </tr>
<?php } ?>
 <?php
  if($new_add_child14_21_25!=''){
  ?>
   <tr>
    <td width="17%">&nbsp;</td>
    <td width="30%" class="_fields">Child 14-21/25 (max: <?php echo $add_max_child14_21_25; ?> dependant(s))</td>
    <td width="65%" class="service_name">- <?php echo $new_add_child14_21_25?></td>
  </tr>
<?php } ?>
 <?php
  if($new_add_child6_13!=''){
  ?>
   <tr>
    <td width="17%">&nbsp;</td>
    <td width="30%" class="_fields">Child 6-13 (max: <?php echo $add_max_child6_13; ?> dependant(s))</td>
    <td width="65%" class="service_name">- <?php echo $new_add_child6_13?></td>
  </tr>
 <?php } ?>
 <?php
  if($new_add_child1_5!=''){
  ?>
   <tr>
    <td width="17%">&nbsp;</td>
    <td width="30%" class="_fields">Child 1-5 (max: <?php echo $add_max_child1_5; ?> dependant(s))</td>
    <td width="65%" class="service_name">- <?php echo $new_add_child1_5?></td>
  </tr>
 <?php } ?>
 <?php
  if($new_add_child0_11Mnts!=''){
  ?>
   <tr>
    <td width="17%">&nbsp;</td>
    <td width="30%" class="_fields">Child 0-11Months (max: <?php echo $add_max_child0_11Mnts; ?> dependant(s))</td>
    <td width="65%" class="service_name">- <?php echo $new_add_child0_11Mnts?></td>
  </tr>
 <?php } ?>
 <?php
  if($new_add_parent!=''){
  ?>
    <tr>
    <td width="17%">&nbsp;</td>
    <td width="30%" class="_fields">Parent (max: <?php echo $add_max_parent; ?> dependant(s))</td>
    <td width="65%" class="service_name">- <?php echo $new_add_parent?></td>
  </tr>
 <?php } ?>
 <?php
  if($age_max1>0){
  ?>
  <tr>
    <td width="17%">&nbsp;</td>
    <td width="30%" class="_fields">Aged: <?php echo $age_min1 ?>-<?php echo $age_max1 ?> (max: <?php echo $add_max_band1; ?> dependant(s))</td>
    <td width="65%" class="service_name">- <?php echo $new_add_band1?></td>
  </tr>
 <?php } ?>
 <?php
  if($age_max2>0){
  ?>
  <tr>
    <td width="17%">&nbsp;</td>
    <td width="30%" class="_fields">Aged: <?php echo $age_min2 ?>-<?php echo $age_max2 ?> (max: <?php echo $add_max_band2; ?> dependant(s))</td>
    <td width="65%" class="service_name">- <?php echo $new_add_band2?></td>
  </tr>
 <?php } ?>
 <?php
  if($age_max3>0){
  ?>
   <tr>
    <td width="17%">&nbsp;</td>
    <td width="30%" class="_fields">Aged: <?php echo $age_min3?>-<?php echo $age_max3?> (max: <?php echo $add_max_band3; ?> dependant(s))</td>
    <td width="65%" class="service_name">- <?php echo $new_add_band3?></td>
  </tr>
 <?php } ?>
 <?php
  if($age_max4>0){
  ?>
   <tr>
    <td width="17%">&nbsp;</td>
    <td width="30%" class="_fields">Aged: <?php echo $age_min4?>-<?php echo $age_max4?> (max: <?php echo $add_max_band4; ?> dependant(s))</td>
    <td width="65%" class="service_name">- <?php echo $new_add_band4?></td>
  </tr>
<?php } ?>
 </table>
 
 </p>
													
						</div>
