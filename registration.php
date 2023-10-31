<?php
session_start();

$usersfile='users.json';

$users= file_exists($usersfile) ? json_decode(file_get_contents($usersfile),true) : [];


function saveUsers($users,$file){
  file_put_contents($file,json_encode($users, JSON_PRETTY_PRINT));
}


//Registration form handling
if(isset($_POST['register'])){ 
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];


//validation    
if(empty($username) || empty($email) || empty($password)){
    $errormsg = "please fill all the required fields";
}
else{
    if(isset($users[$email])){
                $errormsg = "Email already taken";
               
    }else{
        $users[$email] = [
            'username' => $username,
            'password' => $password,
            'role' => ''
        ];

        saveUsers($users,$usersfile);
        $_SESSION['$email'] = $email;
        header('location:update.php');
    
    }
  }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Registration Form</h2>
                    </div>
                    <div class="card-body">

           <?php
           if(isset($errormsg)){
              echo '<div class="alert alert-danger">'.$errormsg.'</div>';
           }
           ?>

      <form class="form" method="POST">
    
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" placeholder="Full name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div>
            <input type="hidden" name="role" value="">    
        </div>    
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button  type="submit" name="register" class="btn btn-primary btn-block" >Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
