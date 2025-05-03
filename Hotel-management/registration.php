<?php
require_once('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Customer Registration</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>

<?php
if(isset($_POST['submit'])){
  $firstname   = $_POST['firstname'];
  $lastname    = $_POST['lastname'];
  $email       = $_POST['email'];
  $phonenumber = $_POST['phonenumber'];
  $password    = $_POST['password'];

  // $sql = "INSERT INTO customers (firstname, lastname, email, phonenumber, password ) VALUES (?,?,?,?,?)";
  // $stmtinsert = $db->prepare($sql);
  // $result = $stmtinsert->execute([$firstname, $lastname, $email, $phonenumber, $password]);
  // if($result){
  //   echo 'Registration success';
  // }else {
  //   echo 'Registration failed';
  // }

  //echo $firstname . " " . $lastname . " " . $email . " " . $phonenumber . " " . $password;
  // echo 'User submitted';
}
?>

  <div class="form-container">
    <form action="registration.php" method="POST">
      <div class="container">

        <div class="row">
          <div class="col-sm-4">
            
          <h1>Customer Registration</h1>
              <p>Fill up the form with correct data</p>
                <label for="firstname">First Name:</label>
                <input class="form-control" type="text" name="firstname" required>
          
                <label for="lastname">Last Name:</label>
                <input class="form-control" type="lastname" name="lastname" required>

                <label for="email">Email Address:</label>
                <input class="form-control" type="email" name="email" required>

                <label for="phonenumber">Phone Number:</label>
                <input class="form-control" type="text" name="phonenumber" required>
          
                <label for="password">Password:</label>
                <input class="form-control" type="password" name="password" required>
                <hr class="mb-3">
                <button class="btn btn-primary" type="submit" name="submit" value="Sign up">Register</button>
          </div>
        </div>       
      </div>
    </form>
  </div>
</body>
</html>

