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

//Clear Hold Plan
$args = array( 'posts_per_page' => -1, 'post_type' => 'hold_plans', );
$allposts= get_posts( $args );
foreach ( $allposts as $post ) :
    wp_delete_post( $post->ID, true );
endforeach;  
//End Clear Hold Plan

//Get Providers
$ProviderPosts = new WP_Query(array(
			'posts_per_page' => -1,
			'post_type' => 'provider',
			'meta_query' => array(
				array(
				'key' => 'related_client',
				'compare' => 'LIKE',
				'value' => $client_id //get_current_user_id()
				)
			)

			));
			while($ProviderPosts->have_posts()){
			$ProviderPosts->the_post(); 
			$Provider_ID = get_the_ID();
				
			//Insert Hold Plan
			$inserted_hold_plan = wp_insert_post([
			'post_type' => 'hold_plans',
			'post_status' => 'Publish'
			]);
   
			$fillable = [
			'field_5df4dc2e288f3' => $plan_id,
			'field_5dcc05a8708d5' => $Provider_ID				
			];
   
			foreach ($fillable as $key => $no_branches){
			update_field($key, $no_branches, $inserted_hold_plan );
			}   
			//End Insert Hold Plan
		 }	
//End Get Providers		


wp_reset_postdata();

//Get from Provider Products
		$Provider_Products_Posts = new WP_Query(array(
			'post_type' => 'provider_product',
			'posts_per_page' => -1,
			'meta_query' => array(
				array(
				'key' => 'related_plan',
				'compare' => 'LIKE',
				'value' => $plan_id  //get_current_user_id()
				)
			)
		));
		
			
			while($Provider_Products_Posts->have_posts()){
			$Provider_Products_Posts->the_post(); 
			
			$Prov_ID = get_the_ID();
			$Related_Provider = get_field('related_provider');
			
			foreach($Related_Provider as $Provider){
						$Provider_ID2 = $Provider->ID;
			}
			
			//start deleting from hold plan
			$Hold_Plan_Posts = new WP_Query(array(
			'post_type' => 'hold_plans',
			'posts_per_page' => -1,
			'meta_query' => array(
			'relation'      => 'AND',
				array(
				'key' => 'plan_id',
				'compare' => 'LIKE',
				'value' => $plan_id  //get_current_user_id()
				),
		//		array(
		//		'key' => 'provider_id',
		//		'compare' => 'LIKE',
		//		'value' => $Provider_ID2  //get_current_user_id()
		//		)
			)
		));
		
			while($Hold_Plan_Posts->have_posts()){
			$Hold_Plan_Posts->the_post(); 
			
			$hold_plan_id = get_the_ID($Hold_Plan_Posts);
			
		//	wp_delete_post($hold_plan_id, false);
			 }
			//end start deliting from hold plan
				
			}


//End Get from Provider Products	
	
?>
  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">Branches not on Plan</h1>
      <div class="page-banner__intro">
        <p><?php echo $plan_name ?></p>
      </div>
    </div>  
  </div>
  <?php
  print_r($Prov_ID);
  ?>
<script>
 function do_cancel(){
	 if(confirm('Are you sure you want to cancel?'))
		 window.location.replace(`<?php echo site_url('plans/?ID=' . $client_id . '&ClientName=' . $ClientName); ?>`);
 }	 

function lets_submit()
{
document.getElementById('submit').click();
}

var from_array = new Array(
<?php

		$View_Hold_plan = new WP_Query(array(
			'post_type' => 'hold_plans',
			'posts_per_page' => -1,
		));
		
			while($View_Hold_plan->have_posts()){
			$View_Hold_plan->the_post(); 
			
			$Hold_Provider_Id = get_field('provider_id');
//Now serach from prodider		

	$hold_args = array(
	'p'         => $Hold_Provider_Id, // ID of a page, post, or custom type
	'post_type' => 'provider'
	);
  
	$ProvPosts = new WP_Query($hold_args);
	 while($ProvPosts->have_posts()){
		$ProvPosts->the_post(); 
		
		$Provider_title = get_the_title();
		$Provider_Address = get_field('phys_addr1');
		$Area_ID = get_field('phys_addr2');
		
			$Area_args = array(
			'p'         => $Area_ID, // ID of a page, post, or custom type
			'post_type' => 'area'
			);
			$AreaPosts = new WP_Query($Area_args);
			while($AreaPosts->have_posts()){
			$AreaPosts->the_post(); 
		
			$Provider_Area = get_the_title();
			}



?>
                  
                '<?php echo $Provider_Area?> ~ <?php echo $Provider_Address; ?>',   

					
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
      <p><a class="metabox__blog-home-link" href="<?php echo site_url('plans/?ID=' . $client_id . '&ClientName=' . $ClientName); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to All Plans</a> <span class="metabox__main">Branches Not On <?php echo $plan_name ?></span></p>
    </div>
	<form id="theForm" name="theForm" action="<?php echo site_url('save-branch-not-on-plan'); ?>" method="post">
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
    <td colspan="9"><span class="_fields">Branches not on <?php echo $plan_name?></span></td>
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
    <td colspan="2" class="_profavailable">Branches not on <?php echo $plan_name?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><span class="_profavailable">Branches to add to <?php echo $plan_name?></span></td>
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