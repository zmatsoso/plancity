<?php 
 if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }
$client_id= $_GET['ID'];

get_header(); 



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
      <h1 class="page-banner__title">New Plan</h1>
      <div class="page-banner__intro">
        <p><?php echo $_GET['ClientName']; ?></p>
      </div>
    </div>  
  </div>
<script>
 function do_cancel(){
	 if(confirm('Are you sure you want to cancel?'))
		 window.location.replace(`<?php echo site_url('list-plans/?ID=' . $client_id . '&ClientName=' . $ClientName); ?>`);
 }	 
 
  	function integrity(){
		plan_name=document.getElementById("plan_name").value;
		if(plan_name==""){
			alert("Please supply plan name and try again!");
		}else{
		age_limit_main=document.getElementById("age_limit_main").value;
		if(age_limit_main==""){	
			alert("Please supply member age limit and try again!");
		}else{
		select_product=document.getElementById("select_product").value;
		if(select_product==""){
		alert("Please Product and try again!");	
		}else{
		lets_submit();
		}
	}}}

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


//---------------------------Start Services---------------------------------------------------------------------

var services_from_array = new Array(
<?php
	
	$ServicePosts = new WP_Query(array(
			'posts_per_page' => -1,
			'post_type' => 'service',
			'orderby' => 'title',
			'order' => 'ASC'
			));
			while($ServicePosts->have_posts()){
			$ServicePosts->the_post(); 
			$Service = get_the_title();
			?>
                  
                '<?php echo $Service; ?>',  

					
			<?php } ?>
);  // this array has the values for the source list

var services_to_array = new Array(); 		  // this array has the values for the destination list(if any)

