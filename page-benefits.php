<?php
$premuim_id=$_GET['id'];
$service_type="Included";
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
      <p><span class="metabox__blog-home-link">Benefit List</span></p>
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
				$plan_service_id=get_the_ID();
				$main_member=get_field('member_benefit');
				$spouse=get_field('spouse_benefit');
				$child14_21_25=get_field('child_14-21_benefit');
				$child6_13=get_field('child_6-13_benefit');
				$child1_5=get_field('child_1-5_benefit');
				$child0_11Mnts=get_field('child_0-11months_benefit');
				$stillborn=get_field('stillborn_benefit');
				$parent=get_field('parent_benefit');
				$band1=get_field('band1');
				$band2=get_field('band2');
				$band3=get_field('band3');
				$band4=get_field('band4');

			
			$Related_Services = get_field('related_service');
			
			foreach($Related_Services as $Service){
						$Service_title = get_the_title($Service);
						$Service_ID = $Service->ID;
						$counter+=1;
			}
			
			 	$service_args = array(
				'p'         => $Service_ID, // ID of a page, post, or custom type
				'post_type' => 'service'
				);
				$ServicePosts = new WP_Query($service_args);
				while($ServicePosts->have_posts()){
				$ServicePosts->the_post(); 
					$Description = get_field('description');

				}


			?>
                  
            <p><font color="blue"><strong><?php echo $counter; ?>. <?php echo $Service_title; ?></strong></font></p>
			<p class="b"><?php echo $Description; ?></p>
			<p>  <table width="100%" border="0" cellspacing="0" cellpadding="2">	
   <tr>
    <td width="17%">&nbsp;</td>
    <td width="30%" class="_fields">Main Member</td>
    <td width="65%" class="service_name"><?php echo $main_member?></td>
  </tr>

<?php
  if($spouse!=''){
  ?>
   <tr>
    <td width="17%">&nbsp;</td>
    <td width="30%" class="_fields">Spouse</td>
    <td width="65%" class="service_name"><?php echo $spouse?></td>
  </tr>
<?php } ?>  
<?php
  if($child14_21_25!=''){
  ?>
   <tr>
    <td width="17%">&nbsp;</td>
    <td width="30%" class="_fields">Child 14-21/25</td>
    <td width="65%" class="service_name"><?php echo $child14_21_25?></td>
  </tr>
<?php } ?>  
<?php
  if($child6_13!=''){
  ?>
   <tr>
    <td width="17%">&nbsp;</td>
    <td width="30%" class="_fields">Child 6-13</td>
    <td width="65%" class="service_name"><?php echo $child6_13?></td>
  </tr>
<?php } ?>  
<?php
  if($child1_5!=''){
  ?>
   <tr>
    <td width="17%">&nbsp;</td>
    <td width="30%" class="_fields">Child 1-5</td>
    <td width="65%" class="service_name"><?php echo $child1_5?></td>
  </tr>
<?php } ?>  
<?php
  if($child0_11Mnts!=''){
  ?>
   <tr>
    <td width="17%">&nbsp;</td>
    <td width="30%" class="_fields">Child 0-11Months</td>
    <td width="65%" class="service_name"><?php echo $child0_11Mnts?></td>
  </tr>
<?php } ?>  
<?php
  if($stillborn!=''){
  ?>
  <tr>
    <td width="17%">&nbsp;</td>
    <td width="30%" class="_fields">Stillborn</td>
    <td width="65%" class="service_name"><?php echo $stillborn?></td>
  </tr>
  <?php } ?>
 <?php
  if($parent!=''){
  ?>
   <tr>
    <td width="17%">&nbsp;</td>
    <td width="30%" class="_fields">Parent</td>
    <td width="65%" class="service_name"><?php echo $parent?></td>
  </tr>
 <?php } ?>
 <?php
  if($band1!=''){
 ?>
   <tr>
    <td width="17%">&nbsp;</td>
    <td width="30%" class="_fields">Age: <?php echo $age_min1 ?>-<?php echo $age_max1 ?></td>
    <td width="65%" class="service_name"><?php echo $band1?></td>
  </tr>
  <?php } ?>
  <?php
  if($band2!=''){
  ?>
   <tr>
    <td width="17%">&nbsp;</td>
    <td width="30%" class="_fields">Age: <?php echo $age_min2 ?>-<?php echo $age_max2 ?></td>
    <td width="65%" class="service_name"><?php echo $band2?></td>
  </tr>
  <?php } ?>	
  <?php
  if($band3!=''){
  ?>
   <tr>
    <td width="17%">&nbsp;</td>
    <td width="30%" class="_fields">Age: <?php echo $age_min3?>-<?php echo $age_max3?></td>
    <td width="65%" class="service_name"><?php echo $band3?></td>
  </tr>
  <?php } ?>	
  <?php
  if($band4!=''){
  ?>
   <tr>
    <td width="17%">&nbsp;</td>
    <td width="30%" class="_fields">Age: <?php echo $age_min4?>-<?php echo $age_max4?></td>
    <td width="65%" class="service_name"><?php echo $band4?></td>
  </tr>
  <?php } ?>	

 </table>

</p>
<?php } ?>	


