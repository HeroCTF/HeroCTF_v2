<?php
$errors = null;
$success = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST['username']) && isset($_POST['password'])) {
		if (!empty($_POST['username']) && !empty($_POST['password'])) {
			if ($_POST['username'] === 'admin' && $_POST['password'] === 'football123') {
				$success = 'There\'s is the flag : Hero{b4ck_t0_th3_s0urc3_1084}';	
			} else {
				$errors = 'Wrong username/password !';
			}
		} else {
			$errors = 'You must enter a username and a password!';
		}
	} else {
		$errors = 'You must enter a username and a password!';
	}
}


?>

<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

		<title>Pas malin</title>
	</head>
	<body>

		<!-- navbar -->
		<nav class="navbar navbar-light bg-light">
			<span class="navbar-brand mb-0 h1">HeroCTF</span>
		</nav>

			<!-- content -->
			<div class="container" style="margin-top: 20px;">

				<?php if($success !== null) : ?>
					<div class="alert alert-success" role="alert">
						<?= $success ?>
					</div>
				<?php elseif ($errors !== null) : ?>
					<div class="alert alert-danger" role="alert">
						<?= $errors ?>
					</div>
				<?php endif ?>

				<div class="card" style="margin-top: 10px;">
					<div class="card-body">

						<form method="POST" action="">
							<div class="form-group">
								<label>Username</label>
								<input id="username" type="text" class="form-control" name="username" aria-describedby="help">
								<small id="help" class="form-text text-muted">Please contact the user "admin" if you are unable to log in.</small>
							</div>
							<div class="form-group">
								<label>Password</label>
								<input id="password" type="password" class="form-control" name="password">
							</div>
							
							<button type="submit" class="btn btn-primary">Login</button>
						</form>
					</div>
				</div>
			</div>
	</body>
</html>































































































































<!-- admin password: football123 -->
