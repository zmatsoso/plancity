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

	//Clear Hold Service
	$args = array( 'posts_per_page' => -1, 'post_type' => 'hold_service', );
	$allposts= get_posts( $args );
	foreach ( $allposts as $post ) :
    wp_delete_post( $post->ID, true );
	endforeach;  
	//End Clear Hold Service

//Get Services
$Add_Members = 'Additional Members';
	$hold_args = array(
	'name'         => $Add_Members, // ID of a page, post, or custom type
	'post_type' => 'service'
	);

$ServicePosts = new WP_Query($hold_args);
			while($ServicePosts->have_posts()){
			$ServicePosts->the_post(); 
			$Service_ID = get_the_ID();
				
			//Insert Hold Service
			$inserted_hold_service = wp_insert_post([
			'post_type' => 'hold_service',
			'post_status' => 'Publish',
			]);
   
			$fillable = [
			'field_5dcd62dc46ce7' => $client_id,	
			'field_5dcd630746ce8' => $Service_ID
			];
   
			foreach ($fillable as $key => $no_branches){
			update_field($key, $no_branches, $inserted_hold_service );
			}   
			//End Insert Hold Service
		 }	
//End Get Services	

wp_reset_postdata();

//Get from Plan Service
		$Plan_Service_Posts = new WP_Query(array(
			'post_type' => 'plan_service',
			'posts_per_page' => -1,
			'meta_query' => array(
				array(
				'key' => 'related_plan',
				'compare' => 'LIKE',
				'value' => $plan_id //get_current_user_id()
				)
			)
		));
		
			while($Plan_Service_Posts->have_posts()){
			$Plan_Service_Posts->the_post(); 
			
			$Related_Service = get_field('related_service');
			
			foreach($Related_Service as $Service){
						$Service_ID2 = $Service->ID;
			}
			
			//start deleting from hold plan
			$Hold_Service_Posts = new WP_Query(array(
			'post_type' => 'hold_service',
			'posts_per_page' => -1,
			'meta_query' => array(
			'relation'      => 'AND',
				array(
				'key' => 'client_id',
				'compare' => 'LIKE',
				'value' => $client_id  //get_current_user_id()
				),
				array(
				'key' => 'service_id',
				'compare' => 'LIKE',
				'value' => $Service_ID2  //get_current_user_id()
				)
			)
		));
		
			while($Hold_Service_Posts->have_posts()){
			$Hold_Service_Posts->the_post(); 
			
			$hold_service_id = get_the_ID($Hold_Service_Posts);
			
			wp_delete_post($hold_service_id, false);
			 }
			//end start deliting from hold plan
				
			}

//End Get from Plan Service
wp_reset_postdata();	
?>
  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">Additional Dependents not on Plan</h1>
      <div class="page-banner__intro">
        <p><?php echo $plan_name ?></p>
      </div>
    </div>  
  </div>
<script>
 function do_cancel(){
	 if(confirm('Are you sure you want to cancel?'))
		 window.location.replace(`<?php echo site_url('list-add-members/?ID=' . $client_id . '&ClientName=' . $ClientName); ?>`);
 }	 

function lets_submit()
{
document.getElementById('submit').click();
}

var from_array = new Array(
<?php

		$View_Hold_service = new WP_Query(array(
			'post_type' => 'hold_service',
			'posts_per_page' => -1,
		));
		
			while($View_Hold_service->have_posts()){
			$View_Hold_service->the_post(); 
			
			$Hold_service_Id = get_field('service_id');
//Now serach from prodider		

	$hold_args = array(
	'p'         => $Hold_service_Id, // ID of a page, post, or custom type
	'post_type' => 'service'
	);
  
	$ProvPosts = new WP_Query($hold_args);
	 while($ProvPosts->have_posts()){
		$ProvPosts->the_post(); 
		
		$Service_title = get_the_title();

?>
                  
                '<?php echo $Service_title?>',   

					
			<?php  
//End Now search from Provider
	 }  }?>	
);  // this array has the values for the source list

