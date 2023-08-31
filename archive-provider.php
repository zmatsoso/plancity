<?php 
 if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }
get_header(); 
$client_id= $_GET['ID'];
$ClientName= $_GET['ClientName'];



?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">Branch List</h1>
      <div class="page-banner__intro">
        <p><?php echo $ClientName;	?>
		</p>
      </div>
    </div>  
  </div>

  <div class="container container--narrow page-section">

    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo site_url('clients'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to Client List</a> <span class="metabox__main">Branches</span></p>
    </div>
	
	<div class="container">
	<nav class="codrops-demos">
					<a href="<?php echo site_url('new-provider/?ID=' . $client_id . '&ClientName=' . $ClientName); ?>">New Branch</a>
	<nav>
	<br>	
	</div>	
   	<table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; background-color:#E1E1E1" width="100%">
 		<?php
		echo '<tr bgcolor="#CCCCCC" style="font-weight:bold"><td>Province</td><td>Branch Area</td><td>Address</td><td>Type</td><td>Status</td><td align="center">Options</td></tr>';
		
		$counter=0;
		$counter_active=0;
		$counter_inactive=0;
		
		wp_reset_postdata();
//Inside Provider Record		
		$ProviderPosts = new WP_Query(array(
			'posts_per_page' => -1,
			'post_type' => 'provider',
			'orderby' => 'title',
			'order' => 'ASC',
			'meta_query' => array(
				array(
				'key' => 'related_client',
				'compare' => 'LIKE',
				'value' => $client_id//get_current_user_id()
				)
			)

		));
		
		
		
        while($ProviderPosts->have_posts()){
		$ProviderPosts->the_post(); 
		$Provider_ID= get_the_ID();
		$client_active = get_field('provider_active');
		$Provider_Address = get_field('phys_addr1');
		$Provider_Type = get_field('provider_type');
		
		$RelatedArea = get_field('related_area');
		
			foreach($RelatedArea as $Area){
				$Area_title = get_the_title($Area);
				$Area_Id = $Area->ID;
			}
//		print_r($RelatedArea);
	
			$Area_args = array(
	'p'         => $Area_Id, // ID of a page, post, or custom type
	'post_type' => 'area'
	);
	$AreaPosts = new WP_Query($Area_args);
	 while($AreaPosts->have_posts()){
		$AreaPosts->the_post(); 
		
		$RelatedProvince = get_field('related_province');
		foreach($RelatedProvince as $Province){
				$Province_title = get_the_title($Province);
			}
	 }

		
		if($colour_select==1){
				$selected_colour="FFFFCC";
				$colour_select=2;
				}else{
				$selected_colour="FFFFFF";
				$colour_select=1;
				}

		if($client_active==1){
					$active="Active";
					$counter+=1;
					$counter_active+=1;
				}else{
					$active="InActive";
					$counter_inactive+=1;
				}
		
		?>
		
           		<tr bgcolor="<?php echo $selected_colour ?>">
					<td align="left"><?php echo $Province_title; ?></td>
				    <td align="left"><?php echo $Area_title; ?></td>
					<td align="left"><?php echo $Provider_Address; ?></td>
                    <td align="left"><?php echo $Provider_Type; ?></td>
					<td align="left"><?php echo $active ?></td>
                    <td align="center"><a href="<?php echo site_url('edit-provider/?ID=' . $Provider_ID . '&ClientName=' . $ClientName . '&client_id=' . $client_id); ?>">Edit</a>
                    </td>
                  
                    </td>

				
		<?php }	
		
		wp_reset_postdata();
		
		?>
        </table>
				<table>
		  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

		Total Branches: <?php echo $counter; ?> |
		Total Active: <?php echo $counter_active; ?> |
		Total InActive: <?php echo $counter_inactive; ?>

  </div>
  
<?php get_footer(); ?>  