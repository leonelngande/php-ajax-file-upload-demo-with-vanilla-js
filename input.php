<?php
	ob_start();
?>

<html>

<head>

</head>

<body>

	<!-- No <form> or equal -->

	<input type="hidden" name="MAX_FILE_SIZE" id="MAX_FILES_SIZE" value="2097152">
	<input type="file" id="datei" maxlength="2097152" required>
	<button id="uploadBtn">Uploaden</button>


	<script type="text/javascript">
	// upload JPEG files ... to complete!
	'use strict';
	document.getElementById("uploadBtn").addEventListener("click", function(){
		
		var file = document.getElementById("datei").files[0];
		console.log(file);
		var filesize = document.getElementById("datei").getAttribute("maxlength");
		
		var formData = new FormData();
		formData.append('file', file);
		formData.append('name', file.name);
		formData.append('filesize', filesize);

		if(file.size > filesize) {
			alert('File too large!');
			return false;
		}
		
		var xhr = new XMLHttpRequest;

		xhr.open('POST', 'upload.php', true);
		// xhr.setRequestHeader('Content-Type', file.type);
		xhr.onload = function() {
			if (xhr.status === 200) {
				console.log(xhr.responseText);
			}
		};
		xhr.send(formData);

	});
</script>

</body>

</html>

<?php
	$output = ob_get_clean();
	echo $output;
?>