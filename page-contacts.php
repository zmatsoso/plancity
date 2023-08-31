<?php
$premuim_id=$_GET['id'];
 get_header(); 
 
 	$provider_args = array(
	'p'         => $premuim_id, // ID of a page, post, or custom type
	'post_type' => 'provider'
	);
	$ProviderPosts = new WP_Query($provider_args);
	 while($ProviderPosts->have_posts()){
		$ProviderPosts->the_post(); 
			

		$Client_Array = get_field('related_client');
			foreach($Client_Array as $Client){
						$Client_Id = $Client->ID;
			}
		$Area_Array = get_field('related_area');
			foreach($Area_Array as $Area){
						$Area_Id = $Area->ID;
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
 	$area_args = array(
	'p'         => $Area_Id, // ID of a page, post, or custom type
	'post_type' => 'area'
	);
	$AreaPosts = new WP_Query($area_args);
	 while($AreaPosts->have_posts()){
		$AreaPosts->the_post(); 
		$Area_name = get_the_title();

	 }

 ?>
 
   <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php echo $Area_name; ?> Branch</h1>
      <div class="page-banner__intro">
        <p><?php echo $Client_name; ?></p>
      </div>
    </div>  
  </div>
   <div class="container container--narrow page-section">

    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><span class="metabox__blog-home-link">Contact Info</span></p>
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