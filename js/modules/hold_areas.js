import $ from 'jquery';

class MyArea{
	constructor(){
		this.events();	
	}

	events(){
		alert("Test load");
    $("#ma_areas").on("click", "#delete-area", this.deleteArea);	
    $("#ma_areas").on("click","#edit-area", this.editArea.bind(this));	
    $("#ma_areas").on("click","#save_area", this.updateArea.bind(this));
    $("#new_area_submit").on("click", this.createArea.bind(this));
	}


	//Methods	
  editArea(e) {
    var thisArea = $(e.target).parents("li");
    if (thisArea.data("state") == "editable") {
      this.makeAreaReadOnly(thisArea);
    } else {
      this.makeAreaEditable(thisArea);
    }
  }

	makeAreaEditable(thisArea){
		 thisArea.find("#edit-area").html('<i class="fa fa-times" aria-hidden="true"></i> Cancel');
		 thisArea.find("#title_area, #no_branches").removeAttr("readonly").addClass("note-active-field");
		 thisArea.find("#save_area").addClass("update-note--visible");
		 thisArea.data("state", "editable")
	}	
	
	makeAreaReadOnly(thisArea){
		 thisArea.find("#edit-area").html('<i class="fa fa-pencil" aria-hidden="true"></i> Edit');
		 thisArea.find("#title_area, #no_branches").attr("readonly", "readonly").removeClass("note-active-field");
		 thisArea.find("#save_area").removeClass("update-note--visible");
		 thisArea.data("state", "cancel")
	}
	
	
 deleteArea(e) {
    var thisArea = $(e.target).parents("li");

    $.ajax({
      beforeSend: (xhr) => {
        xhr.setRequestHeader('X-WP-Nonce', plancityData.nonce);
      },
      url: plancityData.root_url + '/wp-json/wp/v2/area/' + thisArea.data('id'),
      type: 'DELETE',
      success: (response) => {
        thisArea.slideUp();
        console.log("Congrats");
        console.log(response);
      },
      error: (response) => {
        console.log("Sorry");
        console.log(response);
      }
    });
  }
	
  updateArea(e) {
    var thisArea = $(e.target).parents("li");

    var ourUpdatedPost = {
      'title': thisArea.find("#title_area").val(),
      'no_branches': thisArea.find("#no_branches").val()
    }
    
    $.ajax({
      beforeSend: (xhr) => {
        xhr.setRequestHeader('X-WP-Nonce', plancityData.nonce);
      },
      url: plancityData.root_url + '/wp-json/wp/v2/area/' + thisArea.data('id'),
      type: 'POST',
      data: ourUpdatedPost,
      success: (response) => {
        this.makeAreaReadOnly(thisArea);
        console.log("Congrats");
        console.log(response);
      },
      error: (response) => {
        console.log("Sorry");
        console.log(response);
      }
    });
  }

  createArea(e) {
    var ourNewPost = {
      'title': $("#title_area").val(),
      'no_branches': $("#no_branches").val(),
      'status': 'publish'
    }
    
    $.ajax({
      beforeSend: (xhr) => {
        xhr.setRequestHeader('X-WP-Nonce', plancityData.nonce);
      },
      url: plancityData.root_url + '/wp-json/wp/v2/area/',
      type: 'POST',
      data: ourNewPost,
      success: (response) => {
        $("#title_area").val('');
		$("#no_branches").val('');
        $(`
          <li data-id="${response.id}">
              <input id="title_area" readonly  class="note-title-field" value="${response.title.raw}">
              <span id="edit-area" class="edit-note"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</span>
              <span id="delete-area" class="delete-note"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</span>
              <textarea id="no_branches" readonly  class="note-body-field">${response.content.raw}</textarea>
              <span id="save_area" class="update-note btn btn--blue btn--small"><i class="fa fa-arrow-right" aria-hidden="true"></i> Save</span>
            </li>
          `).prependTo("#ma_areas").hide().slideDown();

        console.log("Congrats");
        console.log(response);
      },
      error: (response) => {
        console.log("Sorry");
        console.log(response);
      }
    });
  }
  
  
  
	
}

export default MyArea;