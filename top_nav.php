<?php 
if (!is_user_logged_in()){
	wp_redirect(esc_url(site_url('/')));
	exit;
}

get_header(); ?>

<style type="text/css">
._user_name {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 18px;
	color: #4c4c4c;
	font-weight: bold;
}
body {
			margin: 0;
			padding: 0;
			overflow: hidden;
			height: 100%; 
			max-height: 100%; 
			font-family:Sans-serif;
			line-height: 1.5em;

	background-color: #FFF;
}
</style>
<table width="100%" cellpadding="2">
  <tr>
    <td width="79%" rowspan="4"><img src="../images/FConnect.jpg" width="790" height="81" /></td>
    <td width="21%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" class="_user_name"><?php echo $_SESSION['user_name']; ?></td>
  </tr>
</table>
