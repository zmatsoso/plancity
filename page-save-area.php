<?php 
 if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }
?>


<script type="text/javascript">
function profilegood(){
	window.location = `<?php echo site_url('areas')?>`
};
</script>

<?php

$area_name=$_POST['area_name'];
$latitude=$_POST['latitude'];
$longitude=$_POST['longitude'];

$select_province=$_POST['select_province'];


//Insert
  $inserted_province = wp_insert_post([
	'post_title' => $area_name,
	'post_name' => $area_name,
	'post_type' => 'area',
	'post_status' => 'Publish',
   ]);
   
  $fillable = [
	'field_5db9326c5ed23' => $select_province,
	'field_5db934615ed24' => $latitude,
	'field_5db9349d5ed25' => $longitude,
	'field_5db934f85ed26' => 0,
	'field_5db935185ed27' => 0	
   ];
   
  foreach ($fillable as $key => $no_branches){
	   update_field($key, $no_branches, $inserted_province );
}   
//End Insert
	


echo '<script type="text/javascript">'
, 'profilegood();'
, '</script>';	
?>