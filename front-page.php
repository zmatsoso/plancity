<?php get_header(); ?>        
 
<script>
function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }
	

	function getProductTypes() {
		var category = document.getElementById("category").value;
			
		var strURL=`<?php echo site_url('get-product-types/?ID='); ?>`+ category;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {	
						document.getElementById('product_type2').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}
	
	
		function getAreas() {
		var select_province = document.getElementById("select_province").value;
			
		var strURL=`<?php echo site_url('get-areas-main/?ID='); ?>`+ select_province;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {	
						document.getElementById('area_select').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}
      
            SyntaxHighlighter.defaults['toolbar'] = false;
            SyntaxHighlighter.all();
       
</script> 
        <!--================Home Banner Area =================-->
        <section class="home_banner_area">
            <div class="banner_inner d-flex align-items-center">
				<div class="container">
					<div class="banner_content">
					    <h5><font color="White">The simplest way to find</font></h5>
						<h3><font color="White">A Funeral Plan</font></h3>
   
					</div>
				</div>
            </div>
            <div class="container">
				<div id="promo" class="advanced_search">
					<h3>Search Plans for</h3>
					<div class="search_select">
					
						<select class="s_select" name="select_age"  id="select_age">
						<option value="">Select Your Age</option>
						<?php
								$AgesPosts = new WP_Query(array(
								'posts_per_page' => -1,
								'post_type' => 'ages',
								'orderby' => 'title',
								'order' => 'ASC'
								));
								while($AgesPosts->have_posts()){
								$AgesPosts->the_post(); ?>

								<option value="<?php echo get_the_ID(); ?>"><?php echo the_title(); ?> years old</option>
								<?php } ?>
						</select>
						<select class="s_select" name="gender" id="gender" >
							<option value="" selected="selected">Select Gender</option>
							<option value="1" >Male</option>
							<option value="2" >Female</option>
						</select>
						
						<select class="s_select" name="category" id="category" onchange="getProductTypes(this.value)">
							<option>Select Plan Category</option> <?php
							$CategoryPosts = new WP_Query(array(
							'posts_per_page' => -1,
							'post_type' => 'product_cat',
							'orderby' => 'title',
							'order' => 'ASC'
							));
							while($CategoryPosts->have_posts()){
							$CategoryPosts->the_post(); 
							?>
							<option value="<?php echo get_the_ID(); ?>"><?php echo the_title(); ?></option>
							<?php } ;?>
						</select>
						<div id= "product_type2">
						</div>
						<select class="s_select" name="select_province" id="select_province" onchange="getAreas(this.value)">
							<option>Select Your Province</option> 
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
						<div id= "area_select"></div>
						<select class="s_select" name="select_director"  id="select_director">
							<option value="" selected="selected">Any Provider</option>
							<?php
							$ClientsPosts = new WP_Query(array(
							'posts_per_page' => -1,
							'post_type' => 'client',
							'orderby' => 'title',
							'order' => 'ASC'
							));
							while($ClientsPosts->have_posts()){
							$ClientsPosts->the_post(); 
							?>
							<option value="<?php echo get_the_ID(); ?>"><?php echo the_title(); ?></option>
							<?php } ;?>
						</select>
						<input type="checkbox" id="primary_checkbox" >
											<label for="primary-checkbox"><font color="Blue">Senior citezens (65yrs +) only</font></label>
					</div>
					
					<a href="#" id="search_plans" class="btn submit_btn">Search Now</a>
				</div>
            </div>
			
        </section>
        <!--================End Home Banner Area =================-->
    	<div class="container">
		<div align="Center" id="search-overlay__results"></div>	
        </div>
    
        
       <!--================Properties Area =================-->
        <section id="SearchResults" class="properties_area">
        	<div class="container">
        		<div class="main_title">
        			<h2 id="search_results"></h2>
        		</div>
        		<div id="0_client" class="row properties_inner">
        		</div>
        	</div>
        </section>
        <!--================End Properties Area =================-->
         
         
 <section>
 

   <a href="javascript:void(0)" id="href_contacts"></a>
 	<input name="href_contacts_value" type="hidden" id="href_contacts_value" value=""/>
   <a href="javascript:void(0)" id="href_services"></a>
 	<input name="href_services_value"  type="hidden" id="href_services_value" value=""/>
  <a href="javascript:void(0)"  id="href_limits"></a>
 	<input name="href_limits_value" type="hidden" id="href_limits_value" value=""/>
  <a href="javascript:void(0)"  id="href_probation"></a>
 	<input name="href_probation_value" type="hidden" id="href_probation_value" value=""/>
  <a href="javascript:void(0)"  id="href_other"></a>
 	<input name="href_other_value" type="hidden" id="href_other_value" value=""/>
   <a href="javascript:void(0)" id="href_slides"></a>
 	<input name="href_slides_value" type="hidden" id="href_slides_value" value=""/>
   <a href="javascript:void(0)" id="href_branches"></a>
 	<input name="href_branches_value" type="hidden" id="href_branches_value" value=""/>
  <a href="javascript:void(0)" id="href_interested"></a>
 	<input name="href_slides_value" type="hidden" id="href_interested_value" value=""/>

	
  <a href="javascript:void(0)"  id="supply_age"></a>
  <a href="javascript:void(0)"  id="supply_gender"></a>
  <a href="javascript:void(0)"  id="supply_category"></a>
  <a href="javascript:void(0)"  id="supply_plan_type"></a>
  <a href="javascript:void(0)"  id="supply_province"></a>
  <a href="javascript:void(0)"  id="supply_area"></a>

   </section>         

<?php get_footer(); ?>