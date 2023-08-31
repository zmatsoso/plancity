<?php 
 if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }
//$plan_service_id= $_GET['ID'];
$PremiumId= $_GET['PremiumId'];
$client_id= $_GET['client_id'];
$plan_id= $_GET['ID'];

get_header(); 



//Client Fields


//Client Fields

//Plan_Service Fields
	$premium_args = array(
	'p'         => $PremiumId, // ID of a page, post, or custom type
	'post_type' => 'premium'
	);
	
	$Joining_FeePosts = new WP_Query($premium_args);
	 while($Joining_FeePosts->have_posts()){
		$Joining_FeePosts->the_post(); 
		
			$waiting_accidental= get_field('waiting_period_accidental');
			$waiting_natural= get_field('waiting_period_natural');
			$waiting_suicide= get_field('waiting_period_suicide');
			$waiting_lapse_accidental= get_field('waiting_period_accidental_after_lapse');
			$waiting_lapse_natural= get_field('waiting_period_natural_after_lapse');
			$waiting_lapse_suicide= get_field('waiting_period_suicide_after_lapse');
			
			$Related_Age = get_field('related_age');
			
			foreach($Related_Age as $Age){
						$Age_title = get_the_title($Age);
						
			}


	 }
//End Plan_Service Fields
?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">Edit Waiting Periods</h1>
      <div class="page-banner__intro">
        <p><?php echo $Age_title; ?> years</p>
      </div>
    </div>  
  </div>
<script>
 function do_cancel(){
	 if(confirm('Are you sure you want to cancel?'))
		 window.location.replace(`<?php echo site_url('list-waiting-periods/?ID=' . $client_id . '&PlanId=' . $plan_id); ?>`);
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
      <p><a class="metabox__blog-home-link" href="<?php echo site_url('list-waiting-periods/?ID=' . $client_id . '&PlanId=' . $plan_id); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to All Waiting Periods</a> <span class="metabox__main">Waiting Periods</span></p>
    </div>
	
<form id="theForm" name="theForm" action="<?php echo site_url('save-edit-single-waiting'); ?>" method="post">
<table width="100%" cellspacing="0" cellpadding="5">
  <tr>
    <td width="91%"><span class="new_role">Edit Waiting periods for <?php echo $business_name?>, <?php echo $plan_name?> Plan</span></td>
    <td width="9%">&nbsp;</td>
  </tr>
  <tr>
   <td align="right"><span  onclick="lets_submit()" class="edit-note"><i class="fa fa-pencil" aria-hidden="true"></i> Save</span></td>
      <td><input type="submit" name="submit" value="Save" id="submit"/>    </td>
    <td><span onClick="do_cancel()" class="delete-note"> Cancel</span></td>
  </tr>
</table>
</br>
<table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td colspan="2" class="_headings">Age: <?php echo $Age_title?></td>
  </tr>
   
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   </tr>

</table>


<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr bgcolor="#D8EBED">
    <td width="4%">&nbsp;</td>
    <td colspan="9"><span class="_fields">Waiting Periods (In Months)</span></td>
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
    <td width="16%" class="_fields">Accidental</td>
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="waiting_accidental" id="waiting_accidental" value="<?php echo $waiting_accidental?>"/></td>
	 <td width="80%"></td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Natural</td>
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="waiting_natural" id="waiting_natural" value="<?php echo $waiting_natural?>"/></td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Suicide</td>
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="waiting_suicide" id="waiting_suicide" value="<?php echo $waiting_suicide?>"/></td>
  </tr>
    <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Accidental (after lapse)</td>
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="waiting_lapse_accidental" id="waiting_lapse_accidental" value="<?php echo $waiting_lapse_accidental?>"/></td>
	 <td width="80%"><input type="hidden" name="PremiumId" id="PremiumId" value="<?php echo $PremiumId?>"/></td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Natural (after lapse)</td>
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="waiting_lapse_natural" id="waiting_lapse_natural" value="<?php echo $waiting_lapse_natural?>"/></td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Suicide (after lapse)</td>
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="waiting_lapse_suicide" id="waiting_lapse_suicide" value="<?php echo $waiting_lapse_suicide?>"/></td>
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