var to_array = new Array(); 		  // this array has the values for the destination list(if any)

function moveoutid()
{
	var sda = document.getElementById('xxx');;
	var len = sda.length;
	var sda1 = document.getElementById('yyy');
	for(var j=0; j<len; j++)
	{
		if(sda[j].selected)
		{
			var tmp = sda.options[j].text;
			var tmp1 = sda.options[j].value;
		
	sda.remove(j);
			j--;
			var y=document.createElement('option');
			y.text=tmp;
			
			try
			{sda1.add(y,null);
			var sel =  document.getElementById('yyy');  
for(var i=0; i<sel.options.length; i++){  
  sel.options[i].selected = true;  
}

			}
			catch(ex)
			{
			sda1.add(y);
			}
		}
	}
	
}


function moveinid()
{
	var sda = document.getElementById('xxx');
	var sda1 = document.getElementById('yyy');
	var len = sda1.length;
	for(var j=0; j<len; j++)
	{
		if(sda1[j].selected)
		{
			var tmp = sda1.options[j].text;
			var tmp1 = sda1.options[j].value;
			sda1.remove(j);
			j--;
			var y=document.createElement('option');
			y.text=tmp;
			try
			{
			sda.add(y,null);}
			catch(ex){
			sda.add(y);	
			}

		}
	}	
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
      <p><a class="metabox__blog-home-link" href="<?php echo site_url('plans/?ID=' . $client_id . '&ClientName=' . $ClientName); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to All Plans</a> <span class="metabox__main">Additional Dependents Not On <?php echo $plan_name ?></span></p>
    </div>
	<form id="theForm" name="theForm" action="<?php echo site_url('save-add-members-not-on-plan'); ?>" method="post">
<table width="100%" cellspacing="0" cellpadding="5">
  <tr>
    <td width="91%"></td>
    <td width="9%">&nbsp;</td>
  </tr>
  <tr>
  <td>&nbsp;</td>
    <td><span id="Cancel_Province" onClick="do_cancel()" class="delete-note"> Cancel</span></td>
  </tr>
</table>
</br>

<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr bgcolor="#D8EBED">
    <td width="4%">&nbsp;</td>
    <td colspan="9"><span class="_fields">Additional Dependents not on <?php echo $plan_name?></span></td>
	<td width="90%">
	<input type="hidden" name="plan_id" id="plan_id" value="<?php echo $plan_id?>" />
	<input type="hidden" name="all_or" id="all_or" value="user" />
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="21%">&nbsp;</td>
    <td width="2%">&nbsp;</td>
    <td width="5%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="24%">&nbsp;</td>
    <td width="10%">&nbsp;</td>
    <td width="10%">&nbsp;</td>
    <td width="10%">&nbsp;</td>
    <td width="10%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2" class="_profavailable">Additional Dependents not on <?php echo $plan_name?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><span class="_profavailable">Additional Dependents to add to <?php echo $plan_name?></span></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td rowspan="5" bgcolor="#FFFFCC"><select name="xxx" size=7  multiple id=xxx style="width:100%;">
      <script type="text/javascript">
for(var i=0;i<from_array.length;i++)
{
	document.write('<option>'+from_array[i]+'</option>');
}
    </script>
    </select></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td rowspan="5" bgcolor="#FFFFCC"><select name="yyy[]" size="7" multiple="multiple" id="yyy" style="width:100%;">
      <script type="text/javascript">
for(var j=0;j<to_array.length;j++)
{
	document.write('<option>'+to_array[j]+'</option>');
}
    </script>
    </select></td>
	 <td align="right" ><span onclick="lets_submit()" class="submit-note"> Add</span></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center"><input type=button value="&gt;" onclick=moveoutid() /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
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
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center"><input type=button value="&lt;" onclick=moveinid() /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
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
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
	<td><input type="submit" name="submit" value="Save" id="submit"/>    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
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
</form>
	

  </div>
  
<?php 

  

get_footer(); ?>  