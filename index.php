<?php
    include('config.php');
	
	if(isset($_POST['loginbtn'])) {
		$query_confirm = "SELECT * FROM users WHERE (email='".$_POST['email']."' OR username='".$_POST['email']."') AND password='".$_POST['password']."'";

		$result = mysqli_query($conn, $query_confirm);

		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
			   $_SESSION['loginfo'] = $row['username'];
		  	}
		  // output data of each row
		  header("Location: generate.php");
		  exit();
		} 
		else {
		  $message = "Invalid password or email";
		}
	}
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
<body class="login-body">
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1 class="input-title">Login</h1>
			<form class="login-container" method="post">
				<p class="invalid"><?php if(isset($message)) {echo $message;}?></p>
			  	<div class="form-group" style="padding-top: 30px;">
			  		<label class="label">Email</label>
			    	<input class="login-input" type="email" name="email" required>			  		
			  	</div>
			  	<div class="form-group">
			  		<label class="label">Password</label>
			    	<input class="login-input" type="password" name="password" required>
			  	</div>			    
			    <button class="btn" name="loginbtn" type="submit">LOGIN</button>
			</form>
		</div>	  
	</div>
</div>

<?php 
	include('footer.php');
?>