<?php 
session_start();
if(isset($_POST["login"]) && isset($_POST["username"]) && isset($_POST["password"])){
	if($_POST["username"]=='experionadmin' && bin2hex($_POST["password"])==='6578706572696f6e4061646d696e') {	//Password - experion@admin
		$_SESSION["username"] = $_POST["username"];
		header("Location: index.php");
		exit;
	} else {
		header("Location: login.php?error=1");
		exit;
	}
	
}
?>

<!DOCTYPE php>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="css/style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
	@media(min-width:1200px) {
		.box {
			max-width: 50%;
			margin-left: auto;
			margin-right: auto;
			margin-top: 30px;
		}
	}
</style>

<body>
	<section class="sec-first">
		<div class="box">
			<div class="container">
				<div class="col-12 pd-tp-30 pd-bt-30"></div>
				<div class="col-12 header-title text-center pd-tp-30 pd-bt-30">
					
					<div class="login-form">
					<h2 class="form-title text-center"><img src="images/logo.png" width="150"></h2>
						<form class="mt-5" action="login.php" method="post">
						<h1 class="h3">Login</h1>
						<?php if (@$_GET['error'] == 1) { ?>
							<p style="color:red">Username or Password are wrong</p>
						<?php } ?>
							<div class="form-group first-50 mt-3">
								<input type="text" name="username" class="form-control" placeholder="Email">
							</div><br>
							<div class="form-group send-50">
								<input type="password" name="password" class="form-control" placeholder="Password">
							</div><br>
							<div class="form-group">
								<button type="submit" name="login" class="submit-form btn free-crm-submit btn btn-primary w-100 fw-bold free-crm-submit">Login</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>

</html>
