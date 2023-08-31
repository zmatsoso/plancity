<?php 
 if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }
?>


<script type="text/javascript">
function profilegood(){
	 window.location.replace(`<?php echo site_url('services'); ?>`);
};
</script>

<?php

$service_name=$_POST['service_name'];
$Description=$_POST['Description'];
$Options=$_POST['Options'];



  $update_plan_service = 	wp_insert_post([
		'post_name'=> $service_name, 
		'post_title' => $service_name,
		'post_type' => 'service',
		'post_status' => 'Publish'
		
	]);

 
  $fillable = [
	'field_5de4a8c75bf25' => $Description,
	'field_5de4a298c9225' => $Options	
   ];
   
  foreach ($fillable as $key => $ma_no_branches){
	   update_field($key, $ma_no_branches, $update_plan_service );
}   
	

echo '<script type="text/javascript">'
, 'profilegood();'
, '</script>';	
?>