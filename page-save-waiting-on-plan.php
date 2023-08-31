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

$waiting_accidental=$_POST['waiting_accidental'];	
$waiting_natural=$_POST['waiting_natural'];	
$waiting_suicide=$_POST['waiting_suicide'];	
$waiting_lapse_accidental=$_POST['waiting_lapse_accidental'];	
$waiting_lapse_natural=$_POST['waiting_lapse_natural'];	
$waiting_lapse_suicide=$_POST['waiting_lapse_suicide'];	

$no_branches=count($choices);

//---------END 1------------//

$Choice_Count=0;

while($Choice_Count < $no_branches){
$choice0= $choices[$Choice_Count];	
	$pieces = explode(" = ", $choice0);
	$Age = $pieces[0];


			$hold_args = array(
			'name'         => $Age, // ID of a page, post, or custom type
			'post_type' => 'ages'
			);
			$AgesPosts = new WP_Query($hold_args);
			while($AgesPosts->have_posts()){
			$AgesPosts->the_post(); 
		
			$Age_ID = get_the_ID();
			}

		$Premium_Posts = new WP_Query(array(
			'post_type' => 'premium',
			'posts_per_page' => -1,
			'meta_query' => array(
				array(
				'key' => 'related_plan',
				'compare' => 'LIKE',
				'value' => $plan_id //get_current_user_id()
				),
				array(
				'key' => 'related_age',
				'compare' => 'LIKE',
				'value' => $Age_ID //get_current_user_id()
				)
			)
		));

			while($Premium_Posts->have_posts()){
			$Premium_Posts->the_post(); 
			$Premium_ID = get_the_ID();

//Update
  $update_premium = wp_update_post([
	'ID' => $Premium_ID,
	'post_type' => 'premium',
  ]);
   
  $fillable = [
	'field_5dbac32e2f796' => $waiting_accidental,
	'field_5dbac3562f797' => $waiting_natural,
	'field_5dbac3722f798' => $waiting_suicide,
	'field_5dbac38a2f799' => $waiting_lapse_accidental,
	'field_5dbac3aa2f79a' => $waiting_lapse_natural,
	'field_5dbac3be2f79b' => $waiting_lapse_suicide	
   ];
   
  foreach ($fillable as $key => $ma_no_branches){
	   update_field($key, $ma_no_branches, $update_premium );
}   
//End Insert
			}
$Choice_Count++;
}


//_-----------------------------------------------------------services---------------------------------------------------------------------




echo '<script type="text/javascript">'
, 'profilegood();'
, '</script>';	
?>