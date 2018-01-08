$(document).ready(function() {
	var base_url = $("#base_url").val();
	
	$("#removeOK").click(function() {
		$('.model:checkbox:checked').each(function() {		
			var fileInfo = $(this).val();
			
			removeModel(fileInfo);
		});
	});
	
	$('.fileCheckBox').change(function() {
		var parent = $(this).parent();
		
		$(parent).toggleClass("highlight");
		
		// toggle button functionality
		var selectedFileCount = getSelectedFileCount();
		
		if(selectedFileCount > 0) {
			$("#removeButton").prop("disabled", false);
			$("#downloadButton").prop("disabled", false);
		}
		else {
			$("#removeButton").prop("disabled", true);
			$("#downloadButton").prop("disabled", true);
		}
	});
	
	$("#removeButton").click(function() {
		var selectedFileCount = getSelectedFileCount();
		
		$("#removeFileCount").html(selectedFileCount);
	});
	
	function removeModel(fileInfo) {
		var path = fileInfo.split(",")[0];
		var model_id = fileInfo.split(",")[2];
		var space_id = $("#space_id").val();
		
		$.ajax({
			type:'POST',
			url: base_url + "index.php/Workspace/RemoveModel",
			data:{
				"model_id":model_id,
				"space_id":space_id
			},
			success:function(data){
				if(data != "error") {
					$('.model:checkbox:checked').each(function() {		
						var fileInfo = $(this).val();
						var model_id = fileInfo.split(",")[2];
						var parent = $(this).parent();
						
						if(data == model_id) {
							parent.parent().remove();
						}
					});
					
					if(getSelectedFileCount() == 0) {
						$("#removeButton").prop("disabled", true);
						$("#downloadButton").prop("disabled", true);
					}
				}
			}
		});
	}
	
	function getSelectedFileCount() {
		return $('.model:checkbox:checked').length;
	}
});