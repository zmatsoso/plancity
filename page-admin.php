<?php 
if (!is_user_logged_in()){
	wp_redirect(esc_url(site_url('/')));
	exit;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
<title>PlanCity</title>
</head>
<frameset rows="1,*" frameborder="0" border="0" framespacing="0">
  <frame name="topNav" src="<?php echo get_theme_file_uri('/top_nav.php') ?>">
<frameset  frameborder="0" border="0" framespacing="0">
	<frame name="content" src="<?php echo get_theme_file_uri('/content') ?>" marginheight="0" marginwidth="0" scrolling="auto" noresize>

<noframes>
<p>This section (everything between the 'noframes' tags) will only be displayed if the users' browser doesn't support frames. You can provide a link to a non-frames version of the website here. Feel free to use HTML tags within this section.</p>
</noframes>

</frameset>
</frameset>

</html>