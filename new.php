<?php 
error_reporting(0);
 session_start();
 $user=$_SESSION['user'];
 if(empty($user))
 {
   header("location:index.php");
 }
$success="";
 if(isset($_POST['sub']))
 {
   $radio=@$_POST['radio'];
   $ename=$_POST['ename'];
   $select=$_POST['select'];
   $jobt=$_POST['job'];
   $review=$_POST['review'];
   $pro = $_POST['pros'];
   $con = $_POST['cons'];
   $advice = $_POST['advice'];
   $rate = $_POST['rating'];
   $tmp=$_FILES['file']['tmp_name'];
   $size =$_FILES['file']['size'];
   if(!empty($radio) && !empty($ename) && !empty($select) && !empty($jobt) && !empty($review) && !empty($pro) && !empty($con) && !empty($advice) && !empty($tmp) && !empty($rate))
   {
        $fn=$_FILES['file']['name'];
        $ext=pathinfo($fn,PATHINFO_EXTENSION);
        $fname="file-".time()."-".rand().".$ext";
        if($ext=="docx" || $ext =="pdf")
        {
            if($size < 10485760)
            {
                if(isset($_POST['agree']))
                {
                    if(is_dir("users/".$ename))
                    {
                        $errMsg="User already exists";
                    }
                    else
                    {
                        mkdir("users/$ename");
                        if(move_uploaded_file($tmp,"users/$ename/$fname"))
                        {
                        file_put_contents("users/$ename/feedbackfile.txt","$ename \n $radio \n $select \n $rate \n $jobt \n $review \n $pro \n $con \n $advice");
                        $success = "Feedback submitted successfully";
                        }
                        else 
                        {
                            rmdir("users/$ename");
                            $errMsg="Uploading Error";
                        }
                    }
                }
                else
                {
                    $errMsg="Please agree terms and conditions";
                }
            }
            else
            {
                $errMsg="Please upload file of less than 10MB";
            }
        }
        else
        {
            $errMsg = "Please upload file of doc and pdf extension";
        }
   }
   else
   {
        $errMsg = "Please fill all fields";
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
    <link rel="stylesheet" href="https://mdbootstrap.com/docs/b4/jquery/plugins/rating/">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>

    <title>Dashboard Page</title>
    <script src="feedback.js"></script>
    <style>
        #regis_form fieldset:not(:first-of-type)
        {
            display:none;
        }
        .jumbotron{
            padding:20px 20px 20px 20px;
            margin-bottom:0px;
        } 
      form{
        margin:0px 200px 0px 150px;
        padding:50px;
        font-size:16px;
      }
      .btn{
          margin-left:250px;
      }
      @media only screen and (max-width: 1000px) {
        form{
        margin:0px 20px 0px 15px;
        padding:20px;
        font-size:16px;
      }
        }
        #efield{
            height:35px;
        }
      </style>
      <script>
        $("#input-id").rating();
    </script>
    </head>
    <body>
    <main>
        <header>
            <?php include("navdash.php");?>
        </header>
    <section class="jumbotron">
    <h2 class="text-center">FEEDBACK FORM</h1>
        <div class="container">
        <form id="regis_form" method="post" enctype="multipart/form-data">
        <?php 
          if(!empty($errMsg)){
            ?>
      <div class="alert alert-danger"> <?php echo $errMsg;?></div>
            <?php
          }
          ?>
          <?php 
          if(!empty($success)){
            ?>
      <div class="alert alert-success"> <?php echo $success;?></div>
            <?php
          }
          ?>
          <fieldset>
            <div class="form-group">
            <label>1. Are you a current or former employee?</label>
            <br>
                <input  type="radio" name="radio" id="exampleRadios1" value="Current">
                <label  for="exampleRadios1">Current</label>
                &nbsp;<input type="radio" name="radio" id="exampleRadios2" value="Former">
                <label  for="exampleRadios2">Former</label>
            </div>
            <div class="form-group">
                <label for="exampleInputuser">2. Employer's Name</label>
                <input type="text" class="form-control"  placeholder="Employee Name" name="ename">
                
            </div>
        </fieldset>
        <fieldset>
            <div class="form-group">
                <label for="input-1" class="control-label">3. Overall Rating</label>
                <input id="input-1" name="rating" class="rating rating-loading" value="0" data-min="0" data-max="5" data-step="0.5" data-size="xs">
                <br/>    
            </div>

            <div class="form-group">
                <label for="exampleInputuser">4. Employment Status</label>
                <select class="custom-select mr-sm-2" id="efield" name="select">
                    <option selected>Choose...</option>
                    <option value="Full Time">Full Time</option>
                    <option value="Part Time">Part Time</option>
                    <option value="Contract">Contract</option>
                    <option value="Intern">Intern</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputuser">5. Job Title</label>
                <input type="text" class="form-control" id="exampleInputuser" placeholder="Job Title" name="job">
            </div>
            <div class="form-group">
                <label for="exampleInputuser">6. Review Headline</label>
                <input type="text" class="form-control" id="exampleInputuser" placeholder="Review Headline" name="review">
            </div>
            <label for="exampleInputuser">7. Pros</label><br>
            <textarea rows="3" cols="55" minlength="15" maxlength="200" name="pros"></textarea><br>
            <label for="exampleInputuser">8. Cons</label><br>
            <textarea rows="3" cols="55" minlength="15" maxlength="200" name="cons"></textarea><br>
            <label for="exampleInputuser">9. Advice Management</label><br>
            <textarea rows="3" cols="55" minlength="15" maxlength="200" name="advice"></textarea><br>
            <input type="button" name="previous" class="previous btn btn-default" value="Previous">
            <input type="button" name="next" class="next btn btn-info" value="Next">
        </fieldset>
        <fieldset>
            <div class="form-group">
                <label >10. Submit Proof</label>
                <input type="file" class="form-control" name="file" >
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="agree" id="exampleCheck1">
                &nbsp;&nbsp;&nbsp;&nbsp;<label class="form-check-label" for="exampleCheck1">Agree Terms and Conditions</label>
            </div>
            <br>
            <input type="button" name="previous" class="previous btn btn-default" value="Prevoius">
            <button type="submit" class="btn btn-primary btn-lg" name="sub">Submit</button>
        </fieldset>
        </form>

        </div>

    </section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://mdbootstrap.com/docs/b4/jquery/plugins/rating/" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>