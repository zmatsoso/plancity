<?php 
 if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }
?>


<script type="text/javascript">
function profilegood(){
	window.location = `<?php echo site_url('clients')?>`
};
</script>

<?php

$plan_id=$_POST['plan_id'];

$services_choices= $_POST['yyy'];

$no_Services=count($services_choices);


//Update Plans
	$plan_args = array(
	'p'         => $plan_id, // ID of a page, post, or custom type
	'post_type' => 'plan'
	);
	$PlanPosts = new WP_Query($plan_args);
	 while($PlanPosts->have_posts()){
		$PlanPosts->the_post(); 
		
		$Old_no_services = get_field('additional_members');
	 }
//End Update Plans
$New_no_service = $Old_no_services - $no_Services;
//Update Plan
  $update_plan = wp_update_post([
	'ID' => $plan_id,
	'post_type' => 'plan',
  ]);
   
  $fillable = [
	'field_5dce9c5b7f9aa' => $New_no_service	
   ];
   
  foreach ($fillable as $key => $ma_no_branches){
	   update_field($key, $ma_no_branches, $update_plan );
}   
//End Updtate plan



//_-----------------------------------------------------------services---------------------------------------------------------------------

//---------START 1------------//

$Service_Count=0;

while($Service_Count < $no_Services){
	$choice0= $services_choices[$Service_Count];	
	
//Get Provider ID
	$hold_args = array(
	'name'         => $choice0, // ID of a page, post, or custom type
	'post_type' => 'service'
	);
	$ServicePosts = new WP_Query($hold_args);
	 while($ServicePosts->have_posts()){
		$ServicePosts->the_post(); 
		
		$service_id = get_the_ID();
		$Old_active_plans = get_field('active_plans');
	 }

//End Get Provider ID
$New_Active_Plans = $Old_active_plans - 1;
//Update Service
   $update_service = wp_update_post([
	'ID' => $service_id,
	'post_type' => 'service',
  ]);
   
  $fillable2 = [
	'field_5db94b3f803da' => $New_Active_Plans	
   ];
   
  foreach ($fillable2 as $key2 => $ma_no_branches2){
	   update_field($key2, $ma_no_branches2, $update_service );
}   
//End Update Service

		$Plan_Service_Posts = new WP_Query(array(
			'post_type' => 'plan_service',
			'posts_per_page' => -1,
			'meta_query' => array(
			'relation'      => 'AND',
				array(
				'key' => 'related_service',
				'compare' => 'LIKE',
				'value' => $service_id  
				),
				array(
				'key' => 'related_plan',
				'compare' => 'LIKE',
				'value' => $plan_id 
				)
			)
		));
	while($Plan_Service_Posts->have_posts()){
			$Plan_Service_Posts->the_post(); 
			
			$Plan_Service_id = get_the_ID($Plan_Service_Posts);
			
			wp_delete_post($Plan_Service_id, false);
			 }

$Service_Count++;	
}



echo '<script type="text/javascript">'
, 'profilegood();'
, '</script>';	
?>