<?php 
 if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }
$client_id= $_GET['ID'];
$plan_id= $_GET['PlanId'];
get_header(); 

	$hold_args = array(
	'p'         => $plan_id, // ID of a page, post, or custom type
	'post_type' => 'plan'
	);
	$PlanPosts = new WP_Query($hold_args);
	 while($PlanPosts->have_posts()){
		$PlanPosts->the_post(); 
		
		$plan_name = get_the_title();
		$no_limit_spouse = get_field('no_limit_spouse');
		$no_limit_children = get_field('no_limit_children');
		$no_limit_parents = get_field('no_limit_parents');
		$age_limit_member = get_field('age_limit_member');
		$age_limit_spouse = get_field('age_limit_spouse');
		$age_limit_parents = get_field('age_limit_parents');
		$additional_info = get_field('additional_info');
		$plan_active_bit = get_field('plan_active');
		$age_min1 = get_field('age_min1');
		$age_max1 = get_field('age_max1');
		$age_min2 = get_field('age_min2');
		$age_max2 = get_field('age_max2');
		$age_min3 = get_field('age_min3');
		$age_max3 = get_field('age_max3');
		$age_min4 = get_field('age_min4');
		$age_max4 = get_field('age_max4');
		$no_limit1 = get_field('no_limit1');
		$no_limit2 = get_field('no_limit2');
		$no_limit3 = get_field('no_limit3');
		$no_limit4 = get_field('no_limit4');
		
	 }


	$client_args = array(
	'p'         => $client_id, // ID of a page, post, or custom type
	'post_type' => 'client'
	);
	$ClientPosts = new WP_Query($client_args);
	 while($ClientPosts->have_posts()){
		$ClientPosts->the_post(); 
		
		$ClientName = get_the_title();
	 }
 

?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">Edit Plan</h1>
      <div class="page-banner__intro">
        <p><?php echo $plan_name; ?></p>
      </div>
    </div>  
  </div>
