<?php 
 if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }
?>


<script type="text/javascript">
function profilegood(){
	 window.location.replace(`<?php echo site_url('areas'); ?>`);
};
</script>

<?php

$Area_Id=$_POST['Area_Id'];
$select_province=$_POST['select_province'];
$area_name=$_POST['area_name'];
$latitude=$_POST['latitude'];
$longitude=$_POST['longitude'];




//Update
  $update_area = wp_update_post([
	'ID' => $Area_Id,
	'post_title' => $area_name,
	'post_type' => 'area',
  ]);
   
  $fillable = [
	'field_5db9326c5ed23' => $select_province,
	'field_5db934615ed24' => $latitude,
	'field_5db9349d5ed25' => $longitude
	
   ];
   
  foreach ($fillable as $key => $no_branches){
	   update_field($key, $no_branches, $update_area );
}   
//End Insert

	


echo '<script type="text/javascript">'
, 'profilegood();'
, '</script>';	
?>