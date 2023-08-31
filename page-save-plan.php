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
$plan_name=$_POST['plan_name'];

$client_id=$_POST['client_id'];

$age_min1=$_POST['age_min1'];
$age_min2=$_POST['age_min2'];
$age_min3=$_POST['age_min3'];
$age_min4=$_POST['age_min4'];
$age_max1=$_POST['age_max1'];
$age_max2=$_POST['age_max2'];
$age_max3=$_POST['age_max3'];
$age_max4=$_POST['age_max4'];


$no_limit_spouse=$_POST['no_limit_spouse'];
$no_limit_children=$_POST['no_limit_children'];
$no_limit_parents=$_POST['no_limit_parents'];
$no_limit_1=$_POST['no_limit_1'];
$no_limit_2=$_POST['no_limit_2'];
$no_limit_3=$_POST['no_limit_3'];
$no_limit_4=$_POST['no_limit_4'];


$age_limit_main=$_POST['age_limit_main'];
$age_limit_spouse=$_POST['age_limit_spouse'];
$age_limit_parents=$_POST['age_limit_parents'];


$additional_info=$_POST['additional_info'];

$select_product=$_POST['select_product'];
$supplier_group_id=$_POST['client_id'];
$choices= $_POST['yyy'];
$services_choices= $_POST['yyyy'];

$plan_active_bit=1;	

$user_active="1";


$service_type="Included";

$no_branches=count($choices);
$no_Services=count($services_choices);

$Choice_Count=0;

 $plan_id = wp_insert_post([
		'post_name'=> $plan_name, 
		'post_title' => $plan_name,
		'post_type' => 'plan',
		'post_status' => 'Publish'
		
	]);
	
 $fillable = [
	'field_5dc84e92f5adf' => $select_product,
	'field_5db92edaa0a86' => $supplier_group_id,
	'field_5dc4f66b4d95a' => $age_min1,
	'field_5dc4f6974d95c' => $age_min2,
	'field_5dc4f6c24d95e' => $age_min3,
	'field_5dc4f6f74d960' => $age_min4,
	'field_5dc4f67c4d95b' => $age_max1,
	'field_5dc4f6a64d95d' => $age_max2,
	'field_5dc4f6e54d95f' => $age_max3,
	'field_5dc4f7044d961' => $age_max4,
	'field_5dba70608f8eb' => $no_limit_spouse,
	'field_5dba70c68f8ec' => $no_limit_children,
	'field_5dba70e38f8ed' => $no_limit_parents,
	'field_5dc4f7274d962' => $no_limit_1,
	'field_5dc4f7384d963' => $no_limit_2,
	'field_5dc4f7464d964' => $no_limit_3,
	'field_5dc4f7554d965' => $no_limit_4,
	'field_5dba74138f8ee' => $age_limit_main,
	'field_5dba74678f8ef' => $age_limit_spouse,
	'field_5dba747b8f8f0' => $age_limit_parents,
	'field_5dba75148f8f1' => $additional_info,
	'field_5dba75408f8f2' => $plan_active_bit,
	'field_5dba756e8f8f3' => $user_active,
	'field_5dba75b68f8f4' => $no_branches,
	'field_5dba75c78f8f5' => $no_Services
   ];	
	
  foreach ($fillable as $key => $ma_no_branches){
	   update_field($key, $ma_no_branches, $plan_id );
	} 	


//Get Provider ID
function Get_Provider_ID($key, $value) {
        global $wpdb;
	$meta = $wpdb->get_results("SELECT * FROM ".$wpdb->postmeta." WHERE meta_key='".$wpdb->escape($key)."' AND meta_value='".esc_sql($value)."'");
 
	if (is_array($meta) && !empty($meta) && isset($meta[0])) {
		$meta = $meta[0];
	}
	if (is_object($meta)) {
		return $meta->post_id;
	}else {
			return false;
		}
}



//---------END 1------------//

$Choice_Count=0;

while($Choice_Count < $no_branches){
	$choice0= $choices[$Choice_Count];	
	$pieces = explode(" ~ ", $choice0);
	$add1 = $pieces[1];
	
//Get Provider ID

$supplier_id = Get_Provider_ID('phys_addr1',$add1);
//End Get Provider ID


 $plan_service2 = wp_insert_post([
		'post_name'=> $plan_id, 
		'post_title' => $plan_id,
		'post_type' => 'provider_product',
		'post_status' => 'Publish'
		
	]);


 $fillable2 = [
	'field_5db92edaa0a86' => $supplier_group_id,
	'field_5dc84d3503333' => $supplier_id,
	'field_5dc84e92f5adf' => $select_product,
	'field_5db92f8e3aebd' => $plan_id
	
   ];	
	
 foreach ($fillable2 as $key2 => $no_branches2){
	   update_field($key2, $no_branches2, $plan_service2 );
	} 	

$Choice_Count++;	
}

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
$New_Active_Plans = $Old_active_plans + 1;
//Update Service
   $update_service = wp_update_post([
	'ID' => $service_id,
	'post_type' => 'service',
  ]);
   
  $fillable = [
	'field_5db94b3f803da' => $New_Active_Plans	
   ];
   
  foreach ($fillable as $key => $ma_no_branches){
	   update_field($key, $ma_no_branches, $update_service );
}   


//End Update Service



 $plan_service3 = wp_insert_post([
		'post_name'=> $service_id, 
		'post_title' => $service_id,
		'post_type' => 'plan_service',
		'post_status' => 'Publish'
		
	]);


 $fillable3 = [
	'field_5dca7a455f927' => $service_id,
	'field_5dbaba591a7c2' => $service_type,
	'field_5db92f8e3aebd' => $plan_id
	
   ];	
	
 foreach ($fillable3 as $key3 => $no_branches3){
	   update_field($key3, $no_branches3, $plan_service3 );
	} 	

$Service_Count++;	
}



echo '<script type="text/javascript">'
, 'profilegood();'
, '</script>';	
?>