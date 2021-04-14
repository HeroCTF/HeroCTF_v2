<?php
if(isset($_POST['email']) and isset($_POST['message'])) $msg = 'Your message has been delivered.';
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>ILeakForTroll V1</title>
  </head>
  <body>
    <!-- navbar -->
    <nav class="navbar" style="background-color:#FF0000">
      <span class="navbar-brand mb-0 h1">HeroCTF</span>
      <form action="index.php?page=homepage.php" method="POST">
      <button type="submit">Homepage</button>
      </form>
      <form action="index.php?page=login.php" method="POST">
      <button type="submit">Login</button>
      </form>
    </nav>

    <!-- content -->
    <div class="container" style="margin-top: 20px;">
    <form action="./contact.php" method="POST">
            <div class="form-group">
              <label>Contact us</label><br>
              <?php if(isset($msg)) echo '<label style="color:#FF0000">'.$msg.'</label>'; ?>
              <input type="email" class="form-control" name="email" placeholder="example@example.com">
              <br>
              <input type="text" class="form-control" name="message" placeholder="Message">
            </div>
            <button type="submit" class="btn btn-primary" style="background-color:#FF0000">Submit</button>
          </form>
    </div>
  </body>
</html>
