<?php 
 if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }
$Provider_Id= $_GET['ID'];
$business_name= $_GET['ClientName'];
$client_id= $_GET['client_id'];
	$hold_args = array(
	'p'         => $Provider_Id, // ID of a page, post, or custom type
	'post_type' => 'provider'
	);
	$PlanPosts = new WP_Query($hold_args);
	 while($PlanPosts->have_posts()){
		$PlanPosts->the_post(); 
		$supplier_active= get_field('provider_active'); 
		$supplier_active_bit= get_field('provider_active'); 
		$bus_type= get_field('provider_type'); 
		$phone_home = get_field('tel_no_1');
		$phone_mobile= get_field('telephone_2'); 
		$phone_work= get_field('telephone_3'); 
		$phone_other= get_field('fax_number'); 
		$Email_Address= get_field('provider_email'); 
		$address_street= get_field('phys_addr1'); 
		$language= get_field('provider_longitude'); 
		$lat= get_field('provider_latitude'); 
		$related_province = get_field('related_province');
			

			$related_area = get_field('related_area');
			
			foreach($related_area as $Area){
						$Old_Area= $Area->ID;
			}

	 }
get_header();

 ?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">Edit Provider</h1>
      <div class="page-banner__intro">
        <p><?php echo $business_name ?></p>
      </div>
    </div>  
  </div>

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
 function make_disable(){
	 
	 		var supplier_active_bit = document.getElementById("supplier_active_bit").value;
			//alert("Welcome");
			if(supplier_active_bit==1){
			document.getElementById("supplier_active").checked = true;
			}
			if(supplier_active_bit==0){
			document.getElementById("supplier_active").checked = false;
			}

 }
 function do_cancel(){
	 if(confirm('Are you sure you want to cancel?'))
		 window.location.replace(`<?php echo site_url('providers/?ID=' . $client_id . '&ClientName=' . $business_name); ?>`);
 }	 

	function integrity(){
		address_street=document.getElementById("address_street").value;
		if(address_street==""){
			alert("Please supply address and try again!");
		}else{
		language=document.getElementById("language").value;
		if(language==""){	
			alert("Please supply GPS longitude and try again!");
		}else{
		lat=document.getElementById("lat").value;
		if(lat==""){	
		alert("Please supply GPS latitude and try again!");	
		}else{
		phone_home=document.getElementById("phone_home").value;
		if(phone_home==""){	
		alert("Please supply atleast 1 contact number and try again!");	
		}else{
		select_province=document.getElementById("select_province").value;
		if(select_province==""){
		alert("Please select province and try again!");	
		}else{	
		address_city=document.getElementById("select_area").value;
		if(address_city==""){
		alert("Please select area and try again!");		
		}else{
		prof_next_p();
		}
	}}}}}}
	
	
	function prof_next_p(){
	Provider_Id=document.getElementById("Provider_Id").value;
	var business_name=document.getElementById('business_name').value;

	if(document.getElementById("supplier_active").checked == true){
		supplier_active=1;
	}else{
		
		supplier_active=0;
	}
	Contact_Person=document.getElementById("Contact_Person").value;
	phone_home=document.getElementById("phone_home").value;
	phone_mobile=document.getElementById("phone_mobile").value;
	phone_work=document.getElementById("phone_work").value;
	phone_other=document.getElementById("phone_other").value;
	Email_Address=document.getElementById("Email_Address").value;
	language=document.getElementById("language").value;
	lat=document.getElementById("lat").value;
	address_street=document.getElementById("address_street").value;
	address_city=document.getElementById("select_area").value;
	Old_Province=document.getElementById("Old_Province").value;
	Old_Area=document.getElementById("Old_Area").value;
	client_id=document.getElementById("client_id").value;
	address_state=document.getElementById("select_province").value;
	select_province=document.getElementById("select_province").value;
	time_code=document.getElementById("time_code").value;
	bus_type=document.getElementById("bus_type").value;
		var url = `<?php echo site_url('save-edit-provider/?Provider_Id=')?>`
		+ Provider_Id
		+ '&phone_home='
		+ phone_home
		+ '&business_name='
		+ business_name
		+ '&phone_mobile='
		+ phone_mobile
		+ '&phone_work='
		+ phone_work
		+ '&phone_other='
		+ phone_other
		+ '&language='
		+ language
		+ '&lat='
		+ lat
		+ '&address_street='
		+ address_street
		+ '&address_city='
		+ address_city
		+ '&address_state='
		+ address_state
		+ '&select_province='
		+ select_province
		+ '&time_code='
		+ time_code
		+ '&Contact_Person='
		+ Contact_Person
		+ '&Email_Address='
		+ Email_Address
		+ '&bus_type='
		+ bus_type
		+ '&Old_Province='
		+ Old_Province
		+ '&supplier_active='
		+ supplier_active
		+ '&client_id='
		+ client_id

	
	window.open(url, '_self'); 
}
</script>

  <div class="container container--narrow page-section">

    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo site_url('providers/?ID=' . $client_id . '&ClientName=' . $business_name); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to Provider List</a> <span class="metabox__main">Edit Provider</span></p>
    </div>
	
  <form id="theForm" name="theForm" action="<?php echo site_url('save-provider'); ?>" method="post">
  
  
  
