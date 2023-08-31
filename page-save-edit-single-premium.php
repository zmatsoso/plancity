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

$amount=$_POST['amount'];
$PremiumId=$_POST['PremiumId'];



//Update
  $update_premium = wp_update_post([
	'ID' => $PremiumId,
	'post_type' => 'premium',
  ]);
   
  $fillable = [
	'field_5dbac2c52f794' => $amount	
   ];
   
  foreach ($fillable as $key => $no_branches){
	   update_field($key, $no_branches, $update_premium );
}   
//End Insert

	


echo '<script type="text/javascript">'
, 'profilegood();'
, '</script>';	
?>