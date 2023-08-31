<?php 
 if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }
?>


<script type="text/javascript">
function profilegood(){
	window.location = "agess"
};
</script>

<?php

$age=$_POST['age'];
	wp_insert_post([
		'post_name'=> $age, 
		'post_title' => $age,
		'post_type' => 'ages',
		'post_status' => 'Publish'
		
	]);

	


echo '<script type="text/javascript">'
, 'profilegood();'
, '</script>';	
?>