<?php 
 if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }
?>


<script type="text/javascript">
function profilegood(){
	window.location = `<?php echo site_url('products')?>`
};
</script>

<?php

$select_product=$_POST['select_product'];
$select_category=$_POST['select_category'];


//Get single record
	$hold_args = array(
	'p'         => $select_product, // ID of a page, post, or custom type
	'post_type' => 'product_type'
	);
	$ProductPosts = new WP_Query($hold_args);
	 while($ProductPosts->have_posts()){
		$ProductPosts->the_post(); 
		
		$Product_type_name = get_the_title();
	 }
//Get single record
	$hold_args2 = array(
	'p'         => $select_category, // ID of a page, post, or custom type
	'post_type' => 'product_cat'
	);
	$CategoryPosts = new WP_Query($hold_args2);
	 while($CategoryPosts->have_posts()){
		$CategoryPosts->the_post(); 
		
		$categoty_name = get_the_title();
	 }



 $plan_id = wp_insert_post([
		'post_name'=> $Product_type_name . ' - ' . $categoty_name, 
		'post_title' => $Product_type_name . ' - ' . $categoty_name,
		'post_type' => 'product',
		'post_status' => 'Publish'
		
	]);
	
 $fillable = [
	'field_5dba6001d95b8' => $select_product,
	'field_5dba5fd7d95b7' => $select_category
   ];	
	
  foreach ($fillable as $key => $ma_no_branches){
	   update_field($key, $ma_no_branches, $plan_id );
	} 	



//---------END 1------------//




echo '<script type="text/javascript">'
, 'profilegood();'
, '</script>';	
?>