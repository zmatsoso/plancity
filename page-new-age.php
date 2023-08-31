<?php 
 if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }

get_header(); ?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">New Age</h1>
      <div class="page-banner__intro">
        <p>Create New Age</p>
      </div>
    </div>  
  </div>
<script>
 function do_cancel(){
	 if(confirm('Are you sure you want to cancel?'))
		 window.location.replace(`<?php echo site_url('agess'); ?>`);
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
      <p><a class="metabox__blog-home-link" href="<?php echo site_url('agess'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to Age List</a> <span class="metabox__main">New Age</span></p>
    </div>
	
  <form id="theForm" name="theForm" action="<?php echo site_url('save-age'); ?>" method="post">
<table width="100%" cellspacing="0" cellpadding="5">
   <tr>
   <td align="right"><span  onclick="lets_submit()" class="edit-note"><i class="fa fa-pencil" aria-hidden="true"></i> Save</span></td>
    <td class="_cancel_btn"><span onClick="do_cancel()" class="delete-note"><i class="fa fa-trash-o" aria-hidden="true"></i> Cancel</span></td>
  </tr>
</table>
</br>
<table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Age</td>
    <td width="80%"><input type="text" name="age" id="age" required/></td>
  </tr>
<td><input type="submit" name="submit" value="Save" id="submit"/>    </td>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
  
  
  </div>
  
<?php get_footer(); ?>  