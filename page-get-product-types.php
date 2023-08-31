<?php
$category=$_GET['ID'];
?>

<select class="s_select" name="product_type"  id="product_type">
						<option value="">Select Plan Type</option>
						<?php
								$AgesPosts = new WP_Query(array(
								'posts_per_page' => -1,
								'post_type' => 'product',
								'orderby' => 'title',
								'order' => 'ASC',
								'meta_query' => array(
								array(
								'key' => 'related_category',
								'compare' => 'LIKE',
								'value' => $category //get_current_user_id()
								)
								)
								));
								while($AgesPosts->have_posts()){
								$AgesPosts->the_post(); 
								
									//Get Product
									$Related_Product = get_field('related_product_type');
			
									foreach($Related_Product as $Product){
									$Product_title = get_the_title($Product);
									}

?>
								<option value="<?php echo get_the_ID(); ?>"><?php echo $Product_title; ?></option>
								<?php } ?>
						</select>
						
						
						
