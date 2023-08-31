<?php
	global $wpdb;
	
	$lat1="";
	$lon1="";
	$lat2="";
	$lon2="";
	$supplier_add="";
	$fk_SupplierGroupID="";
	$age=$_GET['age'];
	$select_area=$_GET['select_area'];
	$product_id=$_GET['product_type'];
	$Senior=$_GET['senior_citizen'];
	$select_director=$_GET['select_supplier'];
	$Test="";
	$Counter="";

		


	
	$main_sql2=mysqli_query($aVar, 'SELECT * FROM local_lookup_areas WHERE ID="'. ($select_area) .'" ');
	while ($row = mysqli_fetch_assoc($main_sql2)) {
	$Posted_Area = $row["Area"];
	$lat2 = $row["Lat"];
	$lon2 = $row["Long"];
	}
	

	
				function distance($lat1, $lon1, $lat2, $lon2, $unit) {
				$lat1 = floatval($lat1);
				$lat2 = floatval($lat2);
				$lon1 = floatval($lon1);
				$lon2 = floatval($lon2);
				$theta = $lon1 - $lon2;
				$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
				$dist = acos($dist);
				$dist = rad2deg($dist);
				$miles = $dist * 60 * 1.1515;
				$unit = strtoupper($unit);

				if ($unit == "K") {
				return ($miles * 1.609344);
				} else if ($unit == "N") {
				return ($miles * 0.8684);
				} else {
				return $miles;
				}
				}

			$result=mysqli_query($aVar, 'SELECT premiums.id, premiums.age, premiums.amount, premiums.joining_fee, plans.id, plans.plan_name, plans.age_limit_main, plans.age_limit_parents, plans.age_limit_1, plans.age_limit_2, plans.age_limit_3, plans.age_limit_4,suppliers.ID, suppliers.Supplier_Name, suppliers.Phys_Addr1, suppliers.Phys_Addr2, suppliers.fk_SupplierGroupID, suppliers.Lat, suppliers.Longi,suppliers.bus_type, local_lookup_areas.Area,  suppliers_products.fk_Product_ID
			FROM (((premiums INNER JOIN plans ON premiums.plan_id = plans.id) INNER JOIN suppliers_products ON plans.id = suppliers_products.fk_plan_id) INNER JOIN suppliers ON suppliers_products.fk_Suppliers_ID = suppliers.ID) INNER JOIN local_lookup_areas ON suppliers.Phys_Addr2 = local_lookup_areas.ID
			WHERE (((premiums.age)="'. $age .'") AND ((suppliers_products.fk_Product_ID)="'.$product_id.'"));');
			while($row=mysqli_fetch_array($result)){

				$premiums_amount=$row['amount'];
				$joining_fee=$row['joining_fee'];
				$plan_name=$row['plan_name'];
				$Area=$row['Area'];
				$Phys_Addr1=$row['Phys_Addr1'];
				$Phys_Addr2=$row['Phys_Addr2'];
				$suppliers_Supplier_Name=$row['Supplier_Name'];
				$fk_SupplierGroupID=$row['fk_SupplierGroupID'];
				$lat1=$row['Lat'];
				$lon1=$row['Longi'];
				if($select_area==$Phys_Addr2){
				$Test2_KM = 0;
				}else{
				$Test_KM = distance($lat1, $lon1, $lat2, $lon2, "K");
				$Test2_KM = round($Test_KM,0);
				}
				$plan_id=$row['id'];
				$age_limit_main=$row['age_limit_main'];
				$age_limit_parents=$row['age_limit_parents'];
				$age_limit_1=$row['age_limit_1'];
				$age_limit_2=$row['age_limit_2'];
				$age_limit_3=$row['age_limit_3'];
				$age_limit_4=$row['age_limit_4'];
				$supplier_id=$row['ID'];
				$supplier_type=$row['bus_type'];
	$main_sql4=mysqli_query($aVar, 'SELECT id FROM premiums WHERE age="'. ($age) .'" AND plan_id="'.$plan_id.'"');
	while ($row = mysqli_fetch_assoc($main_sql4)) {
	$premium_id = $row["id"];
	}
	
		mysqli_query($aVar, "insert into hold_distinct values ('$premium_id','$age', '$premiums_amount', '$joining_fee', '$plan_id', '$plan_name', '$age_limit_main', '$age_limit_parents', '$age_limit_1', '$age_limit_2', '$age_limit_3', '$age_limit_4', '$supplier_id', '$suppliers_Supplier_Name', '$Phys_Addr1', '$Area', '$product_id', '$select_area', '$Test2_KM', '$fk_SupplierGroupID', '$supplier_type')");	
				
}

$distinct_query=mysqli_query($aVar,'SELECT * FROM hold_distinct ORDER BY distance');
			while($row=mysqli_fetch_array($distinct_query)){

				$premium_id=$row['premium_id'];
				$age=$row['age'];
				$premiums_amount=$row['amount'];
				$joining_fee=$row['joining_fee'];
				$plan_id=$row['plan_id'];
				$plan_name=$row['plan_name'];
				$age_limit_main=$row['age_limit_main'];
				$age_limit_parents=$row['age_limit_parents'];
				$age_limit_1=$row['age_limit_1'];
				$age_limit_2=$row['age_limit_2'];
				$age_limit_3=$row['age_limit_3'];
				$age_limit_4=$row['age_limit_4'];
				$supplier_id=$row['supplier_id'];
				$suppliers_Supplier_Name=$row['Supplier_Name'];
				$Phys_Addr1=$row['Phys_Addr1'];
				$Area=$row['Area'];
				$product_id=$row['fk_Product_ID'];
				//$select_area=$row['select_area'];
				$Test2_KM=$row['distance'];
				$fk_SupplierGroupID=$row['fk_SupplierGroupID'];
				$supplier_type=$row['supplier_type'];
				
	
	mysqli_query($aVar, "insert into hold_distinct2 values ('$premium_id','$age', '$premiums_amount', '$joining_fee', '$plan_id', '$plan_name', '$age_limit_main', '$age_limit_parents', '$age_limit_1', '$age_limit_2', '$age_limit_3', '$age_limit_4', '$supplier_id', '$suppliers_Supplier_Name', '$Phys_Addr1', '$Area', '$product_id', '$select_area', '$Test2_KM', '$fk_SupplierGroupID', '$supplier_type')");	
	

}
	mysqli_query($aVar, "DELETE from hold_distinct WHERE (age='$age' AND  fk_Product_ID='$product_id' AND area_id='$select_area')");



	
	
switch(true){
	
	case(($Senior=="true") && ($select_director=="")) :
	$type1="Admin Only";
$type2="Admin and Parlour";

$distinct_query2=mysqli_query($aVar,'SELECT * FROM hold_distinct2 WHERE (((supplier_type="'.$type1.'") OR (supplier_type="'.$type2.'")) AND ((age_limit_main>64) OR (age_limit_parents>64) OR (age_limit_1>64) OR (age_limit_2>64) OR (age_limit_3>64) OR (age_limit_4>64))) ORDER BY distance');	
	break;

	case(($Senior=="true") && ($select_director!="")) :
	$type1="Admin Only";
$type2="Admin and Parlour";

$distinct_query2=mysqli_query($aVar,'SELECT * FROM hold_distinct2 WHERE (((supplier_type="'.$type1.'") OR (supplier_type="'.$type2.'")) AND ((age_limit_main>64) OR (age_limit_parents>64) OR (age_limit_1>64) OR (age_limit_2>64) OR (age_limit_3>64) OR (age_limit_4>64)) AND (fk_SupplierGroupID="'.$select_director.'")) ORDER BY distance');	
	break;

	case(($Senior=="false") && ($select_director!="")) :
	$type1="Admin Only";
$type2="Admin and Parlour";

$distinct_query2=mysqli_query($aVar,'SELECT * FROM hold_distinct2 WHERE (((supplier_type="'.$type1.'") OR (supplier_type="'.$type2.'")) AND (fk_SupplierGroupID="'.$select_director.'")) ORDER BY distance');	
	break;

	default:
$type1="Admin Only";
$type2="Admin and Parlour";
$distinct_query2=mysqli_query($aVar,'SELECT * FROM hold_distinct2 WHERE ((supplier_type="'.$type1.'") OR (supplier_type="'.$type2.'")) ORDER BY distance');	
	
}
	
while($row=mysqli_fetch_array($distinct_query2)){
				$premium_id=$row['premium_id'];
				$age=$row['age'];
				$premiums_amount=$row['amount'];
				$joining_fee=$row['joining_fee'];
				$plan_id=$row['plan_id'];
				$plan_name=$row['plan_name'];
				$age_limit_main=$row['age_limit_main'];
				$age_limit_parents=$row['age_limit_parents'];
				$age_limit_1=$row['age_limit_1'];
				$age_limit_2=$row['age_limit_2'];
				$age_limit_3=$row['age_limit_3'];
				$age_limit_4=$row['age_limit_4'];
				$supplier_id=$row['supplier_id'];
				$suppliers_Supplier_Name=$row['Supplier_Name'];
				$Phys_Addr1=$row['Phys_Addr1'];
				$Area=$row['Area'];
				$product_id=$row['fk_Product_ID'];
				$select_area=$row['area_id'];
				$Test2_KM=$row['distance'];
				$fk_SupplierGroupID=$row['fk_SupplierGroupID'];
				$supplier_type=$row['supplier_type'];
	$distinct_query3=mysqli_query($aVar,'SELECT * FROM hold_distinct WHERE ((plan_id="'.$plan_id.'") AND (fk_SupplierGroupID="'.$fk_SupplierGroupID.'")) LIMIT 1');

	if($row_plans = mysqli_fetch_assoc($distinct_query3)){
		
		}else{
			mysqli_query($aVar, "insert into hold_distinct values ('$premium_id','$age', '$premiums_amount', '$joining_fee', '$plan_id', '$plan_name', '$age_limit_main', '$age_limit_parents', '$age_limit_1', '$age_limit_2', '$age_limit_3', '$age_limit_4', '$supplier_id', '$suppliers_Supplier_Name', '$Phys_Addr1', '$Area', '$product_id', '$select_area', '$Test2_KM', '$fk_SupplierGroupID', '$supplier_type')");	

		
	}
	
}	
	

	
$sql = "SELECT * FROM hold_distinct ORDER BY distance LIMIT 15";

try {
	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $dbh->query($sql);  
	$plan_types = $stmt->fetchAll(PDO::FETCH_OBJ);
	$dbh = null;
	echo '{"items":'. json_encode($plan_types) .'}'; 
} catch(PDOException $e) {
	echo '{"error":{"text":'. $e->getMessage() .'}}'; 
}



	   ?>				
       
