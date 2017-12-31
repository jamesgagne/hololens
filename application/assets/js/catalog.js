$(document).ready(function() {
	
	var base_url = $("#base_url").val();
	
	// event handlers
	$("#downloadButton").click(function(){		
		$('.model:checkbox:checked').each(function() {		
			var filePath = $(this).val();
			
			downloadModel(filePath);
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
		var listID = $("#myListID").val();
		
		$('.model:checkbox:checked').each(function() {		
			var filePath = $(this).val();
			
			addModel(filePath, listID);
		});
	});
	
	$("#deleteOK").click(function() {
		$('.model:checkbox:checked').each(function() {		
			var filePath = $(this).val();
			
			deleteModel(filePath);
		});
	});
	
	// methods
	function deleteModel(path) {
		$.ajax({
			type:'POST',
			url: base_url + "index.php/Catalog/DeleteModel",
			data:{'filePath':path},
			success:function(data){
				alert(data);
			}
		});
	}
	
	function addModel(path, listID) {
		$.ajax({
			type:'POST',
			url: base_url + "index.php/Catalog/AddModelToList",
			data:{
				'filePath':path,
				"listID":listID
			},
			success:function(data){
				alert(data);
			}
		});
	}
	
	function downloadModel(path) {
		var fileName = path.split("/")[path.split("/").length - 1];
		
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