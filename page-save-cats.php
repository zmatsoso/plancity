<?php 
 if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }
?>


<script type="text/javascript">
function profilegood(){
	window.location = "product_cats"
};
</script>

<?php

$product_category=$_POST['product_category'];
	wp_insert_post([
		'post_name'=> $product_category, 
		'post_title' => $product_category,
		'post_type' => 'product_cat',
		'post_status' => 'Publish'
		
	]);

	


echo '<script type="text/javascript">'
, 'profilegood();'
, '</script>';	
?>