function services_moveoutid()
{
	var sda = document.getElementById('xxxx');;
	var len = sda.length;
	var sda1 = document.getElementById('yyyy');
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
			var sel =  document.getElementById('yyyy');  
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


function services_moveinid()
{
	var sda = document.getElementById('xxxx');
	var sda1 = document.getElementById('yyyy');
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

//---------------------------End Services---------------------------------------------------------------------

//---------------------------Start Branches---------------------------------------------------------------------
var from_array = new Array(<?php
	
		$ProviderPosts = new WP_Query(array(
			'posts_per_page' => -1,
			'post_type' => 'provider',
			'orderby' => 'title',
			'order' => 'ASC',
			'meta_query' => array(
				array(
				'key' => 'related_client',
				'compare' => 'LIKE',
				'value' => '"' . $client_id . '"' //get_current_user_id()
				)
			)

			));
			while($ProviderPosts->have_posts()){
			$ProviderPosts->the_post(); 
			$Related_area = get_field('related_area');
			
			foreach($Related_area as $Area){
				$Area_title = get_the_title($Area);
			}

			$Provider_Address = get_field('phys_addr1');
			?>
                  
                '<?php echo $Area_title?> ~ <?php echo $Provider_Address; ?>',  

					
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
//---------------------------End Branches---------------------------------------------------------------------

</script>

  <div class="container container--narrow page-section">

    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo site_url('list-plans/?ID=' . $client_id . '&ClientName=' . $ClientName); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to All Plans</a> <span class="metabox__main">New Plan</span></p>
    </div>
	
  <form id="theForm" name="theForm" action="<?php echo site_url('save-plan'); ?>" method="post">
<table width="100%" cellspacing="0" cellpadding="5">
   <tr>
   <td align="right"><span id="Save_Province" onclick="integrity()" class="edit-note"><i class="fa fa-pencil" aria-hidden="true"></i> Save</span></td>
    <td class="_cancel_btn"><span id="Cancel_Province" onClick="do_cancel()" class="delete-note"><i class="fa fa-trash-o" aria-hidden="true"></i> Cancel</span></td>
  </tr>
</table>
</br>
<table width="100%" border="0" cellspacing="2" cellpadding="2">
 
  <tr>
    <td>&nbsp;</td>
    <td><span class="_fields">Select Product</span></td>
    <td>
	
	<select name="select_product" id="select_product">
    <option>Select Product</option> <?php
		$ProductsPosts = new WP_Query(array(
			'posts_per_page' => -1,
			'post_type' => 'product',
			'orderby' => 'title',
			'order' => 'ASC'
			));
	    while($ProductsPosts->have_posts()){
		$ProductsPosts->the_post(); 
	?>
	<option value="<?php echo get_the_ID(); ?>"><?php echo the_title(); ?></option>
	<?php } ;?>
	</select>
	
	</td>
	
  </tr>
  <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Plan Name</td>
    <td width="80%">
	
	<input type="text" name="plan_name" id="plan_name" required />
	<input type="hidden" name="client_id" id="client_id" value="<?php echo $client_id; ?>" />
	
	</td>
  </tr>

  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   </tr>

</table>


<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr bgcolor="#D8EBED">
    <td width="4%">&nbsp;</td>
    <td colspan="9"><span class="_fields"> Age Bands for Dependants / Extended family members under this plan</span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="21%">&nbsp;</td>
    <td width="2%">&nbsp;</td>
    <td width="5%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
   </tr>
  <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Age Band 1</td>
    <td width="80%">
	<span class="_fields">From: </span><input type="text" autocomplete="off" autocorrect="off" name="age_min1" id="age_min1" />
	<span class="_fields">To: </span> <input type="text" autocomplete="off" autocorrect="off" name="age_max1" id="age_max1" />
	</td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Age Band 2 </td>
    <td width="80%">
	<span class="_fields">From: </span><input type="text" autocomplete="off" autocorrect="off" name="age_min2" id="age_min2" />
	<span class="_fields">To: </span><input type="text" autocomplete="off" autocorrect="off" name="age_max2" id="age_max2" />
	</td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Age Band 3</td>
    <td width="80%">
	<span class="_fields">From: </span><input type="text" autocomplete="off" autocorrect="off" name="age_min3" id="age_min3" />
	<span class="_fields">To: </span><input type="text" autocomplete="off" autocorrect="off" name="age_max3" id="age_max3" />
	</td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Age Band 4</td>
    <td width="80%">
	<span class="_fields">From: </span><input type="text" autocomplete="off" autocorrect="off" name="age_min4" id="age_min4" />
	<span class="_fields">To: </span><input type="text" autocomplete="off" autocorrect="off" name="age_max4" id="age_max4" />
	</td>
  </tr>

  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   </tr>
 </table>
 

<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr bgcolor="#D8EBED">
    <td width="4%">&nbsp;</td>
    <td colspan="9"><span class="_fields"> Limits (No of persons) under this plan</span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="21%">&nbsp;</td>
    <td width="2%">&nbsp;</td>
    <td width="5%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
   </tr>
  <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_all_text">Member +</td>
    <td width="80%"></td>
  </tr>
  <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Spouse</td>
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="no_limit_spouse" id="no_limit_spouse" /></td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Children</td>
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="no_limit_children" id="no_limit_children" /></td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Parents</td>
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="no_limit_parents" id="no_limit_parents"/></td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Age Band 1</td>
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="no_limit_1" id="no_limit_1"/></td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Age Band 2</td>
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="no_limit_2" id="no_limit_2"/></td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Age Band 3</td>
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="no_limit_3" id="no_limit_3"/></td>
  </tr>
   <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Age Band 4</td>
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="no_limit_4" id="no_limit_4"/></td>
  </tr>

  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   </tr>
 </table>


<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr bgcolor="#D8EBED">
    <td width="4%">&nbsp;</td>
    <td colspan="9"><span class="_fields">Age Limits under this plan</span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="21%">&nbsp;</td>
    <td width="2%">&nbsp;</td>
    <td width="5%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
   </tr>
 <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Member</td>
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="age_limit_main" id="age_limit_main" required /></td>
  </tr>
  <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Spouse</td>
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="age_limit_spouse" id="age_limit_spouse" /></td>
  </tr>
    <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Parents</td>
    <td width="80%"><input type="text" autocomplete="off" autocorrect="off" name="age_limit_parents" id="age_limit_parents"/></td>
  </tr>

  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
 </table>

<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr bgcolor="#D8EBED">
    <td width="4%">&nbsp;</td>
    <td colspan="9"><span class="_fields">Additional Plan Information</span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="21%">&nbsp;</td>
    <td width="2%">&nbsp;</td>
    <td width="5%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
   </tr>
 <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%" class="_fields">Other info</td>
    <td width="80%">
	<textarea  name="additional_info" id="additional_info"></textarea>
	</td>
  </tr>
 
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
 </table>

<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr bgcolor="#D8EBED">
    <td width="4%">&nbsp;</td>
    <td colspan="9"><span class="_fields">Services</span></td>
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
    <td colspan="2" class="_profavailable">Services Available</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><span class="_profavailable">Assigned Services</span></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td rowspan="5" bgcolor="#FFFFCC"><select name="xxxx" size=7  multiple id=xxxx style="width:100%;">
      <script type="text/javascript">
for(var i=0;i<services_from_array.length;i++)
{
	document.write('<option>'+services_from_array[i]+'</option>');
	
}
    </script>
    </select></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td rowspan="5" bgcolor="#FFFFCC"><select name="yyyy[]" size="7" multiple="multiple" id="yyyy" style="width:100%;">
      <script type="text/javascript">
for(var j=0;j<to_array.length;j++)
{
	document.write('<option>'+to_array[j]+'</option>');
}
    </script>
    </select></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center"><input type=button value="&gt;" onclick=services_moveoutid() /></td>
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
    <td align="center"><input type=button value="&lt;" onclick=services_moveinid() /></td>
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





<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr bgcolor="#D8EBED">
    <td width="4%">&nbsp;</td>
    <td colspan="9"><span class="_fields">Branches</span></td>
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
    <td colspan="2" class="_profavailable">Branches Available</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><span class="_profavailable">Assigned Branches</span></td>
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
    <td><input type="submit" name="submit" value="Save" id="submit"/>    </td>
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
  
<?php get_footer(); ?>  