<?php 
 if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }

$plan_id= $_GET['PlanId'];
$Service_Type='Additional';

get_header(); 
		$Plan_Services_Posts = new WP_Query(array(
			'post_type' => 'plan_service',
			'posts_per_page' => -1,
			'meta_query' => array(
			'relation'      => 'AND',
				array(
				'key' => 'related_plan',
				'compare' => 'LIKE',
				'value' => $plan_id  //get_current_user_id()
				),
				array(
				'key' => 'service_type',
				'compare' => 'LIKE',
				'value' => $Service_Type
				)
			)
		));
		
			while($Plan_Services_Posts->have_posts()){
			$Plan_Services_Posts->the_post(); 
			
			$plan_service_id = get_the_ID();
			
			
			}

//Plan Fields
	$plan_args = array(
	'p'         => $plan_id, // ID of a page, post, or custom type
	'post_type' => 'plan'
	);
	$PlanPosts = new WP_Query($plan_args);
	 while($PlanPosts->have_posts()){
		$PlanPosts->the_post(); 
		
		$plan_id= $PlanPosts->ID;
		$plan_name= get_the_title();
		$age_min1 = get_field('age_min1');
		$age_min2 = get_field('age_min2');
		$age_min3 = get_field('age_min3');
		$age_min4 = get_field('age_min4');
		$age_max1 = get_field('age_max1');
		$age_max2 = get_field('age_max2');
		$age_max3 = get_field('age_max3');
		$age_max4 = get_field('age_max4');
	 }
//End Plan Fields


//Client Fields


//Client Fields

//Plan_Service Fields
	$plan_service_args = array(
	'p'         => $plan_service_id, // ID of a page, post, or custom type
	'post_type' => 'plan_service'
	);
	$Plan_ServicePosts = new WP_Query($plan_service_args);
	 while($Plan_ServicePosts->have_posts()){
		$Plan_ServicePosts->the_post(); 
		
			$spouse=get_field('cost_per_add_spouse');
			$child14_21_25=get_field('cost_per_add_child14_21_25');
			$child6_13=get_field('cost_per_add_child6_13');
			$child1_5=get_field('cost_per_add_child1_5');
			$child0_11Mnts=get_field('cost_per_add_child0_11mnts');
			$parent=get_field('cost_per_add_parent');
			$band1=get_field('cost_per_add_band1');
			$band2=get_field('cost_per_add_band2');
			$band3=get_field('cost_per_add_band3');
			$band4=get_field('cost_per_add_band4');

			$add_spouse=get_field('add_spouse');
			$add_child14_21_25=get_field('add_child14_21_25');
			$add_child6_13=get_field('add_child6_13');
			$add_child1_5=get_field('add_child1_5');
			$add_child0_11Mnts=get_field('add_child0_11mnts');
			$add_parent=get_field('add_parent');
			$add_band1=get_field('add_band1');
			$add_band2=get_field('add_band2');
			$add_band3=get_field('add_band3');
			$add_band4=get_field('add_band4');

			$add_max_spouse=get_field('add_max_spouse');
			$add_max_child14_21_25=get_field('add_max_child14_21_25');
			$add_max_child6_13=get_field('add_max_child6_13');
			$add_max_child1_5=get_field('add_max_child1_5');
			$add_max_child0_11Mnts=get_field('add_max_child0_11mnts');
			$add_max_parent=get_field('add_max_parent');
			$add_max_band1=get_field('add_max_band1');
			$add_max_band2=get_field('add_max_band2');
			$add_max_band3=get_field('add_max_band3');
			$add_max_band4=get_field('add_max_band4');

	 }
//End Plan_Service Fields
?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">Additional Dependants Costs</h1>
      <div class="page-banner__intro">
        <p><?php echo $plan_name; ?></p>
      </div>
    </div>  
  </div>
<script>
 function do_cancel(){
	 if(confirm('Are you sure you want to cancel?'))
		 window.location.replace(`<?php echo site_url('list-add-members/?ID=' . $client_id . '&PlanId=' . $plan_id); ?>`);
 }	 
</script>
<style>
#submit{visibility:hidden};

._errors {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-weight: bolder;
	color: #F00;
}
</style>
<script type="text/javascript">
function lets_submit()
{
document.getElementById('submit').click();
}
</script>

  <div class="container container--narrow page-section">

    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo site_url('list-optional-tariffs/?ID=' . $client_id . '&PlanId=' . $plan_id); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to Additional Dependents</a> <span class="metabox__main">Additional Dependents Cost</span></p>
    </div>
	
<form id="theForm" name="theForm" action="<?php echo site_url('save-edit-add-members'); ?>" method="post">
<table width="100%" cellspacing="0" cellpadding="5">
  <tr>
    <td width="91%"><span class="new_role">Edit Additional Dependents for <?php echo $business_name?>, <?php echo $plan_name?> Plan</span></td>
    <td width="9%">&nbsp;</td>
  </tr>
  <tr>
   <td align="right" ><span  onclick="lets_submit()" class="edit-note"><i class="fa fa-pencil" aria-hidden="true"></i> Save</span></td>
      <td><input type="submit" name="submit" value="Save" id="submit"/>    </td>
    <td><span onClick="do_cancel()" class="delete-note"> Cancel</span></td>
  </tr>
