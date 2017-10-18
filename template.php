<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
		<link rel="stylesheet" href="css/estilos.css">

		<title>Login | Hippo</title>
	</head>
	<body>

			<form method="POST" action="">
				<img class="logo" src="img/logo.jpg">
					<h1>Login</h1>
				<?php
				if(isset($msg)){
					echo "<br><b>$msg</b><br><br>";
				}
				?>
				<label>Login</label>
				<input type="text" name="login" >
				<label>Senha</label>
				<input type="password" name="senha" >
				<input type="submit" value="Login" name="btnLogin" class="btn">
			</form>

		</center>
	</body>
</html>
