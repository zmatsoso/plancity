<?php 
 if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }
$current_user = wp_get_current_user();
$User_Website = $current_user->user_url;
$User_Name = $current_user->user_firstname;


 //Get Provider ID
function Get_Client_ID($key, $value) {
        global $wpdb;
	$meta = $wpdb->get_results("SELECT * FROM ".$wpdb->postmeta." WHERE meta_key='".$wpdb->escape($key)."' AND meta_value='".esc_sql($value)."'");
 
	if (is_array($meta) && !empty($meta) && isset($meta[0])) {
		$meta = $meta[0];
	}
	if (is_object($meta)) {
		return $meta->post_id;
	}else {
			return false;
		}
}

$Client_id = Get_Client_ID('client_website',$User_Website);

get_header(); ?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php echo $User_Name; ?></h1>
      <div class="page-banner__intro">
        <p>Manage Branches and Plans.</p>
      </div>
    </div>  
  </div>

  <div class="container container--narrow page-section">

    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo site_url('monty'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to Main Manu</a> <span class="metabox__main">Clients</span></p>
    </div>
	
	   	<table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; background-color:#E1E1E1" width="100%">
 		<?php
		echo '<tr bgcolor="#CCCCCC" style="font-weight:bold"><td>Business Name</td><td align="centre">FSP Number</td><td align="centre">Status</td><td align="centre">Branches</td><td align="centre">Plans</td></tr>';

	$client_args = array(
	'p'         => $Client_id, // ID of a page, post, or custom type
	'post_type' => 'client'
	);
	$ClientPosts = new WP_Query($client_args);
	 while($ClientPosts->have_posts()){
		$ClientPosts->the_post(); 
		
		$ClientName = get_the_title();
	 
		
		if($colour_select==1){
				$selected_colour="FFFFCC";
				$colour_select=2;
				}else{
				$selected_colour="FFFFFF";
				$colour_select=1;
				}
		$client_active= get_field('client_active');
				if($client_active==1){
					$active="Active";
					$counter+=1;
					$counter_active+=1;
				}else{
					$active="InActive";
					$counter_inactive+=1;
				}
		
		?>
		
		          	<tr bgcolor="<?php echo $selected_colour ?>">
					<td align="left"><?php the_title(); ?></td>
					<td align="centre"><?php the_field('fsp_number'); ?></td>
                    <td align="centre"><?php echo $active; ?></td>                   
					<td align="centre"><a href="<?php echo site_url('providers/?ID=' . $client_id . '&ClientName=' . $ClientName ); ?>">Branches</a>
					<td align="centre"><a href="<?php echo site_url('list-plans/?ID=' . $client_id . '&ClientName=' . $ClientName); ?>">Plans</a>
                 </td>
                  
                    </td>

				
		<?php }	?>
		        </table>
		<table>
		  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
</table>
    
 
  </div>
  
<?php get_footer(); ?>  