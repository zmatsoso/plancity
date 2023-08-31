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

$PremiumId=$_GET['ID'];

		$PremiumPosts = new WP_Query(array(
			'posts_per_page' => -1,
			'post_type' => 'premium',
		));

       while($PremiumPosts->have_posts()){
		$PremiumPosts->the_post(); 
			
		wp_delete_post($PremiumId, false);	  

		}


echo '<script type="text/javascript">'
, 'profilegood();'
, '</script>';	
?>