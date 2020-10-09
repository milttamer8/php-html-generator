<?php
  include('config.php');
  include('header.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Generate</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="custom.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.1/css/flag-icon.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body class="generate-body">
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="dropdown language-container">
				<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Language
				</button>
				<div class="dropdown-menu dropdown-menu-right text-right language">
					<a class="dropdown-item" href="?lang=en"><span class="flag-icon flag-icon-us"> </span> English</a>
					<a class="dropdown-item" href="?lang=it"><span class="flag-icon flag-icon-it"> </span> Italian</a>
				</div>
				<div class="logout">
					<a href="logout.php">Logout</a>
				</div>
			</div>
			
		</div>
		<div class="col-md-12">
			<form id="html_generate_form" method="POST" action="upload.php" enctype="multipart/form-data">
				<h1 class="input-title"><?php echo $lang['input-title']?></h1>
				<?php if(isset($_SESSION['success'])) {?>
					<div class="alert alert-success alert-dismissible">
					  <button type="button" class="close" data-dismiss="alert">&times;</button>
					  <strong>Success!</strong> Indicates a successful or positive action.
					</div>
				<?php }?>
				<?php if(isset($_SESSION['error'])) {?>
					<div class="alert alert-danger alert-dismissible">
					  <button type="button" class="close" data-dismiss="alert">&times;</button>
					  <strong>Failed!</strong> Please check the files.
					</div>
				<?php }?>				
				<div class="form-group file-uploader">
					<input class="input-uploader" type="file" name="indexFile" accept=".html" required>
			  		<p class="upload-content"><?php echo $lang['import_html']?></p>
				</div>
				<div class="form-group file-uploader">
			  		<input class="input-uploader-article" type="file" name="articleFile[]" accept=".zip" required multiple="multiple">
			  		<p class="upload-content"><?php echo $lang['import_article']?></p>
				</div>
				<div class="form-group file-uploader">
			  		<input class="input-uploader-image" name="imageFile[]" type="file" accept=".zip" required multiple="multiple">
			  		<p class="upload-content"><?php echo $lang['import_img']?></p>
				</div>
				<div class="form-group url-input">
					<label class="label" for="out_url"><?php echo $lang['insert_url']?></label>
					<input type="text" class="out-url" name="out_url" required="">	
				</div>
			  	<div class="button-group">
			  		<button type="submit" class="btn"><?php echo $lang['submit']?></button>
			  	</div>
			</form>
		</div>
	</div>
</div>

<!-- The Modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $lang['modal_head']?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo $lang['modal_body']?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php
	include('footer.php');
?>