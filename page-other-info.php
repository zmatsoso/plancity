<?php
$premuim_id=$_GET['id'];
$service_type="Included";
 get_header(); 
 
 	$premium_args = array(
	'p'         => $premuim_id, // ID of a page, post, or custom type
	'post_type' => 'premium'
	);
	$PremiumPosts = new WP_Query($premium_args);
	 while($PremiumPosts->have_posts()){
		$PremiumPosts->the_post(); 
		$Plan_Arrey = get_field('related_plan');
			foreach($Plan_Arrey as $Plan){
						$Plan_Id = $Plan->ID;
			}

	 }
 	$plan_args = array(
	'p'         => $Plan_Id, // ID of a page, post, or custom type
	'post_type' => 'plan'
	);
	$PlanPosts = new WP_Query($plan_args);
	 while($PlanPosts->have_posts()){
		$PlanPosts->the_post(); 
		$Plan_name = get_the_title();
		$additional_info = get_field('additional_info');
		$Client_Array = get_field('related_client');
			foreach($Client_Array as $Client){
						$Client_Id = $Client->ID;
			}

	 }
 	$client_args = array(
	'p'         => $Client_Id, // ID of a page, post, or custom type
	'post_type' => 'client'
	);
	$ClientPosts = new WP_Query($client_args);
	 while($ClientPosts->have_posts()){
		$ClientPosts->the_post(); 
		$Client_name = get_the_title();

	 }

 ?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php echo $Plan_name; ?></h1>
      <div class="page-banner__intro">
        <p><?php echo $Client_name; ?></p>
      </div>
    </div>  
  </div>
   <div class="container container--narrow page-section">

    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><span class="metabox__blog-home-link">Other Plan Info</span></p>
    </div>
<style>
p.a {
  font-style: normal;
}

p.b {
  font-style: italic;
}

p.c {
  font-style: oblique;
}
</style>
	
                  
            <p><font color="blue"><strong>Additional Plan Info:</strong></font></p>
			<p> <table width="100%" border="0" cellspacing="0" cellpadding="2">
							 <tr>
  
    <td width="100%" class="_fields"><?php echo $additional_info?></td>
   
  </tr>
 </table>
					

</p>


