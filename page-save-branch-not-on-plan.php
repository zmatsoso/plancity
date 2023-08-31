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

$plan_id=$_POST['plan_id'];

	$hold_args = array(
	'p'         => $plan_id, // ID of a page, post, or custom type
	'post_type' => 'plan'
	);
	$PlanPosts = new WP_Query($hold_args);
	 while($PlanPosts->have_posts()){
		$PlanPosts->the_post(); 
		
		$Old_no_branches = get_field('no_branches');

		//Get Client Id
		$Related_Client = get_field('related_client');
		foreach($Related_Client as $Client){
				$Client_Id = $Client->ID;
		}//End Get Client Id
		
		//Get Product Id
		$Related_Product = get_field('related_product');
		foreach($Related_Product as $Product){
				$Product_Id = $Product->ID;
		}//End Get Client Id


	 }


$choices= $_POST['yyy'];

$no_branches=count($choices);

$New_No_Branches = $Old_no_branches + $no_branches;


//Update Plan
  $update_plan = wp_update_post([
	'ID' => $plan_id,
	'post_type' => 'plan',
  ]);
   
  $fillable = [
	'field_5dba75b68f8f4' => $New_No_Branches	
   ];
   
  foreach ($fillable as $key => $ma_no_branches){
	   update_field($key, $ma_no_branches, $update_plan );
}   
//End Updtate plan


//Get Provider ID
function Get_Provider_ID($key, $value) {
        global $wpdb;
	$meta = $wpdb->get_results("SELECT * FROM ".$wpdb->postmeta." WHERE meta_key='".$wpdb->escape($key)."' AND meta_value='".esc_sql($value)."'");
 
	if (is_array($meta) && !empty($meta) && isset($meta[0])) {
		$meta = $meta[0];
	}
	if (is_object($meta)) {
		return $meta->post_id;
	}else {
			return false;
		}
}



//---------END 1------------//

$Choice_Count=0;

while($Choice_Count < $no_branches){
	$choice0= $choices[$Choice_Count];	
	$pieces = explode(" ~ ", $choice0);
	$add1 = $pieces[1];
	
//Get Provider ID

$supplier_id = Get_Provider_ID('phys_addr1',$add1);
//End Get Provider ID


 $plan_service2 = wp_insert_post([
		'post_name'=> $plan_id, 
		'post_title' => $plan_id,
		'post_type' => 'provider_product',
		'post_status' => 'Publish'
		
	]);


 $fillable2 = [
	'field_5db92edaa0a86' => $Client_Id,
	'field_5dc84d3503333' => $supplier_id,
	'field_5dc84e92f5adf' => $Product_Id,
	'field_5db92f8e3aebd' => $plan_id
	
   ];	
	
 foreach ($fillable2 as $key2 => $no_branches2){
	   update_field($key2, $no_branches2, $plan_service2 );
	} 	

$Choice_Count++;	
}




echo '<script type="text/javascript">'
, 'profilegood();'
, '</script>';	
?>