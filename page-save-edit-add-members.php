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

$spouse=$_POST['spouse'];
$child14_21_25=$_POST['child14_21_25'];
$child6_13=$_POST['child6_13'];
$child1_5=$_POST['child1_5'];
$child0_11Mnts=$_POST['child0_11Mnts'];
$parent=$_POST['parent'];
$band1=$_POST['band1'];
$band2=$_POST['band2'];
$band3=$_POST['band3'];
$band4=$_POST['band4'];


$add_spouse=$_POST['add_spouse'];
$add_child14_21_25=$_POST['add_child14_21_25'];
$add_child6_13=$_POST['add_child6_13'];
$add_child1_5=$_POST['add_child1_5'];
$add_child0_11Mnts=$_POST['add_child0_11Mnts'];
$add_parent=$_POST['add_parent'];
$add_band1=$_POST['add_band1'];
$add_band2=$_POST['add_band2'];
$add_band3=$_POST['add_band3'];
$add_band4=$_POST['add_band4'];

$add_max_spouse=$_POST['add_max_spouse'];
$add_max_child14_21_25=$_POST['add_max_child14_21_25'];
$add_max_child6_13=$_POST['add_max_child6_13'];
$add_max_child1_5=$_POST['add_max_child1_5'];
$add_max_child0_11Mnts=$_POST['add_max_child0_11Mnts'];
$add_max_parent=$_POST['add_max_parent'];
$add_max_band1=$_POST['add_max_band1'];
$add_max_band2=$_POST['add_max_band2'];
$add_max_band3=$_POST['add_max_band3'];
$add_max_band4=$_POST['add_max_band4'];

  $update_plan_service = wp_update_post([
	'ID' => $plan_service_id,
	'post_type' => 'plan_service',
  ]);
 
  $fillable = [
	'field_5df77f19da80a' => $spouse,		
	'field_5df77f3bda80b' => $child14_21_25,	
	'field_5df77f4dda80c' => $child6_13,	
	'field_5df77f77da80e' => $child1_5,	
	'field_5df77f8ada80f' => $child0_11Mnts,	
	'field_5df78008da810' => $parent,	
	'field_5df7801cda811' => $band1,	
	'field_5df7802fda812' => $band2,	
	'field_5df7803ada813' => $band3,	
	'field_5df78046da814' => $band4,

	'field_5df74adf2b559' => $add_spouse,		
	'field_5df74afa2b55a' => $add_child14_21_25,	
	'field_5df74b422b55b' => $add_child6_13,	
	'field_5df74b582b55c' => $add_child1_5,	
	'field_5df74b6e2b55d' => $add_child0_11Mnts,	
	'field_5df74b8e2b55e' => $add_parent,	
	'field_5df74ba32b55f' => $add_band1,	
	'field_5df74bb02b560' => $add_band2,	
	'field_5df74bc32b561' => $add_band3,	
	'field_5df74bd62b562' => $add_band4,

	'field_5df74c302b563' => $add_max_spouse,		
	'field_5df74c462b564' => $add_max_child14_21_25,	
	'field_5df74c5a2b565' => $add_max_child6_13,	
	'field_5df74c6b2b566' => $add_max_child1_5,	
	'field_5df74c7b2b567' => $add_max_child0_11Mnts,	
	'field_5df74c8c2b568' => $add_max_parent,	
	'field_5df74c9f2b569' => $add_max_band1,	
	'field_5df74cb72b56a' => $add_max_band2,	
	'field_5df74cc32b56b' => $add_max_band3,	
	'field_5df74cd32b56c' => $add_max_band4
	
   ];
   
  foreach ($fillable as $key => $ma_no_branches){
	   update_field($key, $ma_no_branches, $update_plan_service );
}   
	


echo '<script type="text/javascript">'
, 'profilegood();'
, '</script>';	
?>