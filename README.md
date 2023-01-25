
Responsive Login form built with Bootstrap 5 using. Develop using OOP PHP to login and login with Google Authenticator, Facebook Login, and Twitter Login.

![Bootstrap 5 Login Form](https://i.ibb.co/5kV5gHx/Capture.png)

## Example

```html
<?php
session_start();

//Include Configuration File\

//Google Login
include('GLogin\GLogin.php');

//Facebook Login
include ("fb-login\FBLogin.php");

//Twitter Login
include ("twitter-login\TLogin.php");

if( !isset($_GET["error"]) ){
	$case="none";
	
}else{

switch ($_GET["error"]) {
  case "stmtfailedinsert":
   $case= "System error!";
    break;
  case "stmtfailed":
     $case= "User does not exist!";
    break;
  case "emptyinput":
     $case="No input!";
    break;
  case "wrongpassword":
    $case="Wrong Password!";
    break;
	case "usernotfound":
    $case="User not found!";
    break;
	case "passwordmatch":
    $case="Password do not match!";
    break;
	case "username":
    $case="Invalid Username!";
    break;
	case "useroremailtaken":
    $case="Username and email are taken!";
    break;
	case "email":
    $case="Invalid email address!";
    break;
  default:
    $case="none";
	
}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Material Design for Bootstrap</title>
  <!-- MDB icon -->
  <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
  <!-- MDB -->
  <link rel="stylesheet" href="css/bootstrap-login-form.min.css" />
  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
  <!-- Start your project here-->
  <section class="vh-100" style="background-color: #508bfc;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">

		<?PHP if( $case=='none' ){ }else{ ?>
		
	<div class="alert alert-danger alert-dismissible">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	<strong><?PHP echo $case; ?></strong>
	</div>
	<?php
		}
	?>
              <h3 class="mb-5">Sign in</h3>
			<form action="include/login.inc.php" method="POST">
              <div class="form-outline mb-4">
                <input type="text" id="typeEmailX-2" name='uid' class="form-control form-control-lg" />
                <label class="form-label" for="typeEmailX-2">Username</label>
              </div>
  
              <div class="form-outline mb-4">
                <input type="password" id="typePasswordX-2" name='pwd' class="form-control form-control-lg" />
                <label class="form-label" for="typePasswordX-2">Password</label>
				
              </div>
			  
			  <label class="w-100 text-right">
			<a href="pwdreset.php">Forgot Password ?</a>
			</label>
    <p></p>
              <!-- Checkbox -->
			  
              
               
  
              <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit">Login</button>
			   <p></p>
			   <label class="w-50"> Don't have an account yet? <a href='#' data-toggle="modal" data-target="#myModal">Sign up here!</a> </label>
              <p></p>
			  
			</form>
              <hr class="my-4">
				<a href="<?PHP echo $google_Url; ?>" class="inline">
              <button class="btn btn-lg btn-block btn-primary" style="background-color: #dd4b39;" type="submit"><i class="fab fa-google me-2"></i> Sign in with google</button>
        </a>
			  <p></p>
			  <a href="<?PHP echo $loginUrl ; ?>" class="inline">
              <button class="btn btn-lg btn-block btn-primary mb-2" style="background-color: #3b5998;" type="submit"><i class="fab fa-facebook-f me-2"></i>Sign in with facebook</button>
			  </a>
			<p></p>
      <a href="<?PHP echo $twitter_Login; ?>" class="inline">
              <button class="btn btn-lg btn-block btn-primary mb-2" style="background-color: #00acee;" type="submit"><i class="fab fa-twitter me-2"></i>Sign in with Twitter</button>
      </a>       
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End your project here-->
<!--MODAL register-->

<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          
          <h3 class="modal-title">Register</h3>
        </div>
        <div class="modal-body">

		<form action='include/signup.inc.php' method='POST' >
              <div class="form-outline mb-4">
                <input type="text" id="typeEmailX-2" name="uid" class="form-control form-control-lg" />
                <label class="form-label" for="typeEmailX-2">Username</label>
              </div>
  
              <div class="form-outline mb-4">
                <input type="password" id="typePasswordX-2" name="pwd" class="form-control form-control-lg" />
                <label class="form-label" for="typePasswordX-2">Password</label>
              </div>
			  
			  <div class="form-outline mb-4">
                <input type="password" id="typePasswordX-2" name="pwdrepeat" class="form-control form-control-lg" />
                <label class="form-label" for="typePasswordX-2">Retype Password</label>
              </div>
			  
			   
			   <div class="form-outline mb-4">
                <input type="email" id="typeEmailX-2" name="email" class="form-control form-control-lg" />
                <label class="form-label" for="typeEmailX-2">Email</label>
              </div>
			  
			    <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit">Sign up</button>
				  </form>
			   
				 </div>
			
       
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
  <!-- MDB -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Custom scripts -->
  <script type="text/javascript"></script>
</body>

</html>
```

