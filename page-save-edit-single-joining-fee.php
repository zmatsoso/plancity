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

$joining_fee=$_POST['joining_fee'];
$PremiumId=$_POST['PremiumId'];



//Update
  $update_joining_fee = wp_update_post([
	'ID' => $PremiumId,
	'post_type' => 'premium',
  ]);
   
  $fillable = [
	'field_5dbac2f12f795' => $joining_fee	
   ];
   
  foreach ($fillable as $key => $no_branches){
	   update_field($key, $no_branches, $update_joining_fee );
}   
//End Insert

	


echo '<script type="text/javascript">'
, 'profilegood();'
, '</script>';	
?>