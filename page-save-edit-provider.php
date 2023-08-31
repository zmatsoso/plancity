<?php
 if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }

$Provider_Id=$_GET['Provider_Id'];

			$Old_Provider_args = array(
			'p'         => $Provider_Id, // ID of a page, post, or custom type
			'post_type' => 'provider'
			);
			$Old_Provider_Posts = new WP_Query($Old_Provider_args);
			while($Old_Provider_Posts->have_posts()){
			$Old_Provider_Posts->the_post(); 
		
			$Old_provider_active=get_field('provider_active');
			$ReletedArea=get_field('related_area');

			foreach($ReletedArea as $Area){
						$Old_Area_Id = $Area->ID;
			}
			}



$client_id=$_GET['client_id'];
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
$Area_Id=$_GET['address_city'];
$address_state=$_GET['address_state'];
$select_province=$_GET['select_province'];
$time_code=$_GET['time_code'];
$bus_type=$_GET['bus_type'];
$provider_active=$_GET['supplier_active'];

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


?>

<script type="text/javascript">
function profilegood(){
	window.location = `<?php echo site_url('clients')?>`
};
</script>

<?php
$update_provider=$Provider_Id;

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
	'field_5db92e635b332' => $Area_Id,	
	'field_5db95dfe66600' => $provider_active
   ];
   
  foreach ($fillable as $key => $ma_no_branches){
	   update_field($key, $ma_no_branches, $update_provider );
	} 	

	wp_reset_postdata();
	

	
if($Old_Area_Id!=$Area_Id){  // Start Changed Area
	
		//All in New Area
	$Old_Area_args = array(
	'p'         => $Old_Area_Id, // ID of a page, post, or custom type
	'post_type' => 'area'
	);
		$Old_AreaPosts = new WP_Query($Old_Area_args);

       while($Old_AreaPosts->have_posts()){
		$Old_AreaPosts->the_post(); 
			$Old_Area_no_branches = get_field('no_branches');
			$Old_Area_no_active_branches = get_field('no_active_branches');
			$Old_related_province = get_field('related_province');
			foreach($Old_related_province as $Old_Province){
						$Old_Province_ID = $Old_Province->ID;
			}

	   }

		$Cum_Old_Area_no_branches = $Old_Area_no_branches - 1;
		$Cum_Old_Area_no_active_branches = $Old_Area_no_active_branches - 1;
		
	 $fillable22 = [
	'field_5db934f85ed26' => $Cum_Old_Area_no_branches,
	'field_5db935185ed27' => $Cum_Old_Area_no_active_branches
		 ];
	
	  foreach ($fillable22 as $key22 => $no_branches22){
	   update_field($key22, $no_branches22, $Old_Area_Id );
	} 	
	//End Add in New Area

	
	//All in New Area
	$New_Area_args = array(
	'p'         => $Area_Id, // ID of a page, post, or custom type
	'post_type' => 'area'
	);
		$New_AreaPosts = new WP_Query($New_Area_args);

       while($New_AreaPosts->have_posts()){
		$New_AreaPosts->the_post(); 
			$New_Area_no_branches = get_field('no_branches');
			$New_Area_no_active_branches = get_field('no_active_branches');
	   }

		$Cum_New_Area_no_branches = $New_Area_no_branches + 1;
		$Cum_New_Area_no_active_branches = $New_Area_no_active_branches + 1;
		
	 $fillable2 = [
	'field_5db934f85ed26' => $Cum_New_Area_no_branches,
	'field_5db935185ed27' => $Cum_New_Area_no_active_branches
		 ];
	
	  foreach ($fillable2 as $key2 => $no_branches2){
	   update_field($key2, $no_branches2, $Area_Id );
	} 	
	//End Add in New Area

	wp_reset_postdata();

//Update Provinces - 	
	$Old_province_args = array(
	'p'         => $Old_Province_ID, // ID of a page, post, or custom type
	'post_type' => 'province'
	);
		$Old_ProvincePosts = new WP_Query($Old_province_args );

       while($Old_ProvincePosts->have_posts()){
		$Old_ProvincePosts->the_post(); 
			
			$Old_Province_no_branches = get_field('no_branches');
			$Old_Province_no_active_branches = get_field('no_active_branches');
	   }

		$Cum_Old_Province_no_branches = $Old_Province_no_branches - 1;
		$Cum_Old_Province_no_active_branches = $Old_Province_no_active_branches - 1;
		
	 $fillable33 = [
	'field_5db92b6bede7d' => $Cum_Old_Province_no_branches,
	'field_5db92c2cede7e' => $Cum_Old_Province_no_active_branches
		 ];
	
	  foreach ($fillable33 as $key33 => $no_branches33){
	   update_field($key33, $no_branches33, $Old_Province_ID );
	} 	


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
} //End Changed Area	


