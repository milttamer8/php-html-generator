$(document).ready(function(){
  	// $('#html_generate_form').on('submit', function(event){
	  // 	event.preventDefault();
	  // 	$.ajax({
	  //           url: "upload.php",
	  //           method:"POST",
	  //           data:new FormData(this),
	  //           contentType:false,
	  //           cache:false,
	  //           processData:false,
	  //           success:function(resp)
	  //           {
	  //           	let result = JSON.parse(resp);
	  //           	if(result.result == 'false') {
	  //           		console.log(false);
	  //           		alert(result.message);
	  //           	}
	  //           	let filehref = `download.php?id=${resp}`;
	  //           	$('.final-handle').attr('href', filehref);
	  //           	$('.final-handle').text('Download Zip Now!').attr('download',resp);
	  //           }
	  //       });
  	// });
  	$(".input-uploader").change(function(e){
  		let fileName = $(this)[0].files[0].name;
  		if($(this)[0].files[0].type !== "text/html") {
  			$('#exampleModal').modal('toggle');
  			$(this).val('');
  		}
  		else {
  			$(this).closest('div').find('.upload-content').html(fileName);
  		}
  	});
  	$(".input-uploader-article").change(function(){
  		let fileCount = $(this)[0].files.length;
  		let isFileFormat = true;
  		for (let i = 0; i < fileCount; i++) {
  			if($(this)[0].files[i].type !== "text/html") {
  				isFileFormat = false;
  			}
  		}
  		if(isFileFormat) {
  			let content = `${fileCount} article files are selected`;
  			$(this).closest('div').find('.upload-content').html(content);
  		}
  		else {
  			$('#exampleModal').modal('toggle');
			$(this).val('');
  		}
  		
  	});
  	$(".input-uploader-image").change(function(){
  		let fileCount = $(this)[0].files.length;
  		console.log($(this)[0].files);
  		let isFileFormat = true;
  		for (let i = 0; i < fileCount; i++) {
  			if($(this)[0].files[i].type.indexOf("image/") < 0) {
  				isFileFormat = false;
  			}
  		}
  		if(isFileFormat) {
  			let content = `${fileCount} image files are selected`;
  			$(this).closest('div').find('.upload-content').html(content);
  		}
  		else {
  			$('#exampleModal').modal('toggle');
			$(this).val('');
  		}
  	});

});