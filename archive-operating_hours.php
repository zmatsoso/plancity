<?php 
 if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }

get_header(); ?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">Operating Hours</h1>
      <div class="page-banner__intro">
        <p>Manage Operating Hours</p>
      </div>
    </div>  
  </div>

  <div class="container container--narrow page-section">

    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo site_url('monty'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to Main Manu</a> <span class="metabox__main">Operating Hours</span></p>
    </div>
	
	<div class="container">
	<nav class="codrops-demos">
					<a href="<?php echo site_url('new-hours'); ?>">New Operating Hours</a>
	<nav>
	<br>	
	</div>	
    	<table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; background-color:#E1E1E1" width="100%">
 		<?php
		echo '<tr bgcolor="#CCCCCC" style="font-weight:bold"><td>Business Hours</td><td align="center">Mon</td><td align="center">Tue</td><td align="center">Wed</td><td align="center">Thu</td><td align="center">Fri</td><td align="center">Sat</td><td align="center">Sun</td><td align="center">Public</td><td>Options</td></tr>';
	   

		$ProvincePosts = new WP_Query(array(
			'posts_per_page' => -1,
			'post_type' => 'operating_hours',
			'orderby' => 'title',
			'order' => 'ASC'
		));

		
        while($ProvincePosts->have_posts()){
		$ProvincePosts->the_post(); 
		
				$hours_ID = get_the_ID();
		
				$Mon = get_field('monday_open');
				$Tue = get_field('tuesday_open');
				$Wed = get_field('wednesday_open');
				$Thu = get_field('thursday_open');
				$Fri = get_field('friday_open');
				$Sat = get_field('saturday_open');
				$Sun = get_field('sunday_open');
				$public_h = get_field('public_holiday_open');
				$Mon_Close = get_field('monday_close');
				$Tue_Close = get_field('tuesday_close');
				$Wed_Close = get_field('wednesday_close');
				$Thu_Close = get_field('thursday_close');
				$Fri_Close = get_field('friday_close');
				$Sat_Close = get_field('saturday_close');		
				$Sun_Close = get_field('sunday_close');
				$public_h_close = get_field('public_holiday_close');
				
				$_Mon = $Mon.'-'.$Mon_Close;
				$_Tue = $Tue.'-'.$Tue_Close;
				$_Wed = $Wed.'-'.$Wed_Close;
				$_Thu = $Thu.'-'.$Thu_Close;
				$_Fri = $Fri.'-'.$Fri_Close;
				$_Sat = $Sat.'-'.$Sat_Close;
				$_Sun = $Sun.'-'.$Sun_Close;
				$_public_h = $public_h.'-'.$public_h_close;
		
		$counter+=1;
		
		if($colour_select==1){
				$selected_colour="FFFFCC";
				$colour_select=2;
				}else{
				$selected_colour="FFFFFF";
				$colour_select=1;
				}
		
		?>
		
             		<tr bgcolor="<?php echo $selected_colour ?>">
					<td align="Left"><?php echo the_title(); ?></td> 
					<td align="center"><?php echo $_Mon; ?></td> 
					<td align="center"><?php echo $_Tue ?></td> 
					<td align="center"><?php echo $_Wed ?></td> 
					<td align="center"><?php echo $_Thu ?></td> 
					<td align="center"><?php echo $_Fri ?></td> 
					<td align="center"><?php echo $_Sat ?></td> 
					<td align="center"><?php echo $_Sun ?></td> 
					<td align="center"><?php echo $_public_h ?></td> 
					<td align="center"><a href="<?php echo site_url('edit_hours/?ID=' . $hours_ID); ?>">Edit</a></td>					
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


  </div>
  
<?php get_footer(); ?>  