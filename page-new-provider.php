<?php 
 if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }
$client_id= $_GET['ID'];
$business_name= $_GET['ClientName'];

get_header(); ?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">New Provider</h1>
      <div class="page-banner__intro">
        <p><?php echo $business_name ?></p>
      </div>
    </div>  
  </div>
<script>
 function do_cancel(){
	 if(confirm('Are you sure you want to cancel?'))
		 window.location.replace(`<?php echo site_url('providers/?ID=' . $client_id . '&ClientName=' . $business_name); ?>`);
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
		if(address_city=="Select Area"){
		alert("Please select area and try again!");		
		}else{
		prof_next_p();
		}
	}}}}}}
	
	function prof_next_p(){
	
	bus_name=document.getElementById("bus_name").value;
	var business_name=document.getElementById('business_name').value;
	var short_name=document.getElementById('short_name').value;

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

	address_state=document.getElementById("select_province").value;
	select_province=document.getElementById("select_province").value;
	time_code=document.getElementById("time_code").value;
	bus_type=document.getElementById("bus_type").value;
		var url = `<?php echo site_url('save-provider/?bus_name=')?>`
		+ bus_name
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
		+ '&short_name='
		+ short_name

	
	window.open(url, '_self');
}

function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }


	function get_related_areas() {
		var select_province = document.getElementById("select_province").value;
			
		var strURL=`<?php echo site_url('get-areas/?ID='); ?>`+ select_province;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {	
						document.getElementById('select_area2').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}

	function get_coo_long() {
//	document.getElementById("Pros_Write").innerHTML = "<span style='color: red;'><strong>**Processing... Please Wait**<strong/></span>";	
		var select_area = document.getElementById("select_area").value;
		var strURL=`<?php echo site_url('get-long/?ID='); ?>`+select_area;
		
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('select_long').innerHTML=req.responseText;	
						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
			
	}

	function get_coo_lat() {
//	document.getElementById("Pros_Write").innerHTML = "<span style='color: red;'><strong>**Processing... Please Wait**<strong/></span>";	
		var select_area = document.getElementById("select_area").value;
		var strURL=`<?php echo site_url('get-lat/?ID='); ?>`+select_area;
		
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('select_lat').innerHTML=req.responseText;	
						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
			
	}

</script>

  <div class="container container--narrow page-section">

    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo site_url('providers/?ID=' . $client_id . '&ClientName=' . $business_name); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to Provider List</a> <span class="metabox__main">New Provider</span></p>
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
		<input name="short_name" type="hidden" id="short_name" value="<?php echo $short_name; ?>" required/>

    <td nowrap="nowrap">
	  <select name="bus_type" id="bus_type">
        <option value="Admin" <?php if (!(strcmp("Admin", $type))) {echo "selected=\"selected\"";} ?>>Admin</option>
        <option value="Parlour" <?php if (!(strcmp("Parlour", $type))) {echo "selected=\"selected\"";} ?>>Parlour</option>
        <option value="Admin and Parlour" <?php if (!(strcmp("Admin_Parlour", $type))) {echo "selected=\"selected\"";} ?>>Admin and Parlour</option>
      </select>

	</td>
    <td>&nbsp;</td>
  </tr>

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
	  
	  	 <input name="bus_name" type="hidden" id="bus_name" value="<?php echo $client_id; ?>" />
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
	<div id="select_long">
	</div>
	</td>
 
<label for="tel_extention"></label>
      <label for="department"></label>      <label for="phone_work"></label></td>
	     <td align="right" class="_all_text">Lat-</td>
    <td><input name="lat" type="text" id="lat" value="<?php echo $lat; ?>" required/>
	   	<div id="select_lat">
	</div>


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
	
	      <select name="select_province" id="select_province" onchange="get_related_areas()" required>
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
	<div id="select_area2">
	</div>
	
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
  
<?php get_footer(); ?>  