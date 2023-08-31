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

$client_active_new=$_GET['client_active'];
$client_id=$_GET['client_id'];

	$hold_args = array(
	'p'         => $client_id, // ID of a page, post, or custom type
	'post_type' => 'client'
	);
	$ClientPosts = new WP_Query($hold_args);
	 while($ClientPosts->have_posts()){
		$ClientPosts->the_post(); 

	$client_active_old= get_field('client_active'); 

	 }

if($client_active_new!=$client_active_old){

//Update Client

  $update_client = wp_update_post([
	'ID' => $client_id,
	'post_type' => 'client',
  ]);
   
  $fillable = [
	'field_5db94fb84ebcc' => $client_active_new	
   ];
   
  foreach ($fillable as $key => $no_branches){
	   update_field($key, $no_branches, $update_client );
}   
//End Update Client
	


//Get Providers
$ProviderPosts = new WP_Query(array(
			'posts_per_page' => -1,
			'post_type' => 'provider',
			'meta_query' => array(
				array(
				'key' => 'related_client',
				'compare' => 'LIKE',
				'value' => $client_id //get_current_user_id()
				)
			)

			));
			while($ProviderPosts->have_posts()){
			$ProviderPosts->the_post(); 
				
			//Update Provider
   
			$fillable2 = [
			'field_5dd6b77f995dc' => $client_active_new	
			];
   
			foreach ($fillable2 as $key2 => $no_branches2){
			update_field($key2, $no_branches2, $updated_provider );
			}   
			//End Update Provider
		 }	
//End Get Providers	


//Get Providers
$PlanPosts = new WP_Query(array(
			'posts_per_page' => -1,
			'post_type' => 'plan',
			'meta_query' => array(
				array(
				'key' => 'related_client',
				'compare' => 'LIKE',
				'value' => $client_id //get_current_user_id()
				)
			)

			));
			while($PlanPosts->have_posts()){
			$PlanPosts->the_post(); 
				
			//Update Provider
   
			$fillable3 = [
			'field_5dba756e8f8f3' => $client_active_new	
			];
   
			foreach ($fillable3 as $key3 => $no_branches3){
			update_field($key3, $no_branches3, $updated_plan );
			}   
			//End Update Provider
		 }	
//End Get Providers	

	
	
}


echo '<script type="text/javascript">'
, 'profilegood();'
, '</script>';	

?>