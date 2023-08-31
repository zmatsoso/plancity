<?php 
  if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }

get_header(); 

  while(have_posts()) {
    the_post();

?>
  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">Manage Service</h1>
      <div class="page-banner__intro">
        <p><?php the_title(); ?></p>
      </div>
    </div>  
  </div>
<script type="text/javascript">
function lets_submit()
{
document.getElementById('submit').click();
}

 function do_cancel(){
	 if(confirm('Are you sure you want to cancel?'))
		 window.location.replace(`<?php echo site_url('services'); ?>`);
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
   <?php 
   
   ?>
    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo site_url('services'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to All Services</a> <span class="metabox__main">Services</span></p>
    </div>
	
<form id="theForm" name="theForm" action="<?php echo site_url('save-service'); ?>" method="post">
<table width="100%" cellspacing="0" cellpadding="5">
  <tr>
    <td width="91%"><span class="new_role">Create New Service</span></td>
    <td width="9%">&nbsp;</td>
  </tr>
  <tr>
   <td align="right"><span id="Save_Province" onclick="lets_submit()" class="edit-note"><i class="fa fa-pencil" aria-hidden="true"></i> Save</span></td>
    <td class="_cancel_btn"><span id="Cancel_Province" onClick="do_cancel()" class="delete-note"> Cancel</span></td>
  </tr>
</table>
</br>
<table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td colspan="2" class="_headings">New Service</td>
  </tr>
  <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Service Name</td>
    <td width="80%"><input type="text" name="service_name" id="service_name" required /></td>
  </tr>
    <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Description</td>
    <td width="80%"><input type="text" name="Description" id="Description" required /></td>
  </tr>
  <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Options</td>
    <td width="80%"><input type="text" name="Options" id="Options" required /></td>
  </tr>
 
<td><input type="submit" name="submit" value="Save" id="submit"/>    </td>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
  
<?php 

  }

get_footer(); ?>  