<?php
$service_type="Optional";
		$Plan_Services_Posts2 = new WP_Query(array(
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
		
			while($Plan_Services_Posts2->have_posts()){
			$Plan_Services_Posts2->the_post(); 
				$plan_service_id=get_the_ID();
				$main_member=get_field('member_benefit');
				$spouse=get_field('spouse_benefit');
				$child14_21_25=get_field('child_14-21_benefit');
				$child6_13=get_field('child_6-13_benefit');
				$child1_5=get_field('child_1-5_benefit');
				$child0_11Mnts=get_field('child_0-11months_benefit');
				$stillborn=get_field('stillborn_benefit');
				$parent=get_field('parent_benefit');
				$band1=get_field('band1');
				$band2=get_field('band2');
				$band3=get_field('band3');
				$band4=get_field('band4');

			
			$Related_Services2 = get_field('related_service');
			
			foreach($Related_Services2 as $Service2){
						$Service_title = get_the_title($Service2);
						$Service_ID2 = $Service2->ID;
						$counter+=1;
			}
			
			 	$service_args2 = array(
				'p'         => $Service_ID2, // ID of a page, post, or custom type
				'post_type' => 'service'
				);
				$ServicePosts2 = new WP_Query($service_args2);
				while($ServicePosts2->have_posts()){
				$ServicePosts2->the_post(); 
					$Description = get_field('description');

				}
?>	

							<p><font color="blue"><strong><?php echo $counter; ?>. <?php echo $service_name; ?> (OPTIONAL @ R<?php echo $optional_cost; ?> p/m)</strong></font></p>
							<p class="b"><?php echo $Description; ?></p>
							<p>  <table width="100%" border="0" cellspacing="0" cellpadding="2">
 
   <tr>
    <td width="17%">&nbsp;</td>
    <td width="30%" class="_fields">Main Member</td>
    <td width="65%" class="service_name"><?php echo $main_member?></td>
  </tr>

<?php
  if($spouse!=''){
  ?>
   <tr>
    <td width="17%">&nbsp;</td>
    <td width="30%" class="_fields">Spouse</td>
    <td width="65%" class="service_name"><?php echo $spouse?></td>
  </tr>
<?php } ?>  
<?php
  if($child14_21_25!=''){
  ?>
   <tr>
    <td width="17%">&nbsp;</td>
    <td width="30%" class="_fields">Child 14-21/25</td>
    <td width="65%" class="service_name"><?php echo $child14_21_25?></td>
  </tr>
<?php } ?>  
<?php
  if($child6_13!=''){
  ?>
   <tr>
    <td width="17%">&nbsp;</td>
    <td width="30%" class="_fields">Child 6-13</td>
    <td width="65%" class="service_name"><?php echo $child6_13?></td>
  </tr>
<?php } ?>  
<?php
  if($child1_5!=''){
  ?>
   <tr>
    <td width="17%">&nbsp;</td>
    <td width="30%" class="_fields">Child 1-5</td>
    <td width="65%" class="service_name"><?php echo $child1_5?></td>
  </tr>
<?php } ?>  
<?php
  if($child0_11Mnts!=''){
  ?>
   <tr>
    <td width="17%">&nbsp;</td>
    <td width="30%" class="_fields">Child 0-11Months</td>
    <td width="65%" class="service_name"><?php echo $child0_11Mnts?></td>
  </tr>
<?php } ?>  
<?php
  if($stillborn!=''){
  ?>
  <tr>
    <td width="17%">&nbsp;</td>
    <td width="30%" class="_fields">Stillborn</td>
    <td width="65%" class="service_name"><?php echo $stillborn?></td>
  </tr>
  <?php } ?>
 <?php
  if($parent!=''){
  ?>
   <tr>
    <td width="17%">&nbsp;</td>
    <td width="30%" class="_fields">Parent</td>
    <td width="65%" class="service_name"><?php echo $parent?></td>
  </tr>
 <?php } ?>
 <?php
  if($band1!=''){
 ?>
   <tr>
    <td width="17%">&nbsp;</td>
    <td width="30%" class="_fields">Age: <?php echo $age_min1 ?>-<?php echo $age_max1 ?></td>
    <td width="65%" class="service_name"><?php echo $band1?></td>
  </tr>
  <?php } ?>
  <?php
  if($band2!=''){
  ?>
   <tr>
    <td width="17%">&nbsp;</td>
    <td width="30%" class="_fields">Age: <?php echo $age_min2 ?>-<?php echo $age_max2 ?></td>
    <td width="65%" class="service_name"><?php echo $band2?></td>
  </tr>
  <?php } ?>	
  <?php
  if($band3!=''){
  ?>
   <tr>
    <td width="17%">&nbsp;</td>
    <td width="30%" class="_fields">Age: <?php echo $age_min3?>-<?php echo $age_max3?></td>
    <td width="65%" class="service_name"><?php echo $band3?></td>
  </tr>
  <?php } ?>	
  <?php
  if($band4!=''){
  ?>
   <tr>
    <td width="17%">&nbsp;</td>
    <td width="30%" class="_fields">Age: <?php echo $age_min4?>-<?php echo $age_max4?></td>
    <td width="65%" class="service_name"><?php echo $band4?></td>
  </tr>
  <?php } ?>	

 </table>
<?php }	?>
</p>
