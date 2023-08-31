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

$plan_service_id=$_POST['plan_service_id'];
$main_member=$_POST['main_member'];
$spouse=$_POST['spouse'];
$child14_21_25=$_POST['child14_21_25'];
$child6_13=$_POST['child6_13'];
$child1_5=$_POST['child1_5'];
$child0_11Mnts=$_POST['child0_11Mnts'];
$stillborn=$_POST['stillborn'];
$parent=$_POST['parent'];
$band1=$_POST['band1'];
$band2=$_POST['band2'];
$band3=$_POST['band3'];
$band4=$_POST['band4'];
$optional_cost=$_POST['optional_cost'];

  $update_plan_service = wp_update_post([
	'ID' => $plan_service_id,
	'post_type' => 'plan_service',
  ]);
 
  $fillable = [
	'field_5dbab9151a7ba' => $main_member,
	'field_5dbab9401a7bb' => $spouse,		
	'field_5dbab9681a7bd' => $child14_21_25,	
	'field_5dbab9aa1a7be' => $child6_13,	
	'field_5dbab9d81a7bf' => $child1_5,	
	'field_5dbaba011a7c0' => $child0_11Mnts,	
	'field_5dbaba2d1a7c1' => $stillborn,	
	'field_5dbab9591a7bc' => $parent,	
	'field_5dcee423c811b' => $band1,	
	'field_5dcee430c811c' => $band2,	
	'field_5dcee43ac811d' => $band3,	
	'field_5dcee451c811e' => $band4,	
	'field_5dbabacf1a7c3' => $optional_cost	
   ];
   
  foreach ($fillable as $key => $ma_no_branches){
	   update_field($key, $ma_no_branches, $update_plan_service );
}   
	


echo '<script type="text/javascript">'
, 'profilegood();'
, '</script>';	
?>