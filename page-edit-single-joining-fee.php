<?php 
 if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }
//$plan_service_id= $_GET['ID'];
$PremiumId= $_GET['PremiumId'];
$plan_id= $_GET['ID'];
$client_id= $_GET['client_id'];

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
		
			$joining_fee=get_field('joining_fee');
			
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
      <h1 class="page-banner__title">Joining Fee</h1>
      <div class="page-banner__intro">
        <p><?php echo $Age_title; ?> years</p>
      </div>
    </div>  
  </div>
<script>
 function do_cancel(){
	 if(confirm('Are you sure you want to cancel?'))
		 window.location.replace(`<?php echo site_url('list-joining-fee/?ID=' . $client_id . '&PlanId=' . $plan_id); ?>`);
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
      <p><a class="metabox__blog-home-link" href="<?php echo site_url('list-joining-fee/?ID=' . $client_id . '&PlanId=' . $plan_id); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to Joining Fees</a> <span class="metabox__main">Joining Fee</span></p>
    </div>
	
<form id="theForm" name="theForm" action="<?php echo site_url('save-edit-single-joining-fee'); ?>" method="post">
<table width="100%" cellspacing="0" cellpadding="5">
  <tr>
    <td width="91%"><span class="new_role">Edit Joining Fees for <?php echo $business_name?>, <?php echo $Age_title; ?> Years</span></td>
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
    <td colspan="9"><span class="_fields">Joining Fees</span></td>
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
    <td width="16%" class="_fields">Amount</td>
    <td width="80%"><input type="text" name="joining_fee" id="joining_fee" value="<?php echo $joining_fee?>"/></td>
	 <td width="80%"><input type="hidden" name="PremiumId" id="PremiumId" value="<?php echo $PremiumId?>"/></td>
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