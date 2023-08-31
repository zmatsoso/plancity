<?php
 if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }

$bus_name=$_GET['bus_name'];
$business_name=$_GET['business_name'];
$Contact_Person=$_GET['Contact_Person'];
$phone_home=$_GET['phone_home'];
$phone_mobile=$_GET['phone_mobile'];
$phone_work=$_GET['phone_work'];
$phone_other=$_GET['phone_other'];
$Email_Address=$_GET['Email_Address'];
$language=$_GET['language'];
$lat=$_GET['lat'];
$address_street=$_GET['address_street'];
$address_city=$_GET['address_city'];
$address_state=$_GET['address_state'];
$select_province=$_GET['select_province'];
$time_code=$_GET['time_code'];
$bus_type=$_GET['bus_type'];
$provider_active=1;
$user_active=1;

if($Email_Address==""){
			$Client_args = array(
			'p'         => $bus_name, // ID of a page, post, or custom type
			'post_type' => 'client'
			);
			$ClientPosts = new WP_Query($Client_args);
			while($ClientPosts->have_posts()){
			$ClientPosts->the_post(); 
		
			$Email_Address = get_field('client_email');
			}
}

if($phone_other==""){
			$Client_args2 = array(
			'p'         => $bus_name, // ID of a page, post, or custom type
			'post_type' => 'client'
			);
			$ClientPosts2 = new WP_Query($Client_args2);
			while($ClientPosts2->have_posts()){
			$ClientPosts2->the_post(); 
		
			$phone_other = get_field('fax_number');
			}
}

	$hold_args = array(
	'p'         => $address_city, // ID of a page, post, or custom type
	'post_type' => 'area'
	);
	$PlanPosts = new WP_Query($hold_args);
	 while($PlanPosts->have_posts()){
		$PlanPosts->the_post(); 
		
		$Area_name = get_the_title();
	 }

?>

<script type="text/javascript">
function profilegood(){
	window.location = `<?php echo site_url('providers/?ID=' . $bus_name . '&ClientName=' . $business_name); ?>`
};
</script>

<?php

	 $inserted_provider = wp_insert_post([
		'post_name'=> $business_name . '(' . $Area_name . ')', 
		'post_title' => $business_name . '(' . $Area_name . ')',
		'post_type' => 'provider'
//		'post_status' => 'Publish'
	]);

 $fillable = [
	'field_5db95615e8756' => $time_code,
	'field_5db9579895da1' => $address_street,	
	'field_5db95946c8707' => $lat,
	'field_5db95965c8708' => $language,	
	'field_5db95a52476b6' => $phone_home,
	'field_5db95b8cb8e8f' => $phone_mobile,	
	'field_5db95ba2b8e90' => $phone_work,
	'field_5db95bc1b8e91' => $phone_other,	
	'field_5db95c55b8e92' => $Email_Address,
	'field_5db95ca5b8e93' => $bus_type,
	'field_5db95920c8706' => $address_city,	
	'field_5db95dfe66600' => $provider_active,
	'field_5dd6b77f995dc' => $user_active,
	'field_5db92edaa0a86' => $bus_name	
   ];
   
  foreach ($fillable as $key => $ma_no_branches){
	   update_field($key, $ma_no_branches, $inserted_provider );
	} 	



	wp_reset_postdata();
	

//Update Areas - 	
	$args = array(
	'p'         => $address_city, // ID of a page, post, or custom type
	'post_type' => 'area'
	);
		$AreaPosts = new WP_Query($args );

       while($AreaPosts->have_posts()){
		$AreaPosts->the_post(); 
			
			$_no_branches_ = get_field('no_branches');
			$_no_active_branches_ = get_field('no_active_branches');
	   }

		$_no_branches = $_no_branches_ + 1;
		$_no_active_branches = $_no_active_branches_ + 1;
		
	 $fillable2 = [
	'field_5db934f85ed26' => $_no_branches,
	'field_5db935185ed27' => $_no_active_branches
		 ];
	
	  foreach ($fillable2 as $key2 => $no_branches2){
	   update_field($key2, $no_branches2, $address_city );
	} 	

	wp_reset_postdata();	
	
	
//Update Provinces - 	
	$province_args = array(
	'p'         => $select_province, // ID of a page, post, or custom type
	'post_type' => 'province'
	);
		$ProvincePosts = new WP_Query($province_args );

       while($ProvincePosts->have_posts()){
		$ProvincePosts->the_post(); 
			
			$_no_branches__ = get_field('no_branches');
			$_no_active_branches__ = get_field('no_active_branches');
	   }

		$_no_branches_ = $_no_branches__ + 1;
		$_no_active_branches_ = $_no_active_branches__ + 1;
		
	 $fillable3 = [
	'field_5db92b6bede7d' => $_no_branches_,
	'field_5db92c2cede7e' => $_no_active_branches_
		 ];
	
	  foreach ($fillable3 as $key3 => $no_branches3){
	   update_field($key3, $no_branches3, $select_province );
	} 	

	wp_reset_postdata();		
	
//Update Clients - 	
	$Client_args3 = array(
	'p'         => $bus_name, // ID of a page, post, or custom type
	'post_type' => 'client'
	);
		$ClientPosts3 = new WP_Query($Client_args3);

       while($ClientPosts3->have_posts()){
		$ClientPosts3->the_post(); 
			
			$Old_branches = get_field('no_branches');
			$Old_active_branches = get_field('no_active_branches');
	   }

		$New_branches = $Old_branches + 1;
		$New_active_branches = $Old_active_branches + 1;
		
	 $fillable4 = [
	'field_5db953a43957d' => $New_branches,
	'field_5db953c13957e' => $New_active_branches
		 ];
	
	  foreach ($fillable4 as $key4 => $no_branches4){
	   update_field($key4, $no_branches4, $select_client );
	} 	

	wp_reset_postdata();		


echo '<script type="text/javascript">'
, 'profilegood();'
, '</script>';	
?>