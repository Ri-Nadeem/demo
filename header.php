<?php
session::init();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<?php
if(isset($_GET['action']) && $_GET['action']=='logout'){
    session::destory();
}

?>

<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
    <?php
        $id = session::get("id");
        $loog = session::get("login");
        if($loog==true){

?>
      <li class="nav-item">
        <a class="nav-link" href="#">profile</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="?action=logout">logout</a>
      </li>
        <?php }else{ ?> 

      <li class="nav-item">
        <a class="nav-link" href="login.php">login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">register</a>
      </li> 
      <?php } ?>   
    </ul>
  </div>  
</nav>
<br>



</body>
</html>


