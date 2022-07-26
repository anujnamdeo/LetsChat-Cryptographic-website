<?php
include("include/connection.php");
include("include/header.php");
include_once("include/constants.php")
?>

<div class="letschat_heading">
    <h1 style="font-family: 'Great Vibes', cursive;
      font-size: 30px;
      text-align: center;
      margin-top: 2em;">LetsChat</h1>
</div>

<div class="container-fluid">
    <div class="row mt-5 mb-5 justify-content-center">
        <div class="col-3">
            <form action="" method="post">
                <div class="form-group">
                    <label for="fullname">Full name</label>
                    <input type="text" name="fullname" id="fullname" class="form-control" placeholder="First Second name" aria-label="Fullname" aria-describedby="basic-addon1" maxlength="<?php echo DB_MAX_LEN ?>" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Voland" aria-label="username" aria-describedby="basic-addon1" maxlength="<?php echo DB_MAX_LEN ?>" required>
                </div>
                <div class="form-group">
                    <label for="emailInput">Email address</label>
                    <input type="email" name="email" class="form-control" id="emailInput" aria-describedby="emailHelp" placeholder="Enter email" maxlength="<?php echo DB_MAX_LEN ?>" required>
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="passwordInput">Password</label>
                    <input type="password" name="password" class="form-control" id="passwordInput" placeholder="Password" maxlength="<?php echo DB_MAX_LEN ?>" required>
                </div>
                
                <button type="submit" name="register" class="btn btn-primary">Register</button>
                <div class="alert alert-light align-left" role="alert">
                    Already registered? <a href="login.php" class="alert-link">Login.</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php

if(isset($_POST["register"])){
    
    if(!empty($_POST['fullname']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])) {
        $fullname= htmlspecialchars($_POST['fullname']);
        $email=htmlspecialchars($_POST['email']);
        $username=htmlspecialchars($_POST['username']);
        $password=htmlspecialchars($_POST['password']);
        $query=mysqli_query($link,"SELECT * FROM usertbl WHERE username='".$username."'");
        $numrows=mysqli_num_rows($query);
        $today = date("Y-m-d");

        // if (!preg_match(DB_MAIL_PATTERN,$email)){ //invalid regexp
        //     $message = "Invalid mail.";
        // }
        // else
        if($numrows==0)
        {
            $sql="INSERT INTO usertbl
            (fullname, email, username,password,privilege_lvl, regdate, last_online_date)
	        VALUES('$fullname','$email', '$username', '$password',0, '$today','$today')";
            $result=mysqli_query($link, $sql);
            if($result){
                // require_once "include/sendConfirmation.php";
                $message = "Account successfully created. Submit your email.";
            }else{
                $message = "Failed to insert record to DB! Sql:".$sql;
            }
        }
        else{
            $message = "User with such name already exists! Please try another one!";
        }
    }
    else{
        $message = "All fields are required!";
    }
}
?>

<?php include("include/footer.php"); ?>


