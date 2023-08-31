class MyArea{
	constructor(){
		this.area_events();	
	}


	area_events(){
	$("#ma_areas").on("click", "#delete-area", this.deleteArea.bind(this));	
    $("#ma_areas").on("click","#edit-area", this.editArea.bind(this));	
    $("#ma_areas").on("click","#save_area", this.updateArea.bind(this));

	}
	
	
 deleteArea(e) {
	alert("Yhahs");
 }	 
	
	
}


export default MyArea;