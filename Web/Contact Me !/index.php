<?php
require_once('Session.php');
Session::initSession(0);

$sessionComments = $_SESSION;
if(isset($_POST['message']) && !$_SESSION['admin']){
	$_SESSION['comments'][] = $_POST['message'];
	$msg = 'Your comment has been sent, thanks :), this page will be refreshed in 5 seconds.';
	header("Refresh: 5");
} else if($_SESSION['admin'] && isset($_GET['botSenpai'])) {
  preg_match_all('/[^a-zA-Z_0-9]/m', $_GET['botSenpai'], $matches, PREG_SET_ORDER, 0);
  if(!empty($matches)) die('This is not part of the challenge. Stop disturbing the instance.');
  $sessionComments = Session::getSession($_GET['botSenpai']);
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" i>

    <title>Contact me :)</title>
  </head>
  <body>
    <!-- navbar -->
    <nav class="navbar" style="background-color:black;">
      <span class="navbar-brand mb-0 h1" style="color: white;" >HeroCTF</span>
    </nav>

    <!-- content -->
    <form method="POST" action="<?= $_SERVER['SCRIPT_NAME'] ?>">
      <div class="container" style="margin-top: 20px;">
          <?php if(isset($msgE)) echo('<p style="color: red;">'.$msgE.'</p>'); ?>
          <?php if(isset($msg)) echo('<p style="color: green;">'.$msg.'</p>'); ?>
          <p>Welcome on my server ! :)</p>
          <p>Here you can contact me, send me what you want!</p>
          <p>Also, you can't access /admin.php.</p>
          <p>Have a good day :)</p>
          <textarea  id="message" name="message" rows="5" cols="90" required></textarea><br/>
          <button type="submit" class="btn btn-primary">Send</button>
      </div>
    </form>
	<hr>
	<div class="container">
		<h1>Comments</h1>
		<?php krsort($sessionComments['comments']); foreach($sessionComments['comments'] as $comment) { ?>
			<hr>
			<p><?=$comment?> <span>- Guest</span></p>
		<?php } ?>
	</div>
  </body>
</html>