</table>
</br>


<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr bgcolor="#D8EBED">
    <td width="4%">&nbsp;</td>
    <td colspan="9"><span class="_fields">Taffif / Charge: Options - Amount or Enquire at branch</span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="21%">&nbsp;</td>
    <td width="2%">&nbsp;</td>
    <td width="5%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
   </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Main Member</td>
    <td width="80%">
	<span class="_fields">Amount - Options: R5 - R500 | </span>
	<span class="_fields">How many - Options: 1 - 10 | </span>
	<span class="_fields">Total Maxumum - Options: 1-100 or No Limit</span>
	</td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Spouse</td>
    <td width="80%">
	<input type="text" name="spouse" id="spouse" value="<?php echo $spouse?>"/>
	<input type="text" name="add_spouse" id="add_spouse" value="<?php echo $add_spouse?>"/>
	<input type="text" name="add_max_spouse" id="add_max_spouse" value="<?php echo $add_max_spouse?>"/>
	</td>
	 <td width="80%"><input type="hidden" name="plan_service_id" id="plan_service_id" value="<?php echo $plan_service_id?>"/></td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Child 14-21/25</td>
    <td width="80%">
	<input type="text" name="child14_21_25" id="child14_21_25" value="<?php echo $child14_21_25?>"/>
	<input type="text" name="add_child14_21_25" id="add_child14_21_25" value="<?php echo $add_child14_21_25?>"/>
	<input type="text" name="add_max_child14_21_25" id="add_max_child14_21_25" value="<?php echo $add_max_child14_21_25?>"/>
	</td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Child 6-13</td>
    <td width="80%">
	<input type="text" name="child6_13" id="child6_13" value="<?php echo $child6_13?>"/>
	<input type="text" name="add_child6_13" id="add_child6_13" value="<?php echo $add_child6_13?>"/>
	<input type="text" name="add_max_child6_13" id="add_max_child6_13" value="<?php echo $add_max_child6_13?>"/>
	</td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Child 1-5</td>
    <td width="80%">
	<input type="text" name="child1_5" id="child1_5" value="<?php echo $child1_5?>"/>
	<input type="text" name="add_child1_5" id="add_child1_5" value="<?php echo $add_child1_5?>"/>
	<input type="text" name="add_max_child1_5" id="add_max_child1_5" value="<?php echo $add_max_child1_5?>"/>
	</td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Child 0-11Months</td>
    <td width="80%">
	<input type="text" name="child0_11Mnts" id="child0_11Mnts" value="<?php echo $child0_11Mnts?>"/>
	<input type="text" name="add_child0_11Mnts" id="add_child0_11Mnts" value="<?php echo $add_child0_11Mnts?>"/>
	<input type="text" name="add_max_child0_11Mnts" id="add_max_child0_11Mnts" value="<?php echo $add_max_child0_11Mnts?>"/>
	</td>
  </tr>
    <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Parent</td>
    <td width="80%">
	<input type="text" name="parent" id="parent" value="<?php echo $parent?>"/>
	<input type="text" name="add_parent" id="add_parent" value="<?php echo $add_parent?>"/>
	<input type="text" name="add_max_parent" id="add_max_parent" value="<?php echo $add_max_parent?>"/>
	</td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Age: <?php echo $age_min1?>-<?php echo $age_max1?></td>
    <td width="80%">
	<input type="text" name="band1" id="band1" value="<?php echo $band1?>"/>
	<input type="text" name="add_band1" id="add_band1" value="<?php echo $add_band1?>"/>
	<input type="text" name="add_max_band1" id="add_max_band1" value="<?php echo $add_max_band1?>"/>
	</td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Age: <?php echo $age_min2?>-<?php echo $age_max2?></td>
    <td width="80%">
	<input type="text" name="band2" id="band2" value="<?php echo $band2?>"/>
	<input type="text" name="add_band2" id="add_band2" value="<?php echo $add_band2?>"/>
	<input type="text" name="add_max_band2" id="add_max_band2" value="<?php echo $add_max_band2?>"/>
	</td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Age: <?php echo $age_min3?>-<?php echo $age_max3?></td>
    <td width="80%">
	<input type="text" name="band3" id="band3" value="<?php echo $band3?>"/>
	<input type="text" name="add_band3" id="add_band3" value="<?php echo $add_band3?>"/>
	<input type="text" name="add_max_band3" id="add_max_band3" value="<?php echo $add_max_band3?>"/>
	</td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Age: <?php echo $age_min4?>-<?php echo $age_max4?></td>
    <td width="80%">
	<input type="text" name="band4" id="band4" value="<?php echo $band4?>"/>
	<input type="text" name="add_band4" id="add_band4" value="<?php echo $add_band4?>"/>
	<input type="text" name="add_max_band4" id="add_max_band4" value="<?php echo $add_max_band4?>"/>
	</td>
  </tr>

  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   </tr>
 </table>


</form>
  
  
  </div>
  
<?php get_footer(); ?>  