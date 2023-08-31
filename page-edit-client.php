<?php 
 if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }
$client_id= $_GET['ID'];
$business_name= $_GET['ClientName'];

	$hold_args = array(
	'p'         => $client_id, // ID of a page, post, or custom type
	'post_type' => 'client'
	);
	$ClientPosts = new WP_Query($hold_args);
	 while($ClientPosts->have_posts()){
		$ClientPosts->the_post(); 

	$client_active_bit= get_field('client_active'); 

	 }
get_header();

?>
  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">Edit Client Status</h1>
      <div class="page-banner__intro">
        <p><?php echo $business_name ?></p>
      </div>
    </div>  
  </div>

<script>
 function make_disable(){
	 
	 		var client_active_bit = document.getElementById("client_active_bit").value;
			//alert("Welcome");
			if(client_active_bit==1){
			document.getElementById("client_active").checked = true;
			}
			if(client_active_bit==0){
			document.getElementById("client_active").checked = false;
			}

 }
 
 

function prof_next_p(){


	if(document.getElementById("client_active").checked){
	client_active=1;		
	}else{
	client_active=0;	
	}

	client_id=document.getElementById("client_id").value;

		var url = `<?php echo site_url('save-edit-client/?client_id=')?>`
		+ client_id
		+ '&client_active='
		+ client_active

	
	window.open(url, '_self');

	
	
}

function do_cancel(){
if(confirm('Are you sure you want to cancel?'))
		 window.location.replace(`<?php echo site_url('clients/?ID=' . $client_id . '&ClientName=' . $business_name); ?>`);
}
</script>


<form id="theForm" name="theForm" action="#" method="post">
<table width="100%" cellspacing="0" cellpadding="5">
  <tr>
    <td width="91%"></td>
    <td width="9%">&nbsp;</td>
  </tr>
  <tr>
  <td align="right"><span id="Save_Province" onClick="prof_next_p()" class="edit-note"><i class="fa fa-pencil" aria-hidden="true"></i> Save</span></td>
    <td class="_cancel_btn"><span id="Cancel_Province" onClick="do_cancel()" class="delete-note"><i class="fa fa-trash-o" aria-hidden="true"></i> Cancel</span></td>
  </tr>
</table>
</br>
<table width="100%" border="0" cellspacing="0" cellpadding="2">
 <tr>
    <td width="4%">&nbsp;</td>
    <td colspan="2" class="_fields"><span class="_headings">Client details will be modified</span></td>
  </tr>
 <tr>
    <td width="4%">&nbsp;</td>
    <td colspan="2" class="_fields">&nbsp;</td>
  </tr>

 <tr bgcolor="#D8EBED">
    <td width="4%">&nbsp;</td>
    <td colspan="9"><span class="_fields">Client Status</span></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
      <td align="right" class="_all_text">Status (Client active?)</td>

    <td>&nbsp;</td>
    <td><label for="client_active"></label>
      <input type="checkbox" name="client_active" id="client_active" />
	  <input name="client_id" type="hidden" id="client_id" value="<?php echo $client_id; ?>" required/>
	  <input name="client_active_bit" type="hidden" id="client_active_bit" value="<?php echo $client_active_bit; ?>" required/>
<label for="role"></label></td>
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





</form>

<?php 
echo '<script type="text/javascript">'
, 'make_disable();'
, '</script>';	


get_footer(); ?>  