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

$choices= $_POST['yyy'];

$premium_amount=$_POST['premium_amount'];	

$no_branches=count($choices);

$gender=$_POST['gender'];

//---------END 1------------//

$Choice_Count=0;

while($Choice_Count < $no_branches){
$Age= $choices[$Choice_Count];	
$Choice_Count++;	
			$hold_args = array(
			'name'         => $Age, // ID of a page, post, or custom type
			'post_type' => 'ages'
			);
			$AgesPosts = new WP_Query($hold_args);
			while($AgesPosts->have_posts()){
			$AgesPosts->the_post(); 
		
			$Age_ID = get_the_ID();
			}


//Insert
  $inserted_premium = wp_insert_post([
	'post_type' => 'premium',
	'post_status' => 'Publish',
   ]);
   
  $fillable = [
	'field_5dbac2352f793' => $Age_ID,
	'field_5dbac426bd9cc' => $gender,
	'field_5dbac2c52f794' => $premium_amount,
	'field_5db92f8e3aebd' => $plan_id	
   ];
   
  foreach ($fillable as $key => $ma_no_branches){
	   update_field($key, $ma_no_branches, $inserted_premium );
}   
//End Insert


}


//_-----------------------------------------------------------services---------------------------------------------------------------------




echo '<script type="text/javascript">'
, 'profilegood();'
, '</script>';	
?>