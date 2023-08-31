<?php
	$province=$_GET['ID']; 
	?>
	
	<select name="select_area" id="select_area" onchange="get_coo_long(this.value)">
    <option>Select Area</option> <?php

		$AreaPosts = new WP_Query(array(
			'posts_per_page' => -1,
			'post_type' => 'area',
			'orderby' => 'title',
			'order' => 'ASC',
			'meta_query' => array(
				array(
				'key' => 'related_province',
				'compare' => 'LIKE',
				'value' => $province//get_current_user_id()
				)
			)

		));
	
	
	    while($AreaPosts->have_posts()){
		$AreaPosts->the_post(); 
?>


<option value="<?php echo get_the_ID(); ?>"><?php echo the_title(); ?></option>
<?php } ;?>
</select>

