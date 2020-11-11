<?php
if(isset($_POST['username']) and isset($_POST['password'])){
    if($_POST['username'] == 'HeroCTFAREdaBest' && $_POST['password'] = 'ThisISASUPERPassword'){
        $msg = 'Great you login, gg! But this is not this kind of Local File Inclusion, try again :)';
    }else{
        $msg = 'Sorry but you don\'t seem to be an admin.';
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

    <title>WikiLeaks V2 - Admin Login</title>
  </head>
  <body>
    <!-- navbar -->
    <nav class="navbar" style="background-color:#FF0000">
      <span class="navbar-brand mb-0 h1">Root Me</span>
      <form action="index.php?page=homepage.php" method="POST">
      <button type="submit">HomePage</button>
      </form>
      <form action="index.php?page=contact.php" method="POST">
      <button type="submit">Contact</button>
      </form>
    </nav>

    <!-- content -->
    <div class="container" style="margin-top: 20px;">
         <!-- form -->
         <form action="/lfi/login.php" method="POST">
            <div class="form-group">
              <label>Admin Login</label><br>
              <?php if(isset($msg)) echo '<label style="color:#FF0000">'.$msg.'</label>'; ?>
              <input type="text" class="form-control" name="username" placeholder="username">
              <br>
              <input type="password" class="form-control" name="password" placeholder="password">
            </div>
            <button type="submit" class="btn btn-primary" style="background-color:#FF0000">Submit</button>
          </form>
    </div>
  </body>
</html>