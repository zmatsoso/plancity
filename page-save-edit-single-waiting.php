<?php 
 if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }
?>


<script type="text/javascript">
function profilegood(){
	 window.location.replace(`<?php echo site_url('clients'); ?>`);
};
</script>

<?php


$PremiumId=$_POST['PremiumId'];


			$waiting_accidental=$_POST['waiting_accidental'];
			$waiting_natural=$_POST['waiting_natural'];
			$waiting_suicide=$_POST['waiting_suicide'];
			$waiting_lapse_accidental=$_POST['waiting_lapse_accidental'];
			$waiting_lapse_natural=$_POST['waiting_lapse_natural'];
			$waiting_lapse_suicide=$_POST['waiting_lapse_suicide'];



//Update
  $update_waiting = wp_update_post([
	'ID' => $PremiumId,
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
   
  foreach ($fillable as $key => $no_branches){
	   update_field($key, $no_branches, $update_waiting );
}   
//End Insert

	


echo '<script type="text/javascript">'
, 'profilegood();'
, '</script>';	
?>