<table width="100%" cellspacing="0" cellpadding="5">
   <tr>
   <td align="right"><span id="Save_Province" onClick="integrity()" class="edit-note"><i class="fa fa-pencil" aria-hidden="true"></i> Save</span></td>
    <td class="_cancel_btn"><span id="Cancel_Province" onClick="do_cancel()" class="delete-note"><i class="fa fa-trash-o" aria-hidden="true"></i> Cancel</span></td>
  </tr>
  
</table>
</br>
<table width="100%" border="0" cellspacing="0" cellpadding="2">
 <tr>
    <td width="4%">&nbsp;</td>
    <td colspan="2" class="_fields"><span class="_headings"><?php echo $step; ?></span></td>
  </tr>
 <tr>
    <td width="4%">&nbsp;</td>
    <td colspan="2" class="_fields">&nbsp;</td>
  </tr>

 <tr bgcolor="#D8EBED">
    <td width="4%">&nbsp;</td>
    <td colspan="9"><span class="_fields">Business Selection</span></td>
  </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td>&nbsp;</td>
    <td align="right" nowrap="nowrap" class="_all_text">Business Type</td>
	<input name="business_name" type="hidden" id="business_name" value="<?php echo $business_name; ?>" required/>
		<input name="client_id" type="hidden" id="client_id" value="<?php echo $client_id; ?>" required/>

    <td nowrap="nowrap">
	  <select name="bus_type" id="bus_type">
        <option value="Admin Only" <?php if (!(strcmp("Admin", $type))) {echo "selected=\"selected\"";} ?>>Admin Only</option>
        <option value="Parlour Only" <?php if (!(strcmp("Parlour", $type))) {echo "selected=\"selected\"";} ?>>Parlour Only</option>
        <option value="Admin and Parlour" <?php if (!(strcmp("Admin_Parlour", $type))) {echo "selected=\"selected\"";} ?>>Admin and Parlour </option>
      </select>

	</td>
    <td>&nbsp;</td>
  </tr>
 <tr>
    <td width="4%">&nbsp;</td>
    <td colspan="2" class="_fields"><span class="_headings">Status (Branch active?)<input type="checkbox" name="supplier_active" id="supplier_active" /></span></td>
  </tr>
 <tr>

   <td>&nbsp;</td>
    <td align="right" nowrap="nowrap" class="_all_text">&nbsp;</td>
    <td nowrap="nowrap"><label for="tel_extention"></label></td>
    <td align="right" class="_all_text">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="2">
 <tr bgcolor="#D8EBED">
    <td width="4%">&nbsp;</td>
    <td colspan="9"><span class="_fields">Contact Information</span></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td width="4%">&nbsp;</td>
    <td width="17%" align="right" class="_all_text"> Contact Person</td>
    <td width="28%" nowrap="nowrap"><label for="address_city"></label>
      <input name="Contact_Person" type="text" id="Contact_Person" value="<?php echo $Contact_Person; ?>" />
	  
	  	 <input name="Provider_Id" type="hidden" id="Provider_Id" value="<?php echo $Provider_Id; ?>" />
		  <input name="Old_Province" type="hidden" id="Old_Province" value="<?php echo $Old_Province; ?>" />
		   <input name="Old_Area" type="hidden" id="Old_Area" value="<?php echo $Old_Area; ?>" />
		   <input name="supplier_active_bit" type="hidden" id="supplier_active_bit" value="<?php echo $supplier_active_bit; ?>" />
</td>
     <td width="17%">&nbsp;</td>
  </tr>

  <tr>
    <td width="4%">&nbsp;</td>
    <td width="17%" align="right" class="_all_text"> Telephone 1</td>
    <td width="28%" nowrap="nowrap"><label for="address_city"></label>
      <input name="phone_home" type="text" id="phone_home" value="<?php echo $phone_home; ?>" /></td>
     <td width="17%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right" nowrap="nowrap" class="_all_text">Telephone 2</td>
    <td nowrap="nowrap"><label for="tel_extention"></label>
      <input name="phone_mobile" type="text" id="phone_mobile" value="<?php echo $phone_mobile; ?>" />
