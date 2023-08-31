<?php
	$area_id=$_GET['ID']; 
	?>
	
	<select name="select_lat1" id="select_lat1">
	<option value="">Suggest Area Latitude</option>
   <?php

	$hold_args = array(
	'p'         => $area_id, // ID of a page, post, or custom type
	'post_type' => 'area'
	);
	$AreaPosts = new WP_Query($hold_args);
	 while($AreaPosts->have_posts()){
		$AreaPosts->the_post(); 
		
		$lat = get_field('area_latitude');
	 }
		
		
?>


<option value=""><?php echo $lat; ?></option>

</select>

