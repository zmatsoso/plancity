<?php 
 if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }
?>


<script type="text/javascript">
function profilegood(){
	window.location = `<?php echo site_url('clients'); ?>`
};
</script>

<?php
$plan_name=$_GET['plan_name'];

$client_id=$_GET['client_id'];
$plan_id=$_GET['plan_id'];

$age_min1=$_GET['age_min1'];
$age_min2=$_GET['age_min2'];
$age_min3=$_GET['age_min3'];
$age_min4=$_GET['age_min4'];
$age_max1=$_GET['age_max1'];
$age_max2=$_GET['age_max2'];
$age_max3=$_GET['age_max3'];
$age_max4=$_GET['age_max4'];


$no_limit_spouse=$_GET['no_limit_spouse'];
$no_limit_children=$_GET['no_limit_children'];
$no_limit_parents=$_GET['no_limit_parents'];
$no_limit_1=$_GET['no_limit_1'];
$no_limit_2=$_GET['no_limit_2'];
$no_limit_3=$_GET['no_limit_3'];
$no_limit_4=$_GET['no_limit_4'];


$age_limit_main=$_GET['age_limit_main'];
$age_limit_spouse=$_GET['age_limit_spouse'];
$age_limit_parents=$_GET['age_limit_parents'];


$additional_info=$_GET['additional_info'];

$select_product=$_GET['select_product'];

$plan_active=$_GET['plan_active'];
if($plan_active==1){
$plan_active_bit=1;	
}else{
$plan_active_bit=0;	
}


 $update_plan = wp_update_post([
		'ID' => $plan_id,
		'post_name'=> $plan_name, 
		'post_title' => $plan_name,
		'post_type' => 'plan'
	]);
	
 $fillable = [
	'field_5dba70248f8ea' => $select_product,
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
	'field_5dba75408f8f2' => $plan_active_bit
   ];	
	
  foreach ($fillable as $key => $ma_no_branches){
	   update_field($key, $ma_no_branches, $update_plan );
	} 	





echo '<script type="text/javascript">'
, 'profilegood();'
, '</script>';	
?>