<label for="department"></label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right" nowrap="nowrap" class="_all_text">Telephone 3</td>
    <td nowrap="nowrap"><label for="phone_work"></label>
      <input name="phone_work" type="text" id="phone_work" value="<?php echo $phone_work; ?>" /></td>
    <td align="right" class="_all_text">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right" nowrap="nowrap" class="_all_text">Fax No</td>
    <td nowrap="nowrap"><label for="address_city"></label>
      <input name="phone_other" type="text" id="phone_other" value="<?php echo $phone_other; ?>" /></td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td align="right" nowrap="nowrap" class="_all_text">Email</td>
    <td nowrap="nowrap"><label for="address_city"></label>
      <input name="Email_Address" type="text" id="Email_Address" value="<?php echo $Email_Address; ?>" /></td>
  </tr>

  <tr>
    <td>&nbsp;</td>
    <td align="right" nowrap="nowrap" class="_all_text">&nbsp;</td>
    <td nowrap="nowrap"><label for="tel_extention"></label></td>
    <td align="right" class="_all_text">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="2">
 <tr bgcolor="#D8EBED">
    <td width="4%">&nbsp;</td>
    <td colspan="9"><span class="_fields">Address Information</span></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td width="4%">&nbsp;</td>
    <td width="17%" align="right" class="_all_text"> Street Address</td>
    <td width="28%" rowspan="3" nowrap="nowrap"><label for="address_city"></label>
      <label for="address_street"></label>
      <textarea name="address_street" id="address_street" cols="30" rows="5"><?php echo $address_street; ?></textarea>
	     <td width="17%" align="right" class="_all_text">Long+</td>
    <td width="17%"><input name="language" type="text" id="language" value="<?php echo $language; ?>" required/>
	<select name="select_long" id="select_long" onchange="get_coo_lat()"></select>
	</td>
 
<label for="tel_extention"></label>
      <label for="department"></label>      <label for="phone_work"></label></td>
	     <td align="right" class="_all_text">Lat-</td>
    <td><input name="lat" type="text" id="lat" value="<?php echo $lat; ?>" required/>
	     <select name="select_lat" id="select_lat"></select>

	</td>

    <td width="17%" align="right" class="_all_text">&nbsp;</td>
    <td width="17%">&nbsp;</td>
    <td width="17%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right" nowrap="nowrap" class="_all_text">&nbsp;</td>
    <td align="right" class="_all_text">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right" nowrap="nowrap" class="_all_text">&nbsp;</td>
    <td align="right" class="_all_text">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right" nowrap="nowrap" class="_all_text">Postalcode</td>
    <td nowrap="nowrap"><label for="tel_extention"></label>
      <label for="address_state1"></label>
      <input name="address_postalcode" type="text" id="address_postalcode" value="<?php echo $address_postalcode; ?>" /></td>
    <td align="right" class="_all_text">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right" nowrap="nowrap" class="_all_text">Province</td>
    <td nowrap="nowrap">
	
	      <select name="select_province" id="select_province" onchange="getareas()" required>
		  <option value="">Select Province</option>
 <?php 
 
 		$provincePosts = new WP_Query(array(
			'posts_per_page' => -1,
			'post_type' => 'province',
			'orderby' => 'title',
			'order' => 'ASC'
		));

 
        while($provincePosts->have_posts()){
		$provincePosts->the_post(); 
?>
<option value="<?php echo get_the_ID(); ?>"><?php echo get_the_title(); ?></option>
<?php } ;?>
  
</select>

  
	  </td>
    <td align="right" class="_all_text">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td align="right" nowrap="nowrap" class="_all_text">Town/City</td>
    <td nowrap="nowrap">
	
	<select name="select_area" id="select_area" onchange="get_coo_long(this.value)">
    <option value="">Select Area</option>
	
	<?php

		$AreaPosts = new WP_Query(array(
			'posts_per_page' => -1,
			'post_type' => 'area',
			'orderby' => 'title',
			'order' => 'ASC',
			

		));
	
	
	    while($AreaPosts->have_posts()){
		$AreaPosts->the_post(); 
?>


<option value="<?php echo get_the_ID(); ?>"><?php echo the_title(); ?></option>
<?php } ;?>
</select>
	

	</td>
    <td align="right" class="_all_text">&nbsp;</td>
    <td><label for="time_zone"></label></td>
    <td>&nbsp;</td>
  </tr>

  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right" class="_all_text">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="2">
 <tr bgcolor="#D8EBED">
    <td width="4%">&nbsp;</td>
    <td colspan="9"><span class="_fields">Operating Hours</span></td>
  </tr>
    <tr>
    <td width="4%">&nbsp;</td>
    <td width="17%" align="right" class="_all_text">Business Hours</td>
    <td width="28%" nowrap="nowrap">
	
      <select name="time_code" id="time_code" required>
 <?php 
 
 		$HoursPosts = new WP_Query(array(
			'posts_per_page' => -1,
			'post_type' => 'operating_hours',
			'orderby' => 'title',
			'order' => 'ASC'
		));

 
        while($HoursPosts->have_posts()){
		$HoursPosts->the_post(); 
?>
<option value="<?php echo get_the_ID(); ?>"><?php echo get_the_title(); ?></option>
<?php } ;?>
  
</select>
	  
	  </td>
    <td width="17%">&nbsp;</td>
  </tr>

</table>


<table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; background-color:#E1E1E1" width="100%">
 
 

 
 
	
</table>



<table width="100%" border="0" cellspacing="0" cellpadding="2">
 <tr bgcolor="#D8EBED">
    <td width="4%">&nbsp;</td>
    <td colspan="9"><span class="_fields"></span></td>
  </tr>
</table>

</form>
  
  
  </div>
  
<?php 
echo '<script type="text/javascript">'
, 'make_disable();'
, '</script>';	


get_footer(); ?>  