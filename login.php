<?php 
	



?>
<!DOCTYPE html>
<html>
<head>
	<title>Login EFG</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-offset-4 col-sm-4 col-sm-offset-4 text-center login">
				<h4>LOGIN</h4>
				<form action="login.php" method="post">
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon">
							<span class="glyphicon glyphicon-user "></span>
						</div>
						<input type="text" name="email" placeholder="Username" class="form-control input" >
					</div>
				</div>
				
				<div class="form-group ">
					<div class="input-group">
						<div class="input-group-addon">
							<span class="glyphicon glyphicon-lock "></span>
						</div>
						<input type="password" name="pass" placeholder="Password" class="form-control input">
					</div>
				</div>
			
					<input type="submit" name="login" value="LOGIN" class="btn btn-warning btnbikinan">
				</form>
			</div>
		</div>
		
	</div>
</body>
</html>