if(($Old_provider_active!=$provider_active)&& ($provider_active==0)){  // Start Changed Area
	

	//All in New Area
	$New_Area_args = array(
	'p'         => $Area_Id, // ID of a page, post, or custom type
	'post_type' => 'area'
	);
		$New_AreaPosts = new WP_Query($New_Area_args);

       while($New_AreaPosts->have_posts()){
		$New_AreaPosts->the_post(); 
			$New_Area_no_active_branches = get_field('no_active_branches');
	   }

		$Cum_New_Area_no_active_branches = $New_Area_no_active_branches - 1;
		
	 $fillable222 = [
	'field_5db935185ed27' => $Cum_New_Area_no_active_branches
		 ];
	
	  foreach ($fillable222 as $key222 => $no_branches222){
	   update_field($key222, $no_branches222, $Area_Id );
	} 	
	//End Add in New Area

	wp_reset_postdata();



//Update Provinces - 	
	$province_args = array(
	'p'         => $select_province, // ID of a page, post, or custom type
	'post_type' => 'province'
	);
		$ProvincePosts = new WP_Query($province_args );

       while($ProvincePosts->have_posts()){
		$ProvincePosts->the_post(); 
			
			$_no_active_branches__ = get_field('no_active_branches');
	   }

		$_no_active_branches_ = $_no_active_branches__ - 1;
		
	 $fillable333 = [
	'field_5db92c2cede7e' => $_no_active_branches_
		 ];
	
	  foreach ($fillable333 as $key333 => $no_branches333){
	   update_field($key333, $no_branches333, $select_province );
	} 	

	wp_reset_postdata();		
	
	//Update Clients - 	
	$Client_args = array(
	'p'         => $client_id, // ID of a page, post, or custom type
	'post_type' => 'client'
	);
		$ClientPosts = new WP_Query($Client_args );

       while($ClientPosts->have_posts()){
		$ClientPosts->the_post(); 
			
			$Client_no_active_branches__ = get_field('no_active_branches');
	   }

		$Client_no_active_branches_ = $Client_no_active_branches__ - 1;
		
	 $fillable3334 = [
	'field_5db953c13957e' => $Client_no_active_branches_
		 ];
	
	  foreach ($fillable3334 as $key3334 => $no_branches3334){
	   update_field($key3334, $no_branches3334, $client_id );
	} 	

	wp_reset_postdata();		

} //End Changed Area	



if(($Old_provider_active!=$provider_active)&& ($provider_active==1)){  // Start Changed Area
	

	//All in New Area
	$New_Area_args = array(
	'p'         => $Area_Id, // ID of a page, post, or custom type
	'post_type' => 'area'
	);
		$New_AreaPosts = new WP_Query($New_Area_args);

       while($New_AreaPosts->have_posts()){
		$New_AreaPosts->the_post(); 
			$New_Area_no_active_branches = get_field('no_active_branches');
	   }

		$Cum_New_Area_no_active_branches = $New_Area_no_active_branches + 1;
		
	 $fillable222 = [
	'field_5db935185ed27' => $Cum_New_Area_no_active_branches
		 ];
	
	  foreach ($fillable222 as $key222 => $no_branches222){
	   update_field($key222, $no_branches222, $Area_Id );
	} 	
	//End Add in New Area

	wp_reset_postdata();



//Update Provinces - 	
	$province_args = array(
	'p'         => $select_province, // ID of a page, post, or custom type
	'post_type' => 'province'
	);
		$ProvincePosts = new WP_Query($province_args );

       while($ProvincePosts->have_posts()){
		$ProvincePosts->the_post(); 
			
			$_no_active_branches__ = get_field('no_active_branches');
	   }

		$_no_active_branches_ = $_no_active_branches__ + 1;
		
	 $fillable333 = [
	'field_5db92c2cede7e' => $_no_active_branches_
		 ];
	
	  foreach ($fillable333 as $key333 => $no_branches333){
	   update_field($key333, $no_branches333, $select_province );
	} 	

	wp_reset_postdata();		
	
	//Update Clients - 	
	$Client_args = array(
	'p'         => $client_id, // ID of a page, post, or custom type
	'post_type' => 'client'
	);
		$ClientPosts = new WP_Query($Client_args );

       while($ClientPosts->have_posts()){
		$ClientPosts->the_post(); 
			
			$Client_no_active_branches__ = get_field('no_active_branches');
	   }

		$Client_no_active_branches_ = $Client_no_active_branches__ + 1;
		
	 $fillable3334 = [
	'field_5db953c13957e' => $Client_no_active_branches_
		 ];
	
	  foreach ($fillable3334 as $key3334 => $no_branches3334){
	   update_field($key3334, $no_branches3334, $client_id );
	} 	

	wp_reset_postdata();		

} //End Changed Area	



	
	


echo '<script type="text/javascript">'
, 'profilegood();'
, '</script>';	
?>