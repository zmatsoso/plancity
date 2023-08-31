<?php
	$area_id=$_GET['ID']; 
	?>
	
	<select name="select_long" id="select_long" onchange="get_coo_lat(this.value)">
	<option value="">Suggest Area Longitude</option>
   <?php

	$hold_args = array(
	'p'         => $area_id, // ID of a page, post, or custom type
	'post_type' => 'area'
	);
	$AreaPosts = new WP_Query($hold_args);
	 while($AreaPosts->have_posts()){
		$AreaPosts->the_post(); 
		
		$longi = get_field('area_longitude');
	 }
		
		
?>


<option value=""><?php echo $longi; ?></option>

</select>

