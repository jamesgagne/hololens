$(document).ready(function() {
	$("#register-picture").change(function() {
		setImagePreview(this, "register-preview-image");
	});
	
	function setImagePreview(input, previewControlId) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			var id = "#" + previewControlId;

			reader.onload = function(e) {
				$(id).attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}
});