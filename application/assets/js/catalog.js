$(document).ready(function() {
	$("#downloadSelectedModels").click(function(){
		
		var selectedModelPaths = [];
		var selectedModelFileNames = [];
		
		var assetUrl = $("#assetUrl").val();
		
		$('.model:checkbox:checked').each(function() {
			
			var fileName = $(this).val();
			var filePath = assetUrl + fileName + ".fbx";
			
			selectedModelPaths.push(filePath);
			selectedModelFileNames.push(fileName);
		});
		
		for(var i = 0; i < selectedModelPaths.length; i++) {
			download(selectedModelPaths[i], selectedModelFileNames[i]);
		}
	});

	function download(path, filename) {

		var element = document.createElement('a');
		element.setAttribute('href', path);
		element.setAttribute("download", filename);

		element.style.display = 'none';
		document.body.appendChild(element);

		element.click();

		document.body.removeChild(element);
	}
});