<script>
 function make_disable(){
	 
	 		var plan_active_bit = document.getElementById("plan_active_bit").value;
			//alert("Welcome");
			if(plan_active_bit==1){
			document.getElementById("plan_active").checked = true;
			}
			if(plan_active_bit==0){
			document.getElementById("plan_active").checked = false;
			}

 }
 
 function do_cancel(){
	 if(confirm('Are you sure you want to cancel?'))
		 window.location.replace(`<?php echo site_url('list-plans/?ID=' . $client_id . '&ClientName=' . $ClientName); ?>`);
 }	 
 
 
 
 	function integrity(){
		plan_name=document.getElementById("plan_name").value;
		if(plan_name==""){
			alert("Please supply plan name and try again!");
		}else{
		age_limit_main=document.getElementById("age_limit_main").value;
		if(age_limit_main==""){	
			alert("Please supply member age limit and try again!");
		}else{
		select_product=document.getElementById("select_product").value;
		if(select_product==""){
		alert("Please Product province and try again!");	
		}else{	
		select_category=document.getElementById("select_category").value;
		if(select_category==""){
		alert("Please select Category and try again!");		
		}else{
		prof_next_p();
		}
	}}}}
	

	function prof_next_p(){
	plan_id=document.getElementById("plan_id").value;

	if(document.getElementById("plan_active").checked == true){
		plan_active=1;
	}else{
		
		plan_active=0;
	}
	
	var select_category=document.getElementById('select_category').value;
	var select_product=document.getElementById('select_product').value;
	var age_min1=document.getElementById('age_min1').value;
	var age_min2=document.getElementById('age_min2').value;
	var age_min3=document.getElementById('age_min3').value;
	var age_min4=document.getElementById('age_min4').value;
	var age_max1=document.getElementById('age_max1').value;
	var age_max2=document.getElementById('age_max2').value;
	var age_max3=document.getElementById('age_max3').value;
	var age_max4=document.getElementById('age_max4').value;
	var no_limit_spouse=document.getElementById('no_limit_spouse').value;
	var no_limit_children=document.getElementById('no_limit_children').value;
	var no_limit_parents=document.getElementById('no_limit_parents').value;
	var no_limit_1=document.getElementById('no_limit_1').value;
	var no_limit_2=document.getElementById('no_limit_2').value;
	var no_limit_3=document.getElementById('no_limit_3').value;
	var no_limit_4=document.getElementById('no_limit_4').value;
	var age_limit_main=document.getElementById('age_limit_main').value;
	var age_limit_spouse=document.getElementById('age_limit_spouse').value;
	var age_limit_parents=document.getElementById('age_limit_parents').value;
	var additional_info=document.getElementById('additional_info').value;
	var client_id=document.getElementById('client_id').value;
	var plan_name=document.getElementById('plan_name').value;

		var url = `<?php echo site_url('save-edit-plan/?plan_id=')?>`
		+ plan_id
		+ '&plan_active='
		+ plan_active
		+ '&select_category='
		+ select_category
		+ '&select_product='
		+ select_product
		+ '&age_min1='
		+ age_min1
		+ '&age_min2='
		+ age_min2
		+ '&age_min3='
		+ age_min3
		+ '&age_min4='
		+ age_min4
		+ '&age_max1='
		+ age_max1
		+ '&age_max2='
		+ age_max2
		+ '&age_max3='
		+ age_max3
		+ '&age_max4='
		+ age_max4
		+ '&no_limit_spouse='
		+ no_limit_spouse
		+ '&no_limit_children='
		+ no_limit_children
		+ '&no_limit_parents='
		+ no_limit_parents
		+ '&no_limit_1='
		+ no_limit_1
		+ '&no_limit_2='
		+ no_limit_2
		+ '&no_limit_3='
		+ no_limit_3
		+ '&no_limit_4='
		+ no_limit_4
		+ '&age_limit_main='
		+ age_limit_main
		+ '&age_limit_spouse='
		+ age_limit_spouse
		+ '&age_limit_parents='
		+ age_limit_parents
		+ '&additional_info='
		+ additional_info
		+ '&client_id='
		+ client_id
		+ '&plan_name='
		+ plan_name
		
	window.open(url, '_self'); 
	
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

  <div class="container container--narrow page-section">

    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo site_url('list-plans/?ID=' . $client_id . '&ClientName=' . $ClientName); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to All Plans</a> <span class="metabox__main">Edit Plan</span></p>
    </div>
	
  <form id="theForm" name="theForm" action="<?php echo site_url('save-edit-plan'); ?>" method="post">
<table width="100%" cellspacing="0" cellpadding="5">
   <tr>
   <td align="right"><span id="Save_Province" onClick="integrity()" class="edit-note"><i class="fa fa-pencil" aria-hidden="true"></i> Save</span></td>
    <td class="_cancel_btn"><span id="Cancel_Province" onClick="do_cancel()" class="delete-note"><i class="fa fa-trash-o" aria-hidden="true"></i> Cancel</span></td>
  </tr>
</table>
</br>
<table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td>&nbsp;</td>
    <td><span class="_fields">Select Categoty</span></td>
    <td>

	<select name="select_category" id="select_category">
    <?php
		$CategoryPosts = new WP_Query(array(
			'posts_per_page' => -1,
			'post_type' => 'product_cat',
			'orderby' => 'title',
			'order' => 'ASC'
			));
	    while($CategoryPosts->have_posts()){
		$CategoryPosts->the_post(); 
	?>
	<option value="<?php echo get_the_ID(); ?>"><?php echo the_title(); ?></option>
	<?php } ;?>
	</select>

	</td>
  </tr>
 
  <tr>
    <td>&nbsp;</td>
    <td><span class="_fields">Select Product</span></td>
    <td>
	
	<select name="select_product" id="select_product">
    <?php
		$CategoryPosts = new WP_Query(array(
			'posts_per_page' => -1,
			'post_type' => 'product',
			'orderby' => 'title',
			'order' => 'ASC'
			));
	    while($CategoryPosts->have_posts()){
		$CategoryPosts->the_post(); 
	?>
	<option value="<?php echo get_the_ID(); ?>"><?php echo the_title(); ?></option>
	<?php } ;?>
	</select>
	
	</td>
	
  </tr>
  <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Plan Name</td>
    <td width="80%">
	
	<input type="text" name="plan_name" id="plan_name" value="<?php echo $plan_name; ?>" />
	<input type="hidden" name="client_id" id="client_id" value="<?php echo $client_id; ?>" />
	<input type="hidden" name="plan_id" id="plan_id" value="<?php echo $plan_id; ?>" />
	<input type="hidden" name="plan_active_bit" id="plan_active_bit" value="<?php echo $plan_active_bit; ?>" />
	<input type="submit" name="submit" value="Save" id="submit"/> 
	
	</td>
  </tr>

  <tr>
    <td>&nbsp;</td>
	 <td align="right" class="_all_text">Status (Plan active?)</td>
    <td> <input type="checkbox" name="plan_active" id="plan_active" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   </tr>

</table>


<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr bgcolor="#D8EBED">
    <td width="4%">&nbsp;</td>
    <td colspan="9"><span class="_fields"> Age Bands for Dependants / Extended family members under this plan</span></td>
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
    <td width="16%" class="_fields">Age Band 1</td>
    <td width="80%">
	<span class="_fields">From: </span><input type="text" autocomplete="off" autocorrect="off" name="age_min1" id="age_min1"  value="<?php echo $age_min1; ?>" />
	<span class="_fields">To: </span> <input type="text" autocomplete="off" autocorrect="off" name="age_max1" id="age_max1" value="<?php echo $age_max1; ?>"  />
	</td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Age Band 2 </td>
    <td width="80%">
	<span class="_fields">From: </span><input type="text" autocomplete="off" autocorrect="off" name="age_min2" id="age_min2"  value="<?php echo $age_min2; ?>" />
	<span class="_fields">To: </span><input type="text" autocomplete="off" autocorrect="off" name="age_max2" id="age_max2"  value="<?php echo $age_max2; ?>" />
	</td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Age Band 3</td>
    <td width="80%">
	<span class="_fields">From: </span><input type="text" autocomplete="off" autocorrect="off" name="age_min3" id="age_min3"  value="<?php echo $age_min3; ?>" />
	<span class="_fields">To: </span><input type="text" autocomplete="off" autocorrect="off" name="age_max3" id="age_max3"  value="<?php echo $age_max3; ?>" />
	</td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Age Band 4</td>
    <td width="80%">
	<span class="_fields">From: </span><input type="text" autocomplete="off" autocorrect="off" name="age_min4" id="age_min4"  value="<?php echo $age_min4; ?>" />
	<span class="_fields">To: </span><input type="text" autocomplete="off" autocorrect="off" name="age_max4" id="age_max4"  value="<?php echo $age_max4; ?>" />
	</td>
  </tr>

  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   </tr>
 </table>
 

<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr bgcolor="#D8EBED">
    <td width="4%">&nbsp;</td>
    <td colspan="9"><span class="_fields"> Limits (No of persons) under this plan</span></td>
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
    <td width="16%" class="_all_text">Member +</td>
    <td width="80%"></td>
  </tr>
  <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Spouse</td>
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="no_limit_spouse" id="no_limit_spouse"  value="<?php echo $no_limit_spouse; ?>" /></td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Children</td>
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="no_limit_children" id="no_limit_children"  value="<?php echo $no_limit_children; ?>" /></td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Parents</td>
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="no_limit_parents" id="no_limit_parents" value="<?php echo $no_limit_parents; ?>" /></td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Age Band 1</td>
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="no_limit_1" id="no_limit_1" value="<?php echo $no_limit1; ?>" /></td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Age Band 2</td>
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="no_limit_2" id="no_limit_2" value="<?php echo $no_limit2; ?>" /></td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Age Band 3</td>
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="no_limit_3" id="no_limit_3" value="<?php echo $no_limit3; ?>" /></td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Age Band 4</td>
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="no_limit_4" id="no_limit_4" value="<?php echo $no_limit4; ?>" /></td>
  </tr>

  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   </tr>
 </table>


<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr bgcolor="#D8EBED">
    <td width="4%">&nbsp;</td>
    <td colspan="9"><span class="_fields">Age Limits under this plan</span></td>
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
    <td width="16%" class="_fields">Member</td>
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="age_limit_main" id="age_limit_main"  value="<?php echo $age_limit_member; ?>" /></td>
  </tr>
  <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Spouse</td>
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="age_limit_spouse" id="age_limit_spouse"  value="<?php echo $age_limit_spouse; ?>" /></td>
  </tr>
    <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Parents</td>
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="age_limit_parents" id="age_limit_parents" value="<?php echo $age_limit_parents; ?>" /></td>
  </tr>

  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
 </table>

<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr bgcolor="#D8EBED">
    <td width="4%">&nbsp;</td>
    <td colspan="9"><span class="_fields">Additional Plan Information</span></td>
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
    <td width="16%" class="_fields">Other info</td>
    <td width="80%">
	<textarea  name="additional_info" id="additional_info"><?php echo $additional_info; ?></textarea>
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
  
<?php 
echo '<script type="text/javascript">'
, 'make_disable();'
, '</script>';	


get_footer(); ?>  