<?php 
 if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }
$plan_service_id= $_GET['ID'];
$plan_id= $_GET['PlanId'];
$Client_Id= $_GET['Client_Id'];

get_header(); 

//Plan Fields
	$plan_args = array(
	'p'         => $plan_id, // ID of a page, post, or custom type
	'post_type' => 'plan'
	);
	$PlanPosts = new WP_Query($plan_args);
	 while($PlanPosts->have_posts()){
		$PlanPosts->the_post(); 
		
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
		
			$main_member=get_field('member_benefit');
			$spouse=get_field('spouse_benefit');
			$child14_21_25=get_field('child_14-21_benefit');
			$child6_13=get_field('child_6-13_benefit');
			$child1_5=get_field('child_1-5_benefit');
			$child0_11Mnts=get_field('child_0-11months_benefit');
			$stillborn=get_field('stillborn_benefit');
			$parent=get_field('parent_benefit');
			$band1=get_field('band1');
			$band2=get_field('band2');
			$band3=get_field('band3');
			$band4=get_field('band4');
			$optional_cost=get_field('optional_cost');
			$RelatedService=get_field('related_service');
			
			foreach($RelatedService as $Service){
				$Service_title = get_the_title($Service);
			}


	 }
//End Plan_Service Fields
?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php echo $plan_name; ?></h1>
      <div class="page-banner__intro">
        <p><?php echo $Service_title; ?></p>
      </div>
    </div>  
  </div>
<script>
 function do_cancel(){
	 if(confirm('Are you sure you want to cancel?'))
		 window.location.replace(`<?php echo site_url('list-optional-tariffs/?ID=' . $Client_Id . '&PlanId=' . $plan_id); ?>`);
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
      <p><a class="metabox__blog-home-link" href="<?php echo site_url('list-optional-tariffs/?ID=' . $Client_Id . '&PlanId=' . $plan_id); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to Optional Services</a> <span class="metabox__main">Tariffs</span></p>
    </div>
	
<form id="theForm" name="theForm" action="<?php echo site_url('save-edit-tariff'); ?>" method="post">
<table width="100%" cellspacing="0" cellpadding="5">
  <tr>
    <td width="91%"><span class="new_role">Edit Optionals Tariffs for <?php echo $business_name?>, <?php echo $plan_name?> Plan</span></td>
    <td width="9%">&nbsp;</td>
  </tr>
  <tr>
   <td align="right" ><span  onclick="lets_submit()" class="edit-note"><i class="fa fa-pencil" aria-hidden="true"></i> Save</span></td>
      <td><input type="submit" name="submit" value="Save" id="submit"/>    </td>
    <td><span onClick="do_cancel()" class="delete-note"> Cancel</span></td>
  </tr>
</table>
</br>
<table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td colspan="2" class="_headings"><?php echo $service_name?></td>
  </tr>
   
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Service Cost</td>
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="optional_cost" id="optional_cost" value="<?php echo $optional_cost?>" /></td>
  </tr>

</table>


<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr bgcolor="#D8EBED">
    <td width="4%">&nbsp;</td>
    <td colspan="9"><span class="_fields">Tariff / Charge: Options - Amount or Enquire at branch</span></td>
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
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="main_member" id="main_member" value="<?php echo $main_member?>" /></td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Spouse</td>
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="spouse" id="spouse" value="<?php echo $spouse?>"/></td>
	 <td width="80%">
	 <input type="hidden" name="plan_service_id" id="plan_service_id" value="<?php echo $plan_service_id?>"/>
	 <input type="hidden" name="Client_Id" id="Client_Id" value="<?php echo $Client_Id?>"/>
	 <input type="hidden" name="plan_id" id="plan_id" value="<?php echo $plan_id; ?>"/>
	 </td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Child 14-21/25</td>
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="child14_21_25" id="child14_21_25" value="<?php echo $child14_21_25?>"/></td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Child 6-13</td>
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="child6_13" id="child6_13" value="<?php echo $child6_13?>"/></td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Child 1-5</td>
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="child1_5" id="child1_5" value="<?php echo $child1_5?>"/></td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Child 0-11Months</td>
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="child0_11Mnts" id="child0_11Mnts" value="<?php echo $child0_11Mnts?>"/></td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Stillborn</td>
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="stillborn" id="stillborn" value="<?php echo $stillborn?>"/></td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Parent</td>
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="parent" id="parent" value="<?php echo $parent?>"/></td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Age: <?php echo $age_min1?>-<?php echo $age_max1?></td>
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="band1" id="band1" value="<?php echo $band1?>"/></td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Age: <?php echo $age_min2?>-<?php echo $age_max2?></td>
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="band2" id="band2" value="<?php echo $band2?>"/></td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Age: <?php echo $age_min3?>-<?php echo $age_max3?></td>
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="band3" id="band3" value="<?php echo $band3?>"/></td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Age: <?php echo $age_min4?>-<?php echo $age_max4?></td>
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="band4" id="band4" value="<?php echo $band4?>"/></td>
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