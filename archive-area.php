<?php 
 if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }

get_header(); ?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">Area List</h1>
      <div class="page-banner__intro">
        <p>Manage Areas.</p>
      </div>
    </div>  
  </div>

  <div class="container container--narrow page-section">

    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo site_url('monty'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to Main Manu</a> <span class="metabox__main">Areas</span></p>
    </div>
	
	<div class="container">
	<nav class="codrops-demos">
					<a href="<?php echo site_url('new-area'); ?>">New Area</a>
	<nav>
	<br>	
	</div>	
   	<table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; background-color:#E1E1E1" width="100%">
 		<?php
		echo '<tr bgcolor="#CCCCCC" style="font-weight:bold"><td>Area</td><td>Province</td><td>No of Branches</td><td>Perc No of Branches</td><td>No of Active Branches</td><td>Perc No of Active Branches</td></tr>';
			$tot_no_branches;
			$tot_no_act_branches;
			$checker=1;
		$ClientPosts1 = new WP_Query(array(
			'posts_per_page' => -1,
			'post_type' => 'area',
			'meta_query' => array(
				array(
				'key' => 'no_branches',
				'compare' => '>=',
				'value' => $checker //get_current_user_id()
				)
			)
			
		));

       while($ClientPosts1->have_posts()){
		$ClientPosts1->the_post(); 
			
			$tot_no_branches+= get_field('no_branches');
			$tot_no_act_branches+=get_field('no_active_branches');
	   }

		$ClientPosts = new WP_Query(array(
			'posts_per_page' => -1,
			'post_type' => 'area',
			'orderby' => 'title',
			'order' => 'ASC',
			'meta_query' => array(
				array(
				'key' => 'no_branches',
				'compare' => '>=',
				'value' => $checker //get_current_user_id()
				)
			)
			
		));

		
        while($ClientPosts->have_posts()){
		$ClientPosts->the_post(); 
		$Area_Id=get_the_ID();
		$RelatedProvince = get_field('related_province');
			
			foreach($RelatedProvince as $Province){
				$Province_ID = get_the_ID($Province);
				$Province_title = get_the_title($Province);
			}
			
		$counter+=1;
		$no_branches = get_field('no_branches');
		$perc_no_branches=(($no_branches/$tot_no_branches)*100);

		$no_act_branches= get_field('no_active_branches');
		$perc_no_act_branches=(($no_act_branches/$tot_no_act_branches)*100);
		
		if($colour_select==1){
				$selected_colour="FFFFCC";
				$colour_select=2;
				}else{
				$selected_colour="FFFFFF";
				$colour_select=1;
				}
		
		?>
		
           		<tr bgcolor="<?php echo $selected_colour ?>">
                    <td align="left"><?php echo the_title(); ?></td>
					
					<td align="left"><?php echo $Province_title ?></td>
                    <td><?php echo $no_branches ?></td>
					<td><?php echo round($perc_no_branches,0); ?>%</td>
					<td><?php echo $no_act_branches ?></td>
					<td><?php echo round($perc_no_act_branches,0); ?>%</td>
                   </td>

				
		<?php }	?>
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

		Total Areas: <?php echo $counter; ?> |
		Total Branches: <?php echo $tot_no_branches; ?> |
		Total Active Branches: <?php echo $tot_no_act_branches; ?> 

  </div>
  
<?php get_footer(); ?>  