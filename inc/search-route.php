<?php



				function distance($lat1, $lon1, $lat2, $lon2, $unit) {
				$lat1 = floatval($lat1);
				$lat2 = floatval($lat2);
				$lon1 = floatval($lon1);
				$lon2 = floatval($lon2);
				$theta = $lon1 - $lon2;
				$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
				$dist = acos($dist);
				$dist = rad2deg($dist);
				$miles = $dist * 60 * 1.1515;
				$unit = strtoupper($unit);

				if ($unit == "K") {
				return ($miles * 1.609344);
				} else if ($unit == "N") {
				return ($miles * 0.8684);
				} else {
				return $miles;
				}
				}


function unique_multidim_array($array, $key) {
    $temp_array = array();
    $i = 0;
    $key_array = array();
   
    foreach($array as $val) {
        if (!in_array($val[$key], $key_array)) {
            $key_array[$i] = $val[$key];
            $temp_array[$i] = $val;
        }
        $i++;
    }
    return $temp_array;
}

add_action('rest_api_init', 'plancityRegisterSearch');

function plancityRegisterSearch() {
  register_rest_route('plancity/v1', 'search', array(
    'methods' => WP_REST_SERVER::READABLE,
    'callback' => 'plancitySearchResults'
  ));
}

function plancitySearchResults($data) {
	
	$age_id = $_GET['age']; //no neeed to convert -id : Done 44
	$select_area =  $_GET['select_area']; //no neeed to convert -id 7288
	$product_id = $_GET['product_type']; //no neeed to convert -id 8272
	$Senior =  $_GET['senior_citizen']; //no neeed to convert -true/false
	$select_director = $_GET['select_director']; //no neeed to convert -id 67
	$gender_ = $_GET['gender']; //no neeed to convert -male=1/female=2
	
	
	

//Get Posted Area	
	$area_args = array(
	'p'         => $select_area, // ID of a page, post, or custom type
	'post_type' => 'area'
	);
	$AreaPosts = new WP_Query($area_args);
	 while($AreaPosts->have_posts()){
		$AreaPosts->the_post(); 
		
		$Posted_Area = get_the_title();
		$lat2 = get_field('area_latitude');
		$lon2 = get_field('area_longitude');

	 }
//End Get Posted Area



//Main Query
	$items  = array();
	
		$Main_Posts = new WP_Query(array(
			'post_type' => 'provider_product',
			'meta_query' => array(
				array(
				'key' => 'related_product',
				'compare' => 'LIKE',
				'value' =>  $product_id //get_current_user_id()
				)
			)
		));
	
		
			while($Main_Posts->have_posts()){
			$Main_Posts->the_post(); 
			$Related_Plan = get_field('related_plan');
			foreach($Related_Plan as $Plan){
				$BestPlanId = $Plan->ID;
			}

			$Related_Provider = get_field('related_provider');
			foreach($Related_Provider as $Provider){
				$ProviderId = $Provider->ID;
			}

	$provider_args = array(
	'p'         => $ProviderId, // ID of a page, post, or custom type
	'post_type' => 'provider'
	);
	$ProviderPosts = new WP_Query($provider_args);
	 while($ProviderPosts->have_posts()){
		$ProviderPosts->the_post(); 
		$phys_addr1 = get_field('phys_addr1');
		$phys_addr2 = get_field('phys_addr2');
		$lat1 = get_field('provider_latitude');
		$lon1 = get_field('provider_longitude');
		$provider_type = get_field('provider_type');
		$ProviderArea = get_field('related_area');
			foreach($ProviderArea as $Area){
				$ProviderAreaId = $Area->ID;
			}
		$ProviderClient = get_field('related_client');
			foreach($ProviderClient as $Client){
				$Client_Id = $Client->ID;
			}

	 }
	 
	$provider_area_args = array(
	'p'         => $ProviderAreaId, // ID of a page, post, or custom type
	'post_type' => 'area'
	);
	$ProviderAreaPosts = new WP_Query($provider_area_args);
	 while($ProviderAreaPosts->have_posts()){
		$ProviderAreaPosts->the_post(); 
			$ProviderAreaName = get_the_title();
	 }
	 
	$provider_client_args = array(
	'p'         => $Client_Id, // ID of a page, post, or custom type
	'post_type' => 'client'
	);
	$ProviderClientPosts = new WP_Query($provider_client_args);
	 while($ProviderClientPosts->have_posts()){
		$ProviderClientPosts->the_post(); 
			$ProviderClientName = get_the_title();
			$ClientLogo = get_the_post_thumbnail_url();
	 }

	//Nest
	$plan_args = array(
	'p'         => $BestPlanId, // ID of a page, post, or custom type
	'post_type' => 'plan'
	);
	$PlanPosts = new WP_Query($plan_args);
	 while($PlanPosts->have_posts()){
		$PlanPosts->the_post(); 
		$Plan_Name = get_the_title();
		
		$age_limit_main = get_field('age_limit_member');
		$age_limit_spouse = get_field('age_limit_spouse');
		$age_limit_parents = get_field('age_limit_parents');
		$age_limit_1 = get_field('age_max1');
		$age_limit_2 = get_field('age_max2');
		$age_limit_3 = get_field('age_max3');
		$age_limit_4 = get_field('age_max4');
		$additional_info = get_field('additional_info');
			//Nest2
			
	//Get Premium Id
		$Premium_Posts = new WP_Query(array(
			'post_type' => 'premium',
			'posts_per_page' => -1,
			'meta_query' => array(
				array(
				'key' => 'related_plan',
				'compare' => 'LIKE',
				'value' =>  $BestPlanId //get_current_user_id()
				),
				array(
				'key' => 'related_age',
				'compare' => 'LIKE',
				'value' =>  $age_id //get_current_user_id()
				)
			)
		));
	
		$premium_id_array  = array();
			while($Premium_Posts->have_posts()){
			$Premium_Posts->the_post(); 

			$premium_id = get_the_ID();
			$premiums_amount = get_field('amount');
			$joining_fee = get_field('joining_fee');
			
			
		}
//End Get Premium Id
		
			//End Nest2
				if($select_area==$phys_addr2){
				$Test2_KM = 0;
				}else{
				$Test_KM = distance($lat1, $lon1, $lat2, $lon2, "K");
				$Test2_KM = round($Test_KM,0);
				}

			array_push($items, array(
			'Premium_Amount' => $premiums_amount,
			'Joining_Fee' => $joining_fee,
			'plan_name' => $Plan_Name,
			'ProvAreaName' => $ProviderAreaName,
			'phys_addr1' => $phys_addr1,
			'ClientName' => $ProviderClientName,
			'ClientID' => $Client_Id,
			'Distance' => $Test2_KM,
			'Plan_Id' => $BestPlanId,
			
			'Age_Limit_Main' => $age_limit_main,
			'Age_Limit_Parent' => $age_limit_parents,
			'age_limit_1' => $age_limit_1,
			'age_limit_2' => $age_limit_2,
			'age_limit_3' => $age_limit_3,
			'age_limit_4' => $age_limit_4,
			'additional_info' => $additional_info,
			
			'provider_type' => $provider_type,
			
			'premium_id' => $premium_id,
			'ProviderId' => $ProviderId,
			'AreaId' => $ProviderAreaId,
			'ClientLogo' => $ClientLogo,
			));

	 }
	//End Nest
		}
//End Main Query


array_multisort(array_column($items, 'Distance'), SORT_ASC, $items); // Sorts by distance

$items = unique_multidim_array($items,'Plan_Id'); //Removes duplicate plans



switch(true){
	
case(($Senior=="true") && ($select_director=="")) :

$items = array_filter($items, function ($item) {
	$type1="Admin";
	$type2="Admin and Parlour";

    return ($item['Age_Limit_Main'] > 65 && (($item['provider_type'] == $type1) OR (($item['provider_type'] == $type2))));
});

	break;

	case(($Senior=="true") && ($select_director!="")) :
$items = array_filter($items, function ($item) {
	$type1="Admin";
	$type2="Admin and Parlour";
	$select_director =$_GET['select_director']; 
	
    return ($item['ClientID'] == $select_director && $item['Age_Limit_Main'] > 65 && (($item['provider_type'] == $type1) OR (($item['provider_type'] == $type2))));
});
	break;

	case(($Senior=="false") && ($select_director!="")) :
$items = array_filter($items, function ($item) {
	$type1="Admin";
	$type2="Admin and Parlour";
	$select_director = $_GET['select_director']; 

    return ($item['ClientID'] == $select_director && (($item['provider_type'] == $type1) OR ($item['provider_type'] == $type2)));
});
	break;

	default:
$items = array_filter($items, function ($item) {
	$type1="Admin";
	$type2="Admin and Parlour";
	
    return ((($item['provider_type'] == $type1) OR (($item['provider_type'] == $type2))));
});
	
}



array_slice($items, 0, 0);

  return $items;

}