<?php 
 if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }
?>


<script type="text/javascript">
function profilegood(){
	window.location = "provinces"
};
</script>

<?php

$province_name=$_POST['province_name'];
	wp_insert_post([
		'post_name'=> $province_name, 
		'post_title' => $province_name,
		'post_type' => 'province',
		'post_status' => 'Publish'
		
	]);

	


echo '<script type="text/javascript">'
, 'profilegood();'
, '</script>';	
?>