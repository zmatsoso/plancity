<?php 
  if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }
$client_id= $_GET['ID'];
$plan_id= $_GET['PlanId'];
$Service_Type='Included';
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
	
?>
  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">Services on Plan</h1>
      <div class="page-banner__intro">
        <p><?php echo $plan_name ?></p>
      </div>
    </div>  
  </div>
<script>
 function do_cancel(){
	 if(confirm('Are you sure you want to cancel?'))
		 window.location.replace(`<?php echo site_url('list-included-services/?ID=' . $client_id . '&ClientName=' . $ClientName); ?>`);
 }	 

function lets_submit()
{
document.getElementById('submit').click();
}

var from_array = new Array(
<?php
		$Plan_Services_Posts = new WP_Query(array(
			'post_type' => 'plan_service',
			'posts_per_page' => -1,
			'meta_query' => array(
			'relation'      => 'AND',
				array(
				'key' => 'related_plan',
				'compare' => 'LIKE',
				'value' => $plan_id  //get_current_user_id()
				),
				array(
				'key' => 'service_type',
				'compare' => 'LIKE',
				'value' => $Service_Type
				)
			)
		));
		
			while($Plan_Services_Posts->have_posts()){
			$Plan_Services_Posts->the_post(); 
			
			$Related_Services = get_field('related_service');
			
			foreach($Related_Services as $Service){
						$Service_title = get_the_title($Service);
						$Service_ID = $Service->ID;
			}
			


			?>
                  
                '<?php echo $Service_title?>',  

					
			<?php } ?>	
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
      <p><a class="metabox__blog-home-link" href="<?php echo site_url('plans/?ID=' . $client_id . '&ClientName=' . $ClientName); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to All Plans</a> <span class="metabox__main">Services On <?php echo $plan_name ?></span></p>
    </div>
	<form id="theForm" name="theForm" action="<?php echo site_url('save-included-service-on-plan'); ?>" method="post">
<table width="100%" cellspacing="0" cellpadding="5">
  <tr>
    <td width="91%"></td>
    <td width="9%">&nbsp;</td>
  </tr>
  <tr>
  <td>&nbsp;</td>
    <td><span id="Cancel_Province" onClick="do_cancel()" class="delete-note"> Cancel</span></td>
</td>
  </tr>
</table>
</br>

<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr bgcolor="#D8EBED">
    <td width="4%">&nbsp;</td>
    <td colspan="9"><span class="_fields">Services on <?php echo $plan_name?></span></td>
	<td width="80%">
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
    <td colspan="2" class="_profavailable">Services on <?php echo $plan_name?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><span class="_profavailable">Services to remove from <?php echo $plan_name?></span></td>
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
	 <td align="right"><span onclick="lets_submit()" class="submit-note"> Remove</span></td>
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