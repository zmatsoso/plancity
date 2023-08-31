<?php 
  if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }
$plan_id= $_GET['plan_id'];
$client_id= $_GET['client_id'];
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



//Get from Provider Products

//End Get from Provider Products	
wp_reset_postdata();	
?>
  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">Edit Waiting Periods</h1>
      <div class="page-banner__intro">
        <p><?php echo $plan_name ?></p>
      </div>
    </div>  
  </div>
<script>
 function do_cancel(){
	 if(confirm('Are you sure you that you are done?'))
		 window.location.replace(`<?php echo site_url('list-waiting-periods/?ID=' . $client_id . '&ClientName=' . $ClientName . '&plan_id=' . $plan_id); ?>`);
 }	 

function lets_submit()
{
document.getElementById('submit').click();
}

var from_array = new Array(
<?php

		$Premium_Posts = new WP_Query(array(
			'post_type' => 'premium',
			'posts_per_page' => -1,
			'order' => 'ASC',
			'orderby' => 'related_age',
			'meta_key' => 'related_age',

			'meta_query' => array(
				array(
				'key' => 'related_plan',
				'compare' => 'LIKE',
				'value' => $plan_id //get_current_user_id()
				)
			)
		));
		
			while($Premium_Posts->have_posts()){
			$Premium_Posts->the_post(); 
			
			$waiting_natural = get_field('waiting_period_natural');
			
			$Related_Age = get_field('related_age');
			
			foreach($Related_Age as $Age){
						$Age_ID2 = $Age->ID;
			}
			
			$hold_args = array(
			'p'         => $Age_ID2, // ID of a page, post, or custom type
			'post_type' => 'ages'
			);
			$AgesPosts = new WP_Query($hold_args);
			while($AgesPosts->have_posts()){
			$AgesPosts->the_post(); 
		
			$Age_ID3 = get_the_title();
			}
				
		
//Now serach from 	

?>
                  
                '<?php echo $Age_ID3?> = <?php echo $waiting_natural ?>',   

					
			<?php  
//End Now search from 
	  }?>	
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
      <p><a class="metabox__blog-home-link" href="<?php echo site_url('list-waiting-periods/?ID=' . $client_id . '&ClientName=' . $ClientName . '&plan_id=' . $plan_id); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to All Waiting Periods</a> <span class="metabox__main">Ages Not On <?php echo $plan_name ?></span></p>
    </div>
<form id="theForm" name="theForm" action="<?php echo site_url('save-waiting-on-plan'); ?>" method="post">
<table width="100%" cellspacing="0" cellpadding="5">
  <tr>
    <td width="91%"><span class="new_role">Waiting periods for <?php echo $business_name?>, <?php echo $plan_name?> Plan</span></td>
    <td width="9%">&nbsp;</td>
  </tr>
  <tr>
  <td>&nbsp;</td>
    <td><span id="Cancel_Province" onClick="do_cancel()" class="delete-note"> Done</span></td>
  </tr>
</table>
</br>

<table width="100%" border="0" cellspacing="0" cellpadding="2">
 
  <tr bgcolor="#D8EBED">
    <td width="4%">&nbsp;</td>
    <td colspan="9"><span class="_fields">Waiting Periods for <?php echo $plan_name?> Plan</span></td>
	<td width="80%">
	<input type="hidden" name="plan_id" id="plan_id" value="<?php echo $plan_id?>" /></td>
	<input type="hidden" name="all_or" id="all_or" value="user" />
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
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Accidental</td>
    <td width="20%"><input type="text" name="waiting_accidental" id="waiting_accidental" /></td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Natural</td>
    <td width="20%"><input type="text" name="waiting_natural" id="waiting_natural"/></td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Suicide</td>
    <td width="20%"><input type="text" name="waiting_suicide" id="waiting_suicide"/></td>
  </tr>
    <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Accidental (after lapse)</td>
    <td width="20%"><input type="text" name="waiting_lapse_accidental" id="waiting_lapse_accidental" /></td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Natural (after lapse)</td>
    <td width="20%"><input type="text" name="waiting_lapse_natural" id="waiting_lapse_natural"/></td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Suicide (after lapse)</td>
    <td width="20%"><input type="text" name="waiting_lapse_suicide" id="waiting_lapse_suicide"/></td>

  <tr>
    <td>&nbsp;</td>
    <td colspan="2" class="_profavailable">Age waiting periods for <?php echo $plan_name?> Plan (showing natural only)</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><span class="_profavailable">Age waiting periods to modify for <?php echo $plan_name?> Plan</span></td>
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
	 <td align="right"><span onclick="lets_submit()" class="submit-note"> Update</span></td>
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