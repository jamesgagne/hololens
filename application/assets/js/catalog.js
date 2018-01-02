$(document).ready(function() {
	
	var base_url = $("#base_url").val();
	
	// event handlers
	$("#downloadButton").click(function(){		
		$('.model:checkbox:checked').each(function() {		
			var fileInfo = $(this).val();
			
			downloadModel(fileInfo);
		});
	});
	
	$('.fileCheckBox').change(function() {
		var parent = $(this).parent();
		
		$(parent).toggleClass("highlight");
		
		// toggle button functionality
		var selectedFileCount = getSelectedFileCount();
		
		if(selectedFileCount > 0) {
			$("#addButton").prop("disabled", false);
			$("#deleteButton").prop("disabled", false);
			$("#downloadButton").prop("disabled", false);
		}
		else {
			$("#addButton").prop("disabled", true);
			$("#deleteButton").prop("disabled", true);
			$("#downloadButton").prop("disabled", true);
		}
	});
	
	$("#addButton").click(function() {
		var selectedFileCount = getSelectedFileCount();
		
		$("#addFileCount").html(selectedFileCount);
	});
	
	$("#deleteButton").click(function() {
		var selectedFileCount = getSelectedFileCount();
		
		$("#deleteFileCount").html(selectedFileCount);
	});
	
	$("#addOK").click(function() {
		var space_id = $("#spaceID").val();
		
		$('.model:checkbox:checked').each(function() {		
			var fileInfo = $(this).val();
			
			addModel(fileInfo, space_id);
		});
	});
	
	$("#deleteOK").click(function() {
		$('.model:checkbox:checked').each(function() {		
			var fileInfo = $(this).val();
			
			deleteModel(fileInfo);
		});
	});
	
	// methods
	function deleteModel(fileInfo) {
		var path = fileInfo.split(",")[0];
		var model_id = fileInfo.split(",")[2];
		
		$.ajax({
			type:'POST',
			url: base_url + "index.php/Catalog/DeleteModel",
			data:{
				"model_id":model_id
			},
			success:function(data){
				if(data != "errror") {
					$('.model:checkbox:checked').each(function() {		
						var fileInfo = $(this).val();
						var model_id = fileInfo.split(",")[2];
						var parent = $(this).parent();
						
						if(data == model_id) {
							parent.remove();
						}
					});
				}
			}
		});
	}
	
	function addModel(fileInfo, space_id) {
		var model_id = fileInfo.split(",")[2];
		
		$.ajax({
			type:'POST',
			url: base_url + "index.php/Catalog/AddModelToWorkspace",
			data:{
				"space_id":space_id,
				"model_id":model_id
			}
		});
	}
	
	function downloadModel(info) {		
		var fileName = info.split(",")[1];
		var path = info.split(",")[0];
		
		var element = document.createElement('a');
		element.setAttribute('href', path);
		element.setAttribute("download", fileName);

		element.style.display = 'none';
		document.body.appendChild(element);

		element.click();

		document.body.removeChild(element);
	}
	
	function getSelectedFileCount() {
		return $('.model:checkbox:checked').length;
	}
});