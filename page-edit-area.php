<?php 
 if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }
$Area_Id= $_GET['ID'];

	$hold_args = array(
	'p'         => $Area_Id, // ID of a page, post, or custom type
	'post_type' => 'area'
	);
	$AreaPosts = new WP_Query($hold_args);
	 while($AreaPosts->have_posts()){
		$AreaPosts->the_post(); 

		$area_name = get_the_title();
		$latitude = get_field('area_latitude');
		$longitude = get_field('area_longitude');
	 }
wp_reset_postdata();
get_header(); ?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">Edit Area</h1>
      <div class="page-banner__intro">
        <p><?php echo $area_name ?></p>
      </div>
    </div>  
  </div>
<script>
 function do_cancel(){
	 if(confirm('Are you sure you want to cancel?'))
		 window.location.replace(`<?php echo site_url('areas'); ?>`);
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
      <p><a class="metabox__blog-home-link" href="<?php echo site_url('areas'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to Area List</a> <span class="metabox__main">New area</span></p>
    </div>
	
  <form id="theForm" name="theForm" action="<?php echo site_url('save-edit-area'); ?>" method="post">
<table width="100%" cellspacing="0" cellpadding="5">
   <tr>
   <td align="right"><span id="Save_Province" onclick="lets_submit()" class="edit-note"><i class="fa fa-pencil" aria-hidden="true"></i> Save</span></td>
    <td class="_cancel_btn"><span id="Cancel_Province" onClick="do_cancel()" class="delete-note"><i class="fa fa-trash-o" aria-hidden="true"></i> Cancel</span></td>
  </tr>
</table>
</br>
<table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td>&nbsp;</td>
    <td><span class="_fields">Select Province</span></td>
    <td>

	<select name="select_province" id="select_province">
    <?php
		$ProvincePosts = new WP_Query(array(
			'posts_per_page' => -1,
			'post_type' => 'province',
			'orderby' => 'title',
			'order' => 'ASC'
			));
	    while($ProvincePosts->have_posts()){
		$ProvincePosts->the_post(); 
	?>
	<option value="<?php echo get_the_ID(); ?>"><?php echo the_title(); ?></option>
	<?php } ;?>
	</select>

	</td>
  </tr>

  <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Area Name</td>
    <td width="80%"><input type="text" name="area_name" id="area_name" value="<?php echo $area_name ?>" required/>
	<input type="hidden" name="Area_Id" id="Area_Id" value="<?php echo $Area_Id ?>"/>
	</td>
  </tr>
  <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Latitude</td>
    <td width="80%"><input type="text" name="latitude" id="latitude" value="<?php echo $latitude ?>" required/></td>
  </tr>
  <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Longitude</td>
    <td width="80%"><input type="text" name="longitude" id="longitude" value="<?php echo $longitude ?>" required/></td>
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