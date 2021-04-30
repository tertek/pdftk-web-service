$( document ).ready(function() {
    console.log( "ready!" );
	//	Just to be sure..
	$('#submit-convert').attr("disabled", true);


	$(':file').on('change', function () {
		var file = this.files[0];
		const allowedFileSize = 2*1e+7; // 20MB ;
		const allowedFileType = "application/pdf";
		var errors = [];
		
		if (file.size > allowedFileSize ) {
			errors.push("invalid-size")
		}

/* 		if(file.type != allowedFileType) {
			errors.push("invalid-type")
		} */

		if(errors.length > 0) {
			//	Clear File Uploader
			$('#file-uploader').removeClass("has-name is-fullwidth");
			$('span.file-name').addClass('is-hidden').text("");

			//	Show Errors & remove Success
			var i;
			for (i = 0; i < errors.length; i++) {
				$('#'+errors[i]).removeClass("is-hidden");
			}
			$('#valid-file').addClass("is-hidden");

			//	Handle Button
			$('#submit-convert').attr("disabled", true);


		} else {
			//	Set File Uploader
			$('#file-uploader').addClass("has-name is-fullwidth");
			$('span.file-name').removeClass('is-hidden').text(file.name);

			//	Remove Errors & show Success
			$('.help').addClass("is-hidden");
			$('#valid-file').removeClass("is-hidden");

			//	Handle Button
			$('#submit-convert').attr("disabled", false);

		}
		
	// Also see .name, .type
	});
	
	$("#download-button").on('click', function(e){
		var contentBase64 = $(this).attr("base64-data");
		var fileName = $(this).attr("file-name");

		const linkSource = `data:application/pdf;base64,${contentBase64}`;
		const downloadLink = document.createElement('a');
		document.body.appendChild(downloadLink);
	
		downloadLink.href = linkSource;
		downloadLink.target = '_self';
		downloadLink.download = fileName;
		downloadLink.click(); 
	})

	$('#submit-convert').on('click', function (e) {
		//	Prevent form submission
		e.preventDefault();

		//	Hide File Uploader Wrapper
		$('#file-uploader-wrapper').addClass("is-hidden");
		$('#submit-convert').addClass("is-hidden");

		//	Show progress bar
		$('#progress-bar').removeClass("is-hidden");

		setTimeout(function() {

			$.ajax({
				// Process the upload
				url: 'upload.php',
				type: 'POST',
			
				// Form data
				data: new FormData($('form')[0]),
			
				// Tell jQuery not to process data or worry about content-type
				// !important
				cache: false,
				contentType: false,
				processData: false,

				// Custom XMLHttpRequest
				xhr: function () {
					var myXhr = $.ajaxSettings.xhr();
					if (myXhr.upload) {
					// For handling the progress of the upload
					myXhr.upload.addEventListener('progress', function (e) {
						if (e.lengthComputable) {
						$('progress').attr({
							value: e.loaded,
							max: e.total,
						});
						$('#progress-status').text("Success! Your download is ready.");
						}
					}, false);
					}
					return myXhr;
				},		
	  
				success: function(response){

					var href = "data:application/pdf;" + response.base64;

					$("#download-button")
						.removeClass("is-hidden")
						.attr( "base64-data", response.base64 )
						.attr( "file-name", response.name);

				},
	  
				error: function(error) {
					$('#progress-bar').addClass("is-hidden");
					var html = "<b>Error</b>: " + error.responseText + " <a href=\"/\">Try again.</a>"
					$('#server-error').removeClass("is-hidden").html(html);
				},

				complete: function() {
					
				}
		  
			  })			
		}, 1000);

	});

		

});

