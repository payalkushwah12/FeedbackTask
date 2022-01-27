<?php
error_reporting(0);
if(isset($_POST['login']))
{
    $uname=$_POST['username'];
    $password=$_POST['password'];
    if(!empty($uname) && !empty($password))
    {
        if($uname == "test_user")
        {
            if($password == 123456)
            {
                session_start();
                $_SESSION['user'] = $uname;
                header("location:feedback.php");
            }
            else
            {
                $errMsg ="Enter valid password";
            }
        }
        else
        {
            $errMsg ="Enter valid username";
        }
    }
    else
    {
        $errMsg="Enter Username and Password";
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Feedback</title>
    <style>
      .container-fluid{
        background-image:url("images/bg3.jpg");
        background-repeat:no-repeat;
        background-size:100% 100%;
        width:100%;
        height:600px;
      }
      form{
          margin:40px 200px 0px 350px; 
          height:450px;
          backdrop-filter: blur(10px);
          border: 10px groove white;
            border-radius:10px;
            padding:50px;
            font-size:20px;
            font-weight:500;
      }
      .alert{
          font-size:15px;
      }
      @media only screen and (max-width: 1000px) {
        form{
          margin:40px 20px 0px 50px; 
          height:450px;
          backdrop-filter: blur(10px);
          border: 10px groove white;
            border-radius:10px;
            padding:30px;
            font-size:20px;
            font-weight:500;
      }
        }
      </style>
  </head>
  <body>
    <?php 
    include("nav.php");
    ?>
    <section class="container-fluid">
        <div class="container">
        <h1 class="text-center" style="padding-top:20px;"> Login</h1>
        <form method="post">
        <?php 
          if(!empty($errMsg)){
            ?>
      <div class="alert alert-danger"> <?php echo $errMsg;?></div>
            <?php
          }
          ?>
            <div class="form-group">
                <label for="exampleInputuser">Username</label>
                <input type="text" class="form-control" id="exampleInputuser" placeholder="Username" name="username">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword" placeholder="Password" name="password">
            </div>
            <br>
            <button type="submit" class="btn btn-primary btn-lg btn-block" name="login">LOGIN</button>
        </form>

        </div